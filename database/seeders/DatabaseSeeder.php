<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        
        DB::table('messages')->truncate();
        DB::table('event_registrations')->truncate();
        DB::table('events')->truncate();
        DB::table('volunteers')->truncate();
        DB::table('organizations')->truncate();
        DB::table('users')->truncate();
        DB::table('skills')->truncate();
        
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // Seed in order of dependencies
        $this->seedSkills();
        $this->seedUsers();
        $this->seedVolunteers();
        $this->seedOrganizations();
        $this->seedEvents();
        $this->seedEventRegistrations();
        $this->seedMessages();

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Test Accounts Created:');
        $this->command->info('   Volunteer: volunteer1@test.com / password');
        $this->command->info('   Organization: org1@test.com / password');
    }

    private function seedSkills()
    {
        $skills = [
            ['skill_name' => 'Teaching', 'description' => 'Educational instruction and mentoring', 'category' => 'Education'],
            ['skill_name' => 'First Aid', 'description' => 'Basic medical assistance', 'category' => 'Health'],
            ['skill_name' => 'Cooking', 'description' => 'Food preparation and nutrition', 'category' => 'Food Service'],
            ['skill_name' => 'Gardening', 'description' => 'Plant care and landscaping', 'category' => 'Environment'],
            ['skill_name' => 'Photography', 'description' => 'Visual documentation', 'category' => 'Arts'],
            ['skill_name' => 'Event Planning', 'description' => 'Organization and coordination', 'category' => 'Management'],
            ['skill_name' => 'Translation', 'description' => 'Language interpretation', 'category' => 'Communication'],
            ['skill_name' => 'Computer Skills', 'description' => 'Technical assistance', 'category' => 'Technology'],
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insert([
                'skill_name' => $skill['skill_name'],
                'description' => $skill['description'],
                'category' => $skill['category'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✓ Skills seeded');
    }

    private function seedUsers()
    {
        $users = [
            // Volunteers
            ['email' => 'volunteer1@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer2@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer3@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer4@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer5@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer6@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer7@test.com', 'user_type' => 'volunteer'],
            ['email' => 'volunteer8@test.com', 'user_type' => 'volunteer'],
            
            // Organizations
            ['email' => 'org1@test.com', 'user_type' => 'organization'],
            ['email' => 'org2@test.com', 'user_type' => 'organization'],
            ['email' => 'org3@test.com', 'user_type' => 'organization'],
            ['email' => 'org4@test.com', 'user_type' => 'organization'],
            ['email' => 'org5@test.com', 'user_type' => 'organization'],
            ['email' => 'org6@test.com', 'user_type' => 'organization'],
            ['email' => 'org7@test.com', 'user_type' => 'organization'],
            // New organizations
            ['email' => 'ecohopeph@gmail.com', 'user_type' => 'organization'],
            ['email' => 'brightfutures.ph@gmail.com', 'user_type' => 'organization'],
            ['email' => 'bayanihanhands@gmail.com', 'user_type' => 'organization'],
            ['email' => 'healtogetherph@gmail.com', 'user_type' => 'organization'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'password_hash' => Hash::make('password'),
                'user_type' => $user['user_type'],
                'is_active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'last_login' => now(),
            ]);
        }

        $this->command->info('✓ Users seeded');
    }

    private function seedVolunteers()
    {
        $volunteers = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'age' => 25, 'phone' => '09171234567', 'skills' => 'Teaching, First Aid', 'interests' => 'Education, Health', 'location' => 'Quezon City', 'availability' => 'Weekends'],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'age' => 28, 'phone' => '09181234567', 'skills' => 'Cooking, Event Planning', 'interests' => 'Food Service, Community', 'location' => 'Makati City', 'availability' => 'Weekdays after 6pm'],
            ['first_name' => 'Maria', 'last_name' => 'Garcia', 'age' => 32, 'phone' => '09191234567', 'skills' => 'Gardening, Photography', 'interests' => 'Environment, Arts', 'location' => 'Manila', 'availability' => 'Saturdays'],
            ['first_name' => 'Carlos', 'last_name' => 'Rodriguez', 'age' => 22, 'phone' => '09201234567', 'skills' => 'Computer Skills, Translation', 'interests' => 'Technology, Education', 'location' => 'Pasig City', 'availability' => 'Flexible'],
            ['first_name' => 'Ana', 'last_name' => 'Martinez', 'age' => 30, 'phone' => '09211234567', 'skills' => 'First Aid, Teaching', 'interests' => 'Health, Children', 'location' => 'Taguig City', 'availability' => 'Sundays'],
            ['first_name' => 'Miguel', 'last_name' => 'Santos', 'age' => 27, 'phone' => '09221234567', 'skills' => 'Event Planning, Photography', 'interests' => 'Community, Arts', 'location' => 'San Juan City', 'availability' => 'Weekends'],
            ['first_name' => 'Sofia', 'last_name' => 'Reyes', 'age' => 24, 'phone' => '09231234567', 'skills' => 'Teaching, Translation', 'interests' => 'Education, Languages', 'location' => 'Mandaluyong', 'availability' => 'Weekdays evening'],
            ['first_name' => 'Luis', 'last_name' => 'Torres', 'age' => 29, 'phone' => '09241234567', 'skills' => 'Cooking, Gardening', 'interests' => 'Food, Environment', 'location' => 'Parañaque', 'availability' => 'Saturday mornings'],
        ];

        for ($i = 0; $i < count($volunteers); $i++) {
            $volunteer = $volunteers[$i];
            $userId = $i + 1; // User IDs start from 1

            DB::table('volunteers')->insert([
                'user_id' => $userId,
                'first_name' => $volunteer['first_name'],
                'last_name' => $volunteer['last_name'],
                'age' => $volunteer['age'],
                'phone' => $volunteer['phone'],
                'date_of_birth' => Carbon::now()->subYears($volunteer['age'])->format('Y-m-d'),
                'address' => $volunteer['location'] . ', Metro Manila',
                'bio' => "Passionate volunteer interested in making a difference in the community.",
                'skills' => $volunteer['skills'],
                'interests' => $volunteer['interests'],
                'location' => $volunteer['location'],
                'availability' => $volunteer['availability'],
                'total_hours' => rand(10, 100),
                'events_completed' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✓ Volunteers seeded');
    }

    private function seedOrganizations()
    {
        $organizations = [
            ['org_name' => 'Green Earth Foundation', 'org_type' => 'NGO', 'contact_person' => 'Lea Santos', 'description' => 'Environmental conservation and sustainability', 'founded_year' => 2015, 'rating' => 4.8],
            ['org_name' => 'Literacy For All', 'org_type' => 'Non-Profit', 'contact_person' => 'Mark Johnson', 'description' => 'Promoting education and literacy programs', 'founded_year' => 2018, 'rating' => 4.5],
            ['org_name' => 'Community Food Bank', 'org_type' => 'Charity', 'contact_person' => 'Sarah Williams', 'description' => 'Fighting hunger in local communities', 'founded_year' => 2020, 'rating' => 4.7],
            ['org_name' => 'Health First Clinic', 'org_type' => 'Medical', 'contact_person' => 'Dr. Robert Chen', 'description' => 'Providing free healthcare services', 'founded_year' => 2016, 'rating' => 4.9],
            ['org_name' => 'Art for Everyone', 'org_type' => 'Cultural', 'contact_person' => 'Elena Rodriguez', 'description' => 'Making arts accessible to all', 'founded_year' => 2019, 'rating' => 4.6],
            ['org_name' => 'Youth Empowerment Inc', 'org_type' => 'Non-Profit', 'contact_person' => 'James Brown', 'description' => 'Mentoring and supporting young people', 'founded_year' => 2017, 'rating' => 4.4],
            ['org_name' => 'Animal Rescue League', 'org_type' => 'Animal Welfare', 'contact_person' => 'Lisa Anderson', 'description' => 'Rescuing and caring for animals', 'founded_year' => 2021, 'rating' => 4.8],
            // New organizations from the problem statement
            ['org_name' => 'EcoHope PH', 'org_type' => 'NGO', 'contact_person' => 'Environmental Team', 'description' => 'Youth-led environmental organization focused on urban reforestation and eco-awareness', 'founded_year' => 2020, 'rating' => 4.7, 'email' => 'ecohopeph@gmail.com', 'phone' => '09171234567'],
            ['org_name' => 'BrightFutures Org', 'org_type' => 'Non-Profit', 'contact_person' => 'Education Coordinator', 'description' => 'Nonprofit committed to improving literacy among underprivileged children', 'founded_year' => 2019, 'rating' => 4.6, 'email' => 'brightfutures.ph@gmail.com', 'phone' => '09176543210'],
            ['org_name' => 'Bayanihan Hands', 'org_type' => 'Community', 'contact_person' => 'Community Manager', 'description' => 'Community-driven initiative providing feeding and livelihood programs', 'founded_year' => 2018, 'rating' => 4.8, 'email' => 'bayanihanhands@gmail.com', 'phone' => '09187654321'],
            ['org_name' => 'Heal Together PH', 'org_type' => 'Medical', 'contact_person' => 'Healthcare Coordinator', 'description' => 'Nonprofit organization supporting hospitals and clinics with volunteer care companions', 'founded_year' => 2017, 'rating' => 4.9, 'email' => 'healtogetherph@gmail.com', 'phone' => '09174567890'],
        ];

        for ($i = 0; $i < count($organizations); $i++) {
            $org = $organizations[$i];
            $userId = 9 + $i; // Organization user IDs start from 9

            DB::table('organizations')->insert([
                'user_id' => $userId,
                'org_name' => $org['org_name'],
                'org_type' => $org['org_type'],
                'founded_year' => $org['founded_year'],
                'registration_number' => 'REG-' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),
                'contact_person' => $org['contact_person'],
                'phone' => $org['phone'] ?? '028' . rand(1000000, 9999999),
                'address' => 'Quezon City, Metro Manila',
                'description' => $org['description'],
                'rating' => $org['rating'],
                'is_verified' => true,
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✓ Organizations seeded');
    }

    private function seedEvents()
    {
        $events = [
            ['name' => 'Tree Planting at La Mesa', 'org_id' => 1, 'category' => 'Environment', 'date' => Carbon::now()->subDays(15), 'location' => 'La Mesa Eco Park, QC', 'max' => 30, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Urban Restoration and Eco-Awareness Drive', 'org_id' => 1, 'category' => 'Environment', 'date' => Carbon::now()->subDays(10), 'location' => 'Quezon City', 'max' => 50, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Weekend Literacy Program', 'org_id' => 2, 'category' => 'Education', 'date' => Carbon::now()->subDays(8), 'location' => 'Manila Central Library', 'max' => 20, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Organic Farming Workshop', 'org_id' => 1, 'category' => 'Environment', 'date' => Carbon::now()->subDays(5), 'location' => 'Antipolo Farm', 'max' => 25, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Photography Exhibition Event', 'org_id' => 5, 'category' => 'Arts', 'date' => Carbon::now()->addDays(5), 'location' => 'National Museum', 'max' => 40, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Community Food Drive', 'org_id' => 3, 'category' => 'Community', 'date' => Carbon::now()->addDays(10), 'location' => 'Makati Community Center', 'max' => 35, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Free Medical Mission', 'org_id' => 4, 'category' => 'Health', 'date' => Carbon::now()->addDays(15), 'location' => 'Pasig Sports Complex', 'max' => 60, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Youth Leadership Camp', 'org_id' => 6, 'category' => 'Education', 'date' => Carbon::now()->addDays(20), 'location' => 'Tagaytay Highlands', 'max' => 45, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Animal Shelter Volunteering', 'org_id' => 7, 'category' => 'Animal Welfare', 'date' => Carbon::now()->addDays(7), 'location' => 'PAWS Animal Shelter', 'max' => 15, 'start' => '08:00:00', 'end' => '17:00:00'],
            ['name' => 'Beach Cleanup Campaign', 'org_id' => 1, 'category' => 'Environment', 'date' => Carbon::now()->addDays(12), 'location' => 'Manila Bay', 'max' => 80, 'start' => '08:00:00', 'end' => '17:00:00'],
            
            // New events from problem statement
            [
                'name' => 'Green Steps: Urban Restoration and Eco-Awareness Drive',
                'org_id' => 8, // EcoHope PH
                'category' => 'Environment',
                'date' => Carbon::create(2025, 11, 16),
                'start' => '08:00:00',
                'end' => '12:00:00',
                'location' => 'Barangay Escopa III, Project 4, Quezon City',
                'max' => 50,
                'description' => 'Join us in taking Green Steps toward a more sustainable Metro Manila! This weekend reforestation and eco-awareness campaign aims to restore green spaces and educate communities about sustainable living. Volunteers will help plant native trees and conduct eco-awareness activities with local residents and youth. The goal is to promote sustainability, restore biodiversity, and empower communities to take action for the environment. Meet-up Point: Barangay Escopa III Covered Court. SDGs: Climate Action (SDG 13), Life on Land (SDG 15), Sustainable Cities and Communities (SDG 11). Teams: Tree Planting Team, Eco-Education Team, Logistics Team. Contact: ecohopeph@gmail.com or 0917-123-4567'
            ],
            [
                'name' => 'Read & Rise: Weekend Literacy Program',
                'org_id' => 9, // BrightFutures Org
                'category' => 'Education',
                'date' => Carbon::now()->next('Saturday'),
                'start' => '09:00:00',
                'end' => '11:30:00',
                'location' => 'Barangay Addition Hills Community Center, Mandaluyong City',
                'max' => 30,
                'description' => 'Be a changemaker in your own city! This weekend literacy program provides free educational materials and guided reading support to help underprivileged children build confidence, comprehension, and a lifelong love of learning. Volunteers will facilitate small-group reading sessions with children aged 5-10, distribute storybooks and learning materials, and encourage participation. Sessions run every Saturday. Meet-up Point: Front gate of the community center by 8:45 AM. SDGs: Quality Education (SDG 4), Reduced Inequalities (SDG 10), No Poverty (SDG 1). Contact: brightfutures.ph@gmail.com or 0917-654-3210'
            ],
            [
                'name' => 'Kusina at Kabuhayan: Community Outreach Program',
                'org_id' => 10, // Bayanihan Hands
                'category' => 'Community',
                'date' => Carbon::create(2025, 11, 17),
                'start' => '08:00:00',
                'end' => '12:00:00',
                'location' => 'Barangay 201 Covered Court, Pasay City',
                'max' => 40,
                'description' => 'Be part of a movement that nourishes both body and future. This weekend outreach program combines feeding activities with hands-on livelihood workshops for low-income families. Volunteers will help prepare and distribute food, assist in workshop facilitation, and engage with participants to promote community empowerment and resilience. Meet-up Point: Barangay 201 gate by 7:45 AM. SDGs: Zero Hunger (SDG 2), Decent Work and Economic Growth (SDG 8), Reduced Inequalities (SDG 10). Teams: Feeding Team, Workshop Support Team, Logistics Team. Contact: bayanihanhands@gmail.com or 0918-765-4321'
            ],
            [
                'name' => 'Care Companions: Hospital Volunteer Program',
                'org_id' => 11, // Heal Together PH
                'category' => 'Health',
                'date' => Carbon::now()->next('Saturday'),
                'start' => '09:00:00',
                'end' => '12:00:00',
                'location' => 'Outpatient Wing, Pasay City General Hospital',
                'max' => 20,
                'description' => 'Make healing more human. This hospital-based volunteer program provides emotional and practical support to patients in public hospitals. Volunteers assist with non-medical tasks such as helping patients with directions and forms, offering companionship and emotional support, distributing snacks and hygiene kits, and supporting hospital staff with simple tasks. Sessions run every Saturday. Meet-up Point: Hospital lobby by 8:45 AM. SDGs: Good Health and Well-being (SDG 3), Reduced Inequalities (SDG 10), Partnerships for the Goals (SDG 17). Contact: healtogetherph@gmail.com or 0917-456-7890'
            ],
            [
                'name' => 'Tindahan ng Pag-asa: Pop-up Livelihood Fair',
                'org_id' => 10, // Bayanihan Hands
                'category' => 'Economic Development',
                'date' => Carbon::create(2025, 11, 10),
                'start' => '09:00:00',
                'end' => '13:00:00',
                'location' => 'Barangay Hall Grounds, Brgy. Bagong Silang, Caloocan City',
                'max' => 35,
                'description' => 'Help families build sustainable futures! This weekend pop-up livelihood fair showcases community-made products and offers hands-on workshops for low-income families. The event features pop-up stalls selling handmade goods, food items, and crafts, alongside mini-workshops on budgeting, marketing, and product development. Volunteers help create a welcoming and organized space where families can learn, earn, and grow. Runs from November 10-15, 2025. Meet-up Point: Barangay Hall entrance by 8:30 AM. SDGs: Decent Work and Economic Growth (SDG 8), No Poverty (SDG 1), Reduced Inequalities (SDG 10). Teams: Booth Support Team, Workshop Assistance Team, Logistics Team. Contact: bayanihanhands@gmail.com or 0918-765-4321'
            ],
        ];

        foreach ($events as $event) {
            DB::table('events')->insert([
                'organization_id' => $event['org_id'],
                'event_name' => $event['name'],
                'description' => $event['description'] ?? 'Join us for ' . strtolower($event['name']) . '. This is a great opportunity to give back to the community and make a difference.',
                'category' => $event['category'],
                'event_date' => $event['date']->format('Y-m-d'),
                'start_time' => $event['start'],
                'end_time' => $event['end'],
                'location' => $event['location'],
                'max_volunteers' => $event['max'],
                'registered_count' => rand(5, $event['max'] - 5),
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✓ Events seeded');
    }

    private function seedEventRegistrations()
    {
        // Register volunteers for multiple events
        $registrations = [
            // Volunteer 1 - John
            ['volunteer_id' => 1, 'event_id' => 1, 'status' => 'approved', 'hours_contributed' => 2],
            ['volunteer_id' => 1, 'event_id' => 2, 'status' => 'approved', 'hours_contributed' => 3],
            ['volunteer_id' => 1, 'event_id' => 3, 'status' => 'approved', 'hours_contributed' => 4],
            ['volunteer_id' => 1, 'event_id' => 4, 'status' => 'pending', 'hours_contributed' => 0],
            ['volunteer_id' => 1, 'event_id' => 5, 'status' => 'approved', 'hours_contributed' => 0],
            
            // Volunteer 2 - Jane
            ['volunteer_id' => 2, 'event_id' => 1, 'status' => 'approved', 'hours_contributed' => 2],
            ['volunteer_id' => 2, 'event_id' => 6, 'status' => 'approved', 'hours_contributed' => 5],
            ['volunteer_id' => 2, 'event_id' => 7, 'status' => 'pending', 'hours_contributed' => 0],
            ['volunteer_id' => 2, 'event_id' => 5, 'status' => 'pending', 'hours_contributed' => 0],
            
            // Volunteer 3 - Maria
            ['volunteer_id' => 3, 'event_id' => 2, 'status' => 'approved', 'hours_contributed' => 3],
            ['volunteer_id' => 3, 'event_id' => 4, 'status' => 'approved', 'hours_contributed' => 6],
            ['volunteer_id' => 3, 'event_id' => 5, 'status' => 'approved', 'hours_contributed' => 0],
            ['volunteer_id' => 3, 'event_id' => 10, 'status' => 'pending', 'hours_contributed' => 0],
            ['volunteer_id' => 3, 'event_id' => 6, 'status' => 'pending', 'hours_contributed' => 0],
            
            // Volunteer 4 - Carlos
            ['volunteer_id' => 4, 'event_id' => 3, 'status' => 'approved', 'hours_contributed' => 4],
            ['volunteer_id' => 4, 'event_id' => 8, 'status' => 'approved', 'hours_contributed' => 0],
            ['volunteer_id' => 4, 'event_id' => 9, 'status' => 'rejected', 'hours_contributed' => 0],
            ['volunteer_id' => 4, 'event_id' => 7, 'status' => 'pending', 'hours_contributed' => 0],
            
            // More volunteers with more pending applications
            ['volunteer_id' => 5, 'event_id' => 2, 'status' => 'approved', 'hours_contributed' => 3],
            ['volunteer_id' => 5, 'event_id' => 7, 'status' => 'approved', 'hours_contributed' => 0],
            ['volunteer_id' => 5, 'event_id' => 10, 'status' => 'pending', 'hours_contributed' => 0],
            
            ['volunteer_id' => 6, 'event_id' => 5, 'status' => 'approved', 'hours_contributed' => 0],
            ['volunteer_id' => 6, 'event_id' => 6, 'status' => 'pending', 'hours_contributed' => 0],
            ['volunteer_id' => 6, 'event_id' => 8, 'status' => 'pending', 'hours_contributed' => 0],
            
            ['volunteer_id' => 7, 'event_id' => 3, 'status' => 'approved', 'hours_contributed' => 4],
            ['volunteer_id' => 7, 'event_id' => 9, 'status' => 'pending', 'hours_contributed' => 0],
            
            ['volunteer_id' => 8, 'event_id' => 9, 'status' => 'approved', 'hours_contributed' => 0],
            ['volunteer_id' => 8, 'event_id' => 1, 'status' => 'pending', 'hours_contributed' => 0],
        ];

        foreach ($registrations as $reg) {
            $isPastEvent = DB::table('events')->where('event_id', $reg['event_id'])->value('event_date') < now();
            
            DB::table('event_registrations')->insert([
                'volunteer_id' => $reg['volunteer_id'],
                'event_id' => $reg['event_id'],
                'status' => $reg['status'],
                'hours_contributed' => $reg['hours_contributed'],
                'certificate_issued' => $isPastEvent && $reg['status'] === 'approved',
                'registered_at' => now()->subDays(rand(1, 30)),
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(0, 5)),
            ]);
        }

        $this->command->info('✓ Event Registrations seeded');
    }

    private function seedMessages()
    {
        $messages = [
            // Organization 1 (Green Earth) to Volunteer 1 (John)
            ['sender_id' => 9, 'receiver_id' => 1, 'message' => 'Hello John! Your application for Urban Restoration and Eco-Awareness Drive has been approved. Looking forward to seeing you!', 'created_at' => Carbon::now()->subDays(9)],
            ['sender_id' => 1, 'receiver_id' => 9, 'message' => 'Thank you! What time should I arrive?', 'created_at' => Carbon::now()->subDays(9)->addHours(2)],
            ['sender_id' => 9, 'receiver_id' => 1, 'message' => 'Please arrive by 8:00 AM. Bring sunscreen and water!', 'created_at' => Carbon::now()->subDays(9)->addHours(3)],
            
            // Organization 2 (Literacy) to Volunteer 1 (John)
            ['sender_id' => 10, 'receiver_id' => 1, 'message' => 'Great news! You have been approved for the Weekend Literacy Program.', 'created_at' => Carbon::now()->subDays(7)],
            ['sender_id' => 1, 'receiver_id' => 10, 'message' => 'Wonderful! Do I need to prepare anything?', 'created_at' => Carbon::now()->subDays(7)->addHours(1)],
            
            // Organization 5 (Art) to Volunteer 1 (John)
            ['sender_id' => 13, 'receiver_id' => 1, 'message' => 'Hi John! Thank you for your interest in the photography exhibition. Your application is approved!', 'created_at' => Carbon::now()->subDays(2), 'is_read' => false],
            
            // Organization 3 (Food Bank) to Volunteer 2 (Jane)
            ['sender_id' => 11, 'receiver_id' => 2, 'message' => 'Hello Jane! We are excited to have you join our Community Food Drive next week.', 'created_at' => Carbon::now()->subDays(5)],
            ['sender_id' => 2, 'receiver_id' => 11, 'message' => 'Thank you! I am looking forward to it.', 'created_at' => Carbon::now()->subDays(5)->addHours(4)],
            
            // Organization 4 (Health) to Volunteer 2 (Jane)
            ['sender_id' => 12, 'receiver_id' => 2, 'message' => 'Your application for the Free Medical Mission is currently pending review.', 'created_at' => Carbon::now()->subDays(1), 'is_read' => false],
            
            // Organization 1 to Volunteer 3 (Maria)
            ['sender_id' => 9, 'receiver_id' => 3, 'message' => 'Hi Maria! Your application for the Organic Farming Workshop has been approved.', 'created_at' => Carbon::now()->subDays(4)],
            
            // Organization 5 to Volunteer 3 (Maria)
            ['sender_id' => 13, 'receiver_id' => 3, 'message' => 'Hello! We would love to have you as a photographer for our exhibition.', 'created_at' => Carbon::now()->subHours(12), 'is_read' => false],
            
            // Organization 2 to Volunteer 4 (Carlos)
            ['sender_id' => 10, 'receiver_id' => 4, 'message' => 'Congratulations! You have been selected for the Weekend Literacy Program.', 'created_at' => Carbon::now()->subDays(6)],
            
            // Organization 7 (Animal) to Volunteer 4 (Carlos)
            ['sender_id' => 15, 'receiver_id' => 4, 'message' => 'Unfortunately, your application for Animal Shelter Volunteering was not approved this time. We encourage you to apply again!', 'created_at' => Carbon::now()->subDays(3)],
            
            // More messages for other volunteers
            ['sender_id' => 9, 'receiver_id' => 5, 'message' => 'Welcome to our Urban Restoration event! We are glad to have you.', 'created_at' => Carbon::now()->subDays(8)],
            ['sender_id' => 12, 'receiver_id' => 5, 'message' => 'Your medical mission application is approved. See you there!', 'created_at' => Carbon::now()->subDays(2)],
        ];

        foreach ($messages as $msg) {
            DB::table('messages')->insert([
                'sender_id' => $msg['sender_id'],
                'receiver_id' => $msg['receiver_id'],
                'message' => $msg['message'],
                'is_read' => $msg['is_read'] ?? true,
                'read_at' => isset($msg['is_read']) && !$msg['is_read'] ? null : $msg['created_at']->addMinutes(rand(10, 60)),
                'created_at' => $msg['created_at'],
                'updated_at' => $msg['created_at'],
            ]);
        }

        $this->command->info('✓ Messages seeded');
    }
}