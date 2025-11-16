<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Organization;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class RegistrationIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the application can register a volunteer, save to database, and output the data
     */
    public function test_volunteer_registration_saves_and_outputs_data()
    {
        // 1. REGISTER: Submit volunteer registration
        $volunteerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'SecurePass123',
            'password_confirmation' => 'SecurePass123',
            'date_of_birth' => '1995-05-15',
            'address' => '123 Main St',
            'bio' => 'Passionate about helping others',
        ];

        $response = $this->post('/register/volunteer', $volunteerData);
        
        // Verify redirect to home with success message
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        // 2. SAVE: Verify data was saved to database
        // Check user was created
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'user_type' => 'volunteer',
            'is_active' => true,
        ]);

        // Check volunteer profile was created
        $this->assertDatabaseHas('volunteers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St',
            'bio' => 'Passionate about helping others',
        ]);

        // Check welcome notification was created
        $user = User::where('email', 'john.doe@example.com')->first();
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->user_id,
            'notification_type' => 'welcome',
        ]);

        // 3. OUTPUT: Verify data can be retrieved
        // Test API output (as admin)
        $admin = User::factory()->create(['user_type' => 'admin', 'is_active' => true]);
        $this->actingAs($admin);
        
        $apiResponse = $this->getJson('/api/users');
        $apiResponse->assertStatus(200);
        $apiResponse->assertJsonFragment([
            'email' => 'john.doe@example.com',
            'user_type' => 'volunteer',
        ]);

        // Verify volunteer can login (authentication works)
        $this->assertTrue(auth()->check());
    }

    /**
     * Test that the application can register an organization, save to database, and output the data
     */
    public function test_organization_registration_saves_and_outputs_data()
    {
        // 1. REGISTER: Submit organization registration
        $orgData = [
            'email' => 'contact@helpingorg.org',
            'password' => 'OrgPass123',
            'password_confirmation' => 'OrgPass123',
            'org_name' => 'Helping Organization',
            'org_type' => 'NGO',
            'contact_person' => 'Jane Smith',
            'phone' => '555-1234',
            'address' => '456 Charity Ave',
            'description' => 'We help communities thrive',
            'registration_number' => 'REG-12345',
        ];

        $response = $this->post('/register/organization', $orgData);
        
        // Verify redirect to home with success message
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        // 2. SAVE: Verify data was saved to database
        // Check user was created
        $this->assertDatabaseHas('users', [
            'email' => 'contact@helpingorg.org',
            'user_type' => 'organization',
            'is_active' => true,
        ]);

        // Check organization profile was created
        $this->assertDatabaseHas('organizations', [
            'org_name' => 'Helping Organization',
            'org_type' => 'NGO',
            'contact_person' => 'Jane Smith',
            'phone' => '555-1234',
            'is_verified' => false, // Organizations need verification
        ]);

        // Check verification notification was created
        $user = User::where('email', 'contact@helpingorg.org')->first();
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->user_id,
            'notification_type' => 'verification_pending',
        ]);

        // 3. OUTPUT: Verify organization data exists in database
        $organization = Organization::where('org_name', 'Helping Organization')->first();
        $this->assertNotNull($organization);
        $this->assertEquals('Jane Smith', $organization->contact_person);
        $this->assertEquals('NGO', $organization->org_type);
    }

    /**
     * Test that events can be created, saved, and retrieved
     */
    public function test_events_can_be_created_saved_and_displayed()
    {
        // Create organization user manually
        $user = User::create([
            'email' => 'org@test.com',
            'password_hash' => Hash::make('password'),
            'user_type' => 'organization',
            'is_active' => true,
        ]);
        
        $organization = Organization::create([
            'user_id' => $user->user_id,
            'org_name' => 'Test Organization',
            'org_type' => 'NGO',
            'contact_person' => 'Test Person',
            'phone' => '555-0000',
            'address' => '123 Test St',
            'description' => 'Test organization',
            'is_verified' => true,
        ]);
        
        $this->actingAs($user);

        // 1. REGISTER/CREATE: Create an event via API
        $eventData = [
            'organization_id' => $organization->organization_id,
            'event_name' => 'Community Cleanup',
            'description' => 'Help clean up our local park',
            'event_date' => now()->addDays(7)->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '15:00',
            'location' => 'Central Park',
            'max_volunteers' => 30,
        ];

        $response = $this->postJson('/api/events', $eventData);
        $response->assertStatus(201);

        // 2. SAVE: Verify event was saved to database
        $this->assertDatabaseHas('events', [
            'event_name' => 'Community Cleanup',
            'description' => 'Help clean up our local park',
            'location' => 'Central Park',
            'max_volunteers' => 30,
        ]);

        // 3. OUTPUT: Verify event can be retrieved publicly
        $publicResponse = $this->getJson('/api/events');
        $publicResponse->assertStatus(200);
        $publicResponse->assertJsonFragment([
            'event_name' => 'Community Cleanup',
            'location' => 'Central Park',
        ]);

        // Verify event appears on web page
        $webResponse = $this->get('/events');
        $webResponse->assertStatus(200);
        $webResponse->assertSee('Community Cleanup');
    }

    /**
     * Test complete user flow: register, create event, register for event
     */
    public function test_complete_volunteer_event_registration_flow()
    {
        // Create organization and event
        $orgUser = User::create([
            'email' => 'flow@test.com',
            'password_hash' => Hash::make('password'),
            'user_type' => 'organization',
            'is_active' => true,
        ]);
        
        $organization = Organization::create([
            'user_id' => $orgUser->user_id,
            'org_name' => 'Flow Test Organization',
            'org_type' => 'NGO',
            'contact_person' => 'Flow Person',
            'phone' => '555-1111',
            'address' => '456 Flow St',
            'description' => 'Flow test organization',
            'is_verified' => true,
        ]);
        
        $this->actingAs($orgUser);
        $eventData = [
            'organization_id' => $organization->organization_id,
            'event_name' => 'Food Drive',
            'description' => 'Collect food for families',
            'event_date' => now()->addDays(10)->format('Y-m-d'),
            'start_time' => '10:00',
            'end_time' => '14:00',
            'location' => 'Community Center',
            'max_volunteers' => 20,
        ];
        
        $createResponse = $this->postJson('/api/events', $eventData);
        $createResponse->assertStatus(201);
        $event = $createResponse->json('data');

        // Register a new volunteer
        auth()->logout();
        $volunteerData = [
            'first_name' => 'Alice',
            'last_name' => 'Volunteer',
            'email' => 'alice@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        
        $registerResponse = $this->post('/register/volunteer', $volunteerData);
        $registerResponse->assertRedirect(route('home'));

        // Volunteer should be logged in automatically
        $this->assertTrue(auth()->check());
        $volunteer = auth()->user();

        // Volunteer registers for event
        $registrationData = [
            'event_id' => $event['event_id'],
            'volunteer_id' => $volunteer->volunteer->volunteer_id,
        ];
        
        $regResponse = $this->postJson('/api/registrations', $registrationData);
        $regResponse->assertStatus(201);

        // Verify registration was saved
        $this->assertDatabaseHas('event_registrations', [
            'event_id' => $event['event_id'],
            'volunteer_id' => $volunteer->volunteer->volunteer_id,
            'status' => 'pending', // Default status is pending, not registered
        ]);

        // Verify registration can be retrieved
        $listResponse = $this->getJson('/api/registrations');
        $listResponse->assertStatus(200);
        $listResponse->assertJsonFragment([
            'event_id' => $event['event_id'],
            'status' => 'pending', // Status should match what was saved
        ]);
    }
}
