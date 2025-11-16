# OneHelp Backend Documentation

## Table of Contents
1. [Overview](#overview)
2. [Technology Stack](#technology-stack)
3. [Project Structure](#project-structure)
4. [Database Architecture](#database-architecture)
5. [Models and Relationships](#models-and-relationships)
6. [API Endpoints](#api-endpoints)
7. [Controllers](#controllers)
8. [Authentication & Authorization](#authentication--authorization)
9. [Middleware](#middleware)
10. [Key Features Implementation](#key-features-implementation)
11. [Testing](#testing)
12. [Development Workflow](#development-workflow)

---

## Overview

OneHelp is a comprehensive volunteer management platform built with Laravel 12, designed to connect volunteers with organizations and manage volunteer events efficiently. The backend provides a robust RESTful API for managing users, events, registrations, and more.

### Architecture Pattern
- **Framework**: Laravel 12 (MVC Pattern)
- **API Type**: RESTful API with session-based authentication
- **Database**: SQLite (development), MariaDB/MySQL (production)
- **Design Pattern**: Repository pattern via Eloquent ORM

---

## Technology Stack

### Core Technologies
- **PHP**: 8.2+
- **Laravel**: 12.0
- **Database**: SQLite (dev), MariaDB (production)
- **Authentication**: Laravel's built-in session-based auth
- **Testing**: PHPUnit 11.5

### Key Dependencies
```json
{
  "barryvdh/laravel-dompdf": "^3.1",      // PDF generation for reports
  "maatwebsite/excel": "^3.1",            // Excel export functionality
  "laravel/tinker": "^2.10.1"             // REPL for debugging
}
```

**Location**: `composer.json`

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/                     # API and web controllers
│   │   ├── UserController.php          # User management
│   │   ├── EventController.php         # Event CRUD operations
│   │   ├── VolunteerController.php     # Volunteer management
│   │   ├── OrganizationController.php  # Organization management
│   │   ├── EventRegistrationController.php  # Event registration logic
│   │   ├── AIAssistantController.php   # AI-powered features
│   │   ├── NotificationController.php  # Notification system
│   │   ├── FeedbackController.php      # Feedback collection
│   │   ├── AttendanceController.php    # Attendance tracking
│   │   ├── SkillController.php         # Skills management
│   │   ├── OrganizationVerificationController.php  # Verification workflow
│   │   ├── AdminController.php         # Admin operations
│   │   ├── ReportController.php        # Report generation
│   │   └── Auth/                       # Authentication controllers
│   │       ├── LoginController.php
│   │       └── RegisterController.php
│   │
│   ├── Middleware/                      # Custom middleware
│   │   ├── ApiAuthMiddleware.php       # API authentication
│   │   ├── SecurityHeaders.php         # Security headers (CSP, etc.)
│   │   ├── SanitizeInput.php          # Input sanitization
│   │   └── VerifiedOrganization.php    # Organization verification check
│   │
│   └── Requests/                        # Form request validation
│
├── Models/                              # Eloquent models
│   ├── User.php                        # User model (volunteers, orgs, admins)
│   ├── Volunteer.php                   # Volunteer profile
│   ├── Organization.php                # Organization profile
│   ├── Event.php                       # Volunteer events
│   ├── EventRegistration.php           # Event registrations
│   ├── Skill.php                       # Skills catalog
│   ├── VolunteerSkill.php             # Volunteer-skill pivot
│   ├── EventSkill.php                  # Event-skill pivot
│   ├── Attendance.php                  # Attendance records
│   ├── Notification.php                # User notifications
│   ├── Feedback.php                    # Event feedback
│   ├── Message.php                     # Messaging system
│   ├── OrganizationVerification.php    # Verification requests
│   └── EventImage.php                  # Event images
│
├── Exceptions/                          # Custom exceptions
└── Providers/                           # Service providers
    └── AppServiceProvider.php

database/
├── migrations/                          # Database migrations
├── seeders/                            # Database seeders
│   └── DemoDataSeeder.php              # Demo data for testing
└── factories/                          # Model factories for testing

routes/
├── api.php                             # API routes (prefixed with /api)
├── web.php                             # Web routes
└── console.php                         # Console commands

tests/
├── Feature/                            # Feature tests
│   └── Security/                       # Security-specific tests
└── Unit/                               # Unit tests

config/
├── app.php                             # Application configuration
├── database.php                        # Database configuration
├── auth.php                            # Authentication configuration
├── services.php                        # Third-party services (AI APIs)
└── ...                                 # Other config files
```

---

## Database Architecture

### Database Schema Overview

The application uses a relational database with the following core tables:

#### Core Tables

**users** - User accounts (volunteers, organizations, admins)
```php
// Location: database/migrations/0001_01_01_000000_create_users_table.php
user_id (PK)
email
password_hash
user_type (volunteer|organization|admin)
is_active
created_at
last_login
email_verified_at
deleted_at (soft deletes)
```

**volunteers** - Volunteer profiles
```php
// Location: database/migrations/2025_10_29_135229_create_volunteers_table.php
volunteer_id (PK)
user_id (FK -> users)
first_name
last_name
age
phone
address
date_of_birth
bio
profile_image
skills (JSON)
interests (JSON)
location
availability (JSON)
total_hours
events_completed
created_at, updated_at
```

**organizations** - Organization profiles
```php
// Location: database/migrations/2025_10_29_135338_create_organizations_table.php
organization_id (PK)
user_id (FK -> users)
org_name
org_type
founded_year
registration_number
contact_person
phone
address
description
rating
logo_image
is_verified
verified_at
created_at, updated_at
```

**events** - Volunteer events
```php
// Location: database/migrations/2025_10_29_135437_create_events_table.php
event_id (PK)
organization_id (FK -> organizations)
event_name
description
long_description
category
event_date
start_time
end_time
location
max_volunteers
registered_count
status (open|closed|cancelled)
created_at, updated_at
```

**event_registrations** - Volunteer registrations for events
```php
// Location: database/migrations/2025_10_29_135732_create_event_registrations_table.php
registration_id (PK)
event_id (FK -> events)
volunteer_id (FK -> volunteers)
status (pending|confirmed|rejected|cancelled)
registration_date
cancellation_reason
created_at, updated_at
```

#### Supporting Tables

**skills** - Skills catalog
```php
// Location: database/migrations/2025_10_29_135802_create_skills_table.php
skill_id (PK)
skill_name
category
created_at, updated_at
```

**volunteer_skills** - Pivot table (volunteer-skill many-to-many)
```php
// Location: database/migrations/2025_10_29_135823_create_volunteer_skills_table.php
volunteer_id (FK -> volunteers)
skill_id (FK -> skills)
proficiency_level
created_at, updated_at
PRIMARY KEY (volunteer_id, skill_id)
```

**event_skills** - Pivot table (event-skill many-to-many)
```php
// Location: database/migrations/2025_10_29_135920_create_event_skills_table.php
event_id (FK -> events)
skill_id (FK -> skills)
is_required
created_at, updated_at
PRIMARY KEY (event_id, skill_id)
```

**attendances** - Attendance tracking
```php
// Location: database/migrations/2025_10_29_140012_create_attendances_table.php
attendance_id (PK)
registration_id (FK -> event_registrations)
check_in_time
check_out_time
hours_worked
status (present|absent|late)
created_at, updated_at
```

**notifications** - User notifications
```php
// Location: database/migrations/2025_10_29_140205_create_notifications_table.php
notification_id (PK)
user_id (FK -> users)
type
message
is_read
created_at, updated_at
```

**feedbacks** - Event feedback from volunteers
```php
// Location: database/migrations/2025_10_29_140249_create_feedbacks_table.php
feedback_id (PK)
event_id (FK -> events)
volunteer_id (FK -> volunteers)
rating (1-5)
comments
created_at, updated_at
```

**organization_verifications** - Organization verification workflow
```php
// Location: database/migrations/2025_10_29_140057_create_organization_verifications_table.php
verification_id (PK)
organization_id (FK -> organizations)
document_type
document_url
status (pending|approved|rejected)
submitted_at
verified_at
verified_by (FK -> users)
notes
admin_notes
created_at, updated_at
```

**messages** - Internal messaging system
```php
// Location: database/migrations/2025_11_05_232911_create_messages_table.php
message_id (PK)
sender_id (FK -> users)
receiver_id (FK -> users)
subject
body
is_read
created_at, updated_at
```

**event_images** - Event images/photos
```php
// Location: database/migrations/2025_10_29_135952_create_event_images_table.php
image_id (PK)
event_id (FK -> events)
image_url
is_primary
created_at, updated_at
```

### Database Relationships Diagram

```
users (1) ──────┬───── (1) volunteers
                │
                └───── (1) organizations
                       │
                       └───── (many) events
                              │
                              └───── (many) event_registrations ───── (many) volunteers
                                     │
                                     └───── (many) attendances

skills (many) ──── volunteer_skills ──── (many) volunteers
skills (many) ──── event_skills ──── (many) events

users (many) ───── (many) notifications
users (many) ───── (many) messages (as sender/receiver)
events (many) ───── (many) feedbacks ───── (many) volunteers
organizations (many) ───── (many) organization_verifications
```

---

## Models and Relationships

### User Model
**Location**: `app/Models/User.php`

The User model is the central authentication model that uses Laravel's Authenticatable trait.

#### Key Features:
- **Non-standard primary key**: Uses `user_id` instead of `id`
- **Timestamps disabled**: `public $timestamps = false` (manages timestamps manually)
- **Soft deletes**: Supports soft deletion via `SoftDeletes` trait
- **Password hashing**: Uses `password_hash` column instead of `password`

#### Code Example:
```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'user_id';
    public $timestamps = false;  // Manual timestamp management

    protected $fillable = [
        'email', 
        'password_hash', 
        'user_type',     // volunteer|organization|admin
        'created_at', 
        'last_login', 
        'is_active'
    ];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    // Override default password column
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Relationships
    public function volunteer() {
        return $this->hasOne(Volunteer::class, 'user_id', 'user_id');
    }

    public function organization() {
        return $this->hasOne(Organization::class, 'user_id', 'user_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id', 'user_id');
    }

    public function sentMessages() {
        return $this->hasMany(Message::class, 'sender_id', 'user_id');
    }

    public function receivedMessages() {
        return $this->hasMany(Message::class, 'receiver_id', 'user_id');
    }

    // Helper methods
    public function isVolunteer() {
        return $this->user_type === 'volunteer';
    }

    public function isOrganization() {
        return $this->user_type === 'organization';
    }

    public function isAdmin() {
        return $this->user_type === 'admin';
    }

    public function updateLastLogin() {
        $this->last_login = now();
        $this->save();
    }
}
```

### Event Model
**Location**: `app/Models/Event.php`

Manages volunteer events created by organizations.

#### Relationships:
```php
class Event extends Model
{
    protected $primaryKey = 'event_id';
    
    protected $fillable = [
        'organization_id', 'event_name', 'description', 
        'long_description', 'category', 'event_date', 
        'start_time', 'end_time', 'location',
        'max_volunteers', 'registered_count', 'status'
    ];

    // Belongs to one organization
    public function organization() {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    // Has many registrations
    public function registrations() {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }

    // Many-to-many with skills
    public function skills() {
        return $this->belongsToMany(Skill::class, 'event_skills', 'event_id', 'skill_id')
                    ->withPivot('is_required')
                    ->withTimestamps();
    }

    // Has many images
    public function images() {
        return $this->hasMany(EventImage::class, 'event_id');
    }

    // Has one primary image
    public function primaryImage() {
        return $this->hasOne(EventImage::class, 'event_id')
                    ->where('is_primary', true);
    }
}
```

### Volunteer Model
**Location**: `app/Models/Volunteer.php`

Extended profile information for volunteer users.

```php
class Volunteer extends Model
{
    protected $primaryKey = 'volunteer_id';
    
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'age', 'phone',
        'address', 'date_of_birth', 'bio', 'profile_image',
        'skills', 'interests', 'location', 'availability',
        'total_hours', 'events_completed'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registrations() {
        return $this->hasMany(EventRegistration::class, 'volunteer_id');
    }

    // Many-to-many with skills
    public function skills() {
        return $this->belongsToMany(Skill::class, 'volunteer_skills', 'volunteer_id', 'skill_id')
                    ->withPivot('proficiency_level')
                    ->withTimestamps();
    }
}
```

### Organization Model
**Location**: `app/Models/Organization.php`

Extended profile for organization users who create events.

```php
class Organization extends Model
{
    protected $primaryKey = 'organization_id';

    protected $fillable = [
        'user_id', 'org_name', 'org_type', 'founded_year',
        'registration_number', 'contact_person', 'phone',
        'address', 'description', 'rating', 'logo_image',
        'is_verified', 'verified_at'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'rating' => 'decimal:2'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function events() {
        return $this->hasMany(Event::class, 'organization_id', 'organization_id');
    }

    // Access all registrations through events
    public function eventRegistrations() {
        return $this->hasManyThrough(
            EventRegistration::class,
            Event::class,
            'organization_id',
            'event_id',
            'organization_id',
            'event_id'
        );
    }
}
```

---

## API Endpoints

### Route Configuration
**Location**: `routes/api.php`

All API routes are automatically prefixed with `/api`. The route file uses grouped imports and `Route::apiResource()` for RESTful resource routing.

### Public Endpoints (No Authentication)

```php
// Events - Public viewing
GET  /api/events              // List all upcoming events
GET  /api/events/{id}         // Get specific event details

// Skills - Public catalog
GET  /api/skills              // List all skills
GET  /api/skills/{id}         // Get specific skill details
```

### Protected Endpoints (Requires Authentication)

All protected routes use the `api.auth` middleware:

```php
Route::middleware(['api.auth'])->group(function () {
    // User Management (Admin only)
    Route::apiResource('users', UserController::class);
    
    // Volunteer Management
    Route::apiResource('volunteers', VolunteerController::class);
    
    // Organization Management
    Route::apiResource('organizations', OrganizationController::class);
    
    // Event Management (Organizations)
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
    
    // Event Registrations
    Route::apiResource('registrations', EventRegistrationController::class);
    Route::post('/events/{event}/register', [EventRegistrationController::class, 'store']);
    
    // Other Resources
    Route::apiResource('skills', SkillController::class);
    Route::apiResource('attendances', AttendanceController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('feedbacks', FeedbackController::class);
    Route::apiResource('verifications', OrganizationVerificationController::class);
    
    // AI Assistant
    Route::post('/ai/generate-event-description', [AIAssistantController::class, 'generateEventDescription']);
});
```

### API Response Format

All API responses follow a consistent structure:

```json
{
    "success": true,
    "message": "Optional message",
    "data": {} or []
}
```

Error responses (validation, auth, etc.):
```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        "field_name": ["Validation error message"]
    }
}
```

---

## Controllers

### UserController
**Location**: `app/Http/Controllers/UserController.php`

Manages user accounts with role-based access control.

#### Key Methods:

**index()** - List all users (Admin only)
```php
public function index() {
    if (!Auth::user()->isAdmin()) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Admin access required.'
        ], 403);
    }

    return response()->json([
        'success' => true,
        'data' => User::all()
    ]);
}
```

**store()** - Create new user (Admin only)
```php
public function store(Request $request) {
    $validated = $request->validate([
        'email' => 'required|email|unique:users,email|max:255',
        'password' => 'required|string|min:8|max:255',
        'user_type' => 'required|in:volunteer,organization,admin',
        'is_active' => 'boolean',
    ]);

    $user = User::create([
        'email' => $validated['email'],
        'password_hash' => Hash::make($validated['password']),
        'user_type' => $validated['user_type'],
        'is_active' => $validated['is_active'] ?? true,
        'created_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'User created successfully',
        'data' => $user
    ], 201);
}
```

**update()** - Update user (Own profile or Admin)
```php
public function update(Request $request, $id) {
    $user = User::findOrFail($id);

    // Authorization check
    if (Auth::id() !== (int)$id && !Auth::user()->isAdmin()) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. You can only update your own profile.'
        ], 403);
    }

    $validated = $request->validate([
        'email' => ['sometimes', 'email', 'max:255', 
                    Rule::unique('users')->ignore($user->user_id, 'user_id')],
        'password' => 'sometimes|string|min:8|max:255',
        'is_active' => 'sometimes|boolean',
    ]);

    $updateData = [];
    if (isset($validated['email'])) {
        $updateData['email'] = $validated['email'];
    }
    if (isset($validated['password'])) {
        $updateData['password_hash'] = Hash::make($validated['password']);
    }
    if (isset($validated['is_active']) && Auth::user()->isAdmin()) {
        $updateData['is_active'] = $validated['is_active'];
    }

    $user->update($updateData);

    return response()->json([
        'success' => true,
        'message' => 'User updated successfully',
        'data' => $user
    ]);
}
```

### EventController
**Location**: `app/Http/Controllers/EventController.php`

Manages volunteer events with organization-specific permissions.

#### Key Authorization Logic:

**store()** - Create event (Organizations only)
```php
public function store(Request $request) {
    // Only organizations can create events
    if (!Auth::user()->isOrganization()) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Only organizations can create events.'
        ], 403);
    }

    $validated = $request->validate([
        'organization_id' => 'required|exists:organizations,organization_id',
        'event_name' => 'required|string|max:255',
        'description' => 'required|string',
        'event_date' => 'required|date|after:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'location' => 'required|string|max:255',
        'max_volunteers' => 'required|integer|min:1|max:10000',
    ]);

    // Verify organization belongs to authenticated user
    $organization = Organization::where('organization_id', $validated['organization_id'])
        ->where('user_id', Auth::id())
        ->first();

    if (!$organization) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. You can only create events for your own organization.'
        ], 403);
    }

    // Verify organization is verified
    if (!$organization->is_verified) {
        return response()->json([
            'success' => false,
            'message' => 'Your organization must be verified before creating events.'
        ], 403);
    }

    $event = Event::create(array_merge($validated, ['created_at' => now()]));

    return response()->json([
        'success' => true,
        'message' => 'Event created successfully',
        'data' => $event->load(['organization', 'skills', 'images'])
    ], 201);
}
```

**update()** - Update event (Own organization only)
```php
public function update(Request $request, $id) {
    $event = Event::findOrFail($id);

    // Only the organization that created the event can update it
    $organization = Organization::where('user_id', Auth::id())->first();
    
    if (!$organization || $event->organization_id !== $organization->organization_id) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. You can only update your own events.'
        ], 403);
    }

    $validated = $request->validate([
        'event_name' => 'sometimes|string|max:255',
        'description' => 'sometimes|string',
        'event_date' => 'sometimes|date',
        'location' => 'sometimes|string|max:255',
        'status' => 'sometimes|in:open,closed,cancelled',
    ]);

    $event->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Event updated successfully',
        'data' => $event->load(['organization', 'skills', 'images'])
    ]);
}
```

### AIAssistantController
**Location**: `app/Http/Controllers/AIAssistantController.php`

Provides AI-powered event description generation using OpenAI API or template fallback.

#### Features:
- Integrates with OpenAI API (if configured)
- Falls back to template-based generation
- Category-specific templates (Environment, Education, Health, etc.)

```php
public function generateEventDescription(Request $request)
{
    $request->validate([
        'event_name' => 'required|string|max:255',
        'category' => 'nullable|string|max:100',
        'location' => 'nullable|string|max:255',
    ]);

    $eventName = $request->input('event_name');
    $category = $request->input('category', 'Community Service');
    $location = $request->input('location', '');

    try {
        $description = $this->generateDescription($eventName, $category, $location);

        return response()->json([
            'success' => true,
            'description' => $description,
        ]);
    } catch (\Exception $e) {
        Log::error('AI Description Generation Error: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Failed to generate description. Please try again.',
        ], 500);
    }
}

private function generateWithOpenAI($eventName, $category, $location, $apiKey)
{
    $prompt = "Write a compelling volunteer event description for '{$eventName}' 
               in the {$category} category...";

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant...'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 500,
    ]);

    if ($response->successful()) {
        return trim($response->json()['choices'][0]['message']['content']);
    }

    return $this->generateWithTemplate($eventName, $category, $location);
}
```

### OrganizationVerificationController
**Location**: `app/Http/Controllers/OrganizationVerificationController.php`

Handles the organization verification workflow.

#### Workflow:
1. Organization submits verification request with documents
2. Admin reviews and approves/rejects
3. Organization's `is_verified` status is updated

```php
public function store(Request $request) {
    if (!Auth::user()->isOrganization()) {
        return response()->json([
            'success' => false,
            'message' => 'Only organizations can submit verification requests'
        ], 403);
    }

    $validated = $request->validate([
        'organization_id' => 'required|exists:organizations,organization_id',
        'document_type' => 'required|string|in:registration_certificate,tax_certificate,other',
        'document_url' => 'required|string|max:500',
        'notes' => 'nullable|string|max:1000',
    ]);

    // Verify ownership
    $organization = Organization::where('organization_id', $validated['organization_id'])
        ->where('user_id', Auth::id())
        ->first();

    if (!$organization) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. You can only submit verification for your own organization.'
        ], 403);
    }

    // Check for existing pending verification
    $existing = OrganizationVerification::where('organization_id', $validated['organization_id'])
        ->where('status', 'pending')
        ->first();

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'A verification request is already pending'
        ], 400);
    }

    $verification = OrganizationVerification::create(array_merge($validated, [
        'status' => 'pending',
        'submitted_at' => now(),
    ]));

    return response()->json([
        'success' => true,
        'message' => 'Verification request submitted successfully',
        'data' => $verification->load('organization')
    ], 201);
}
```

---

## Authentication & Authorization

### Authentication Flow

**Location**: Session-based authentication using Laravel's built-in auth system

#### Login Process:
1. User submits credentials via `/login` (web form)
2. `LoginController` validates credentials
3. Session is established
4. User can access protected API endpoints

#### Session Management:
```php
// Location: config/session.php
'driver' => env('SESSION_DRIVER', 'file'),
'lifetime' => 120,  // minutes
'expire_on_close' => false,
```

### Authorization Patterns

#### Role-Based Access Control (RBAC)

The application implements RBAC through user types:
- **Admin**: Full system access
- **Organization**: Can create/manage events
- **Volunteer**: Can register for events

#### Helper Methods in User Model:
```php
public function isVolunteer() {
    return $this->user_type === 'volunteer';
}

public function isOrganization() {
    return $this->user_type === 'organization';
}

public function isAdmin() {
    return $this->user_type === 'admin';
}
```

#### Authorization Examples:

**Admin-only access:**
```php
if (!Auth::user()->isAdmin()) {
    return response()->json([
        'success' => false,
        'message' => 'Unauthorized. Admin access required.'
    ], 403);
}
```

**Organization-only access:**
```php
if (!Auth::user()->isOrganization()) {
    return response()->json([
        'success' => false,
        'message' => 'Only organizations can create events.'
    ], 403);
}
```

**Resource ownership check:**
```php
$organization = Organization::where('user_id', Auth::id())->first();

if (!$organization || $event->organization_id !== $organization->organization_id) {
    return response()->json([
        'success' => false,
        'message' => 'Unauthorized. You can only modify your own resources.'
    ], 403);
}
```

---

## Middleware

### ApiAuthMiddleware
**Location**: `app/Http/Middleware/ApiAuthMiddleware.php`

Ensures API requests are authenticated via session.

```php
public function handle(Request $request, Closure $next): Response
{
    if (!auth()->check()) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated. Please login to access this resource.'
        ], 401);
    }

    return $next($request);
}
```

**Usage in routes:**
```php
Route::middleware(['api.auth'])->group(function () {
    // Protected routes here
});
```

### SecurityHeaders
**Location**: `app/Http/Middleware/SecurityHeaders.php`

Adds security headers to responses (CSP, X-Frame-Options, etc.).

```php
public function handle(Request $request, Closure $next): Response
{
    $response = $next($request);
    
    return $response->withHeaders([
        'X-Frame-Options' => 'DENY',
        'X-Content-Type-Options' => 'nosniff',
        'X-XSS-Protection' => '1; mode=block',
        'Content-Security-Policy' => "default-src 'self'",
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
    ]);
}
```

### SanitizeInput
**Location**: `app/Http/Middleware/SanitizeInput.php`

Sanitizes user input to prevent XSS attacks.

```php
public function handle(Request $request, Closure $next): Response
{
    $input = $request->all();
    
    array_walk_recursive($input, function (&$item) {
        if (is_string($item)) {
            $item = strip_tags($item);
        }
    });
    
    $request->merge($input);
    
    return $next($request);
}
```

### VerifiedOrganization
**Location**: `app/Http/Middleware/VerifiedOrganization.php`

Ensures organizations are verified before performing certain actions.

```php
public function handle(Request $request, Closure $next): Response
{
    $user = Auth::user();
    
    if ($user->isOrganization()) {
        $organization = $user->organization;
        
        if (!$organization || !$organization->is_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Your organization must be verified first.'
            ], 403);
        }
    }
    
    return $next($request);
}
```

### Middleware Registration
**Location**: `bootstrap/app.php` or `app/Http/Kernel.php`

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'api.auth' => \App\Http\Middleware\ApiAuthMiddleware::class,
        'sanitize' => \App\Http\Middleware\SanitizeInput::class,
        'verified.org' => \App\Http\Middleware\VerifiedOrganization::class,
    ]);
})
```

---

## Key Features Implementation

### 1. Event Registration System

**Controllers**: `EventRegistrationController.php`
**Models**: `EventRegistration.php`, `Event.php`, `Volunteer.php`

#### Registration Flow:
```php
// POST /api/events/{event}/register
public function store(Request $request) {
    $validated = $request->validate([
        'event_id' => 'required|exists:events,event_id',
        'volunteer_id' => 'required|exists:volunteers,volunteer_id',
    ]);

    $event = Event::findOrFail($validated['event_id']);
    
    // Check if event is full
    if ($event->registered_count >= $event->max_volunteers) {
        return response()->json([
            'success' => false,
            'message' => 'Event is full'
        ], 400);
    }

    // Check for duplicate registration
    $existing = EventRegistration::where('event_id', $event->event_id)
        ->where('volunteer_id', $validated['volunteer_id'])
        ->first();

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'Already registered for this event'
        ], 400);
    }

    $registration = EventRegistration::create([
        'event_id' => $event->event_id,
        'volunteer_id' => $validated['volunteer_id'],
        'status' => 'pending',
        'registration_date' => now(),
    ]);

    // Increment registered count
    $event->increment('registered_count');

    return response()->json([
        'success' => true,
        'message' => 'Registration successful',
        'data' => $registration
    ], 201);
}
```

### 2. Attendance Tracking

**Controller**: `AttendanceController.php`
**Model**: `Attendance.php`

#### Check-in/Check-out:
```php
public function store(Request $request) {
    $validated = $request->validate([
        'registration_id' => 'required|exists:event_registrations,registration_id',
        'check_in_time' => 'required|date',
    ]);

    $attendance = Attendance::create([
        'registration_id' => $validated['registration_id'],
        'check_in_time' => $validated['check_in_time'],
        'status' => 'present',
    ]);

    return response()->json([
        'success' => true,
        'data' => $attendance
    ], 201);
}

public function update(Request $request, $id) {
    $attendance = Attendance::findOrFail($id);

    $validated = $request->validate([
        'check_out_time' => 'required|date|after:check_in_time',
    ]);

    $checkIn = Carbon::parse($attendance->check_in_time);
    $checkOut = Carbon::parse($validated['check_out_time']);
    $hoursWorked = $checkIn->diffInHours($checkOut);

    $attendance->update([
        'check_out_time' => $validated['check_out_time'],
        'hours_worked' => $hoursWorked,
    ]);

    return response()->json([
        'success' => true,
        'data' => $attendance
    ]);
}
```

### 3. Notification System

**Controller**: `NotificationController.php`
**Model**: `Notification.php`

#### Creating Notifications:
```php
// Trigger notification on event registration
Notification::create([
    'user_id' => $organization->user_id,
    'type' => 'new_registration',
    'message' => "New volunteer registered for {$event->event_name}",
    'is_read' => false,
]);
```

#### Fetching User Notifications:
```php
public function index() {
    $notifications = Auth::user()->notifications()
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $notifications
    ]);
}
```

### 4. Feedback System

**Controller**: `FeedbackController.php`
**Model**: `Feedback.php`

```php
public function store(Request $request) {
    $validated = $request->validate([
        'event_id' => 'required|exists:events,event_id',
        'volunteer_id' => 'required|exists:volunteers,volunteer_id',
        'rating' => 'required|integer|min:1|max:5',
        'comments' => 'nullable|string|max:1000',
    ]);

    $feedback = Feedback::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Feedback submitted successfully',
        'data' => $feedback
    ], 201);
}
```

### 5. Skills Matching

**Models**: `Skill.php`, `VolunteerSkill.php`, `EventSkill.php`

#### Many-to-Many Relationships:
```php
// In Volunteer model
public function skills() {
    return $this->belongsToMany(Skill::class, 'volunteer_skills', 'volunteer_id', 'skill_id')
                ->withPivot('proficiency_level')
                ->withTimestamps();
}

// In Event model
public function skills() {
    return $this->belongsToMany(Skill::class, 'event_skills', 'event_id', 'skill_id')
                ->withPivot('is_required')
                ->withTimestamps();
}
```

#### Attaching Skills:
```php
// Attach skill to volunteer
$volunteer->skills()->attach($skillId, [
    'proficiency_level' => 'intermediate'
]);

// Attach skill to event
$event->skills()->attach($skillId, [
    'is_required' => true
]);
```

---

## Testing

### Test Structure
**Location**: `tests/`

```
tests/
├── Feature/                    # Integration tests
│   ├── Security/              # Security tests
│   │   ├── AuthTest.php
│   │   ├── XSSTest.php
│   │   └── SQLInjectionTest.php
│   ├── EventTest.php
│   ├── RegistrationTest.php
│   └── ...
└── Unit/                      # Unit tests
    └── ...
```

### PHPUnit Configuration
**Location**: `phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
    </php>
    
    <testsuites>
        <testsuite name="Feature">
            <directory>./tests/Feature</directory>
        </testsuite>
        <testsuite name="Unit">
            <directory>./tests/Unit</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

### Running Tests

```bash
# Run all tests
composer test
# or
php artisan test

# Run specific test suite
php artisan test --filter=Security

# Run with coverage
php artisan test --coverage
```

### Example Test
```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class EventTest extends TestCase
{
    public function test_organization_can_create_event()
    {
        $user = User::factory()->create(['user_type' => 'organization']);
        $organization = Organization::factory()->create(['user_id' => $user->user_id]);

        $response = $this->actingAs($user)->postJson('/api/events', [
            'organization_id' => $organization->organization_id,
            'event_name' => 'Test Event',
            'description' => 'Test Description',
            'event_date' => now()->addDays(7)->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'location' => 'Test Location',
            'max_volunteers' => 50,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Event created successfully'
                 ]);
    }
}
```

---

## Development Workflow

### Setup

```bash
# 1. Install dependencies
composer install
npm install

# 2. Environment setup
cp .env.example .env
php artisan key:generate

# 3. Database setup
touch database/database.sqlite
php artisan migrate

# 4. Seed demo data (optional)
php artisan db:seed --class=DemoDataSeeder

# 5. Build frontend
npm run build

# 6. Start development server
composer run dev
# This starts: Laravel server, queue worker, logs viewer, and Vite
```

### Development Commands

```bash
# Start all services (recommended)
composer run dev

# Or start individually:
php artisan serve              # Laravel server (port 8000)
php artisan queue:listen       # Queue worker
php artisan pail              # Log viewer
npm run dev                    # Vite dev server

# Run tests
composer test

# Code formatting
./vendor/bin/pint

# Database operations
php artisan migrate           # Run migrations
php artisan migrate:fresh     # Drop all tables and re-migrate
php artisan db:seed           # Seed database

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Code Style

**Laravel Pint** is used for code formatting:

```bash
./vendor/bin/pint              # Format all files
./vendor/bin/pint --dirty      # Format only changed files
./vendor/bin/pint path/to/file # Format specific file
```

### Database Migrations

Creating a new migration:
```bash
php artisan make:migration create_table_name
```

Migration structure:
```php
public function up()
{
    Schema::create('table_name', function (Blueprint $table) {
        $table->id();
        $table->string('column_name');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('table_name');
}
```

### Creating New Controllers

```bash
# API Resource Controller
php artisan make:controller ControllerName --api --resource

# Basic Controller
php artisan make:controller ControllerName
```

### Creating New Models

```bash
# Model with migration, factory, and seeder
php artisan make:model ModelName -mfs

# Model with migration only
php artisan make:model ModelName -m
```

---

## Production Deployment

### Environment Configuration

Key `.env` variables for production:

```bash
APP_ENV=production
APP_DEBUG=false
APP_KEY=<generated-key>
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=onehelp
DB_USERNAME=dbuser
DB_PASSWORD=secure-password

SESSION_DRIVER=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525

# Optional: OpenAI API for AI features
OPENAI_API_KEY=your-openai-api-key
```

### Production Setup

```bash
# 1. Install dependencies (production only)
composer install --no-dev --optimize-autoloader

# 2. Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Run migrations
php artisan migrate --force

# 4. Build assets
npm run build

# 5. Set proper permissions
chmod -R 755 storage bootstrap/cache
```

### Security Checklist

- ✅ Set `APP_DEBUG=false` in production
- ✅ Use strong `APP_KEY`
- ✅ Configure HTTPS/SSL
- ✅ Set secure database credentials
- ✅ Enable all security middleware
- ✅ Regular security updates
- ✅ Use rate limiting
- ✅ Implement proper logging
- ✅ Regular backups
- ✅ Monitor security logs

### Performance Optimization

```bash
# Enable OPcache in php.ini
opcache.enable=1
opcache.memory_consumption=256

# Use queue workers for background jobs
php artisan queue:work --daemon

# Use Redis for caching (optional)
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

---

## Additional Resources

### Related Documentation
- [API Documentation](API_DOCUMENTATION.md) - Complete API reference
- [User Manual](USER_MANUAL.md) - End-user guide
- [Security Documentation](SECURITY.md) - Security implementation details
- [AI Feature Documentation](AI_FEATURE_DOCUMENTATION.md) - AI feature guide

### Laravel Resources
- [Laravel Documentation](https://laravel.com/docs/12.x)
- [Eloquent ORM](https://laravel.com/docs/12.x/eloquent)
- [Laravel Testing](https://laravel.com/docs/12.x/testing)

### Project-Specific Patterns

**Important Notes:**
1. **Non-standard Primary Keys**: Many models use custom primary keys (e.g., `user_id` instead of `id`)
2. **Manual Timestamps**: `User` model has `public $timestamps = false`
3. **Soft Deletes**: Enabled on `User` model
4. **Custom Password Column**: Uses `password_hash` instead of `password`

Always check the model definition before writing queries!

---

## Summary

OneHelp's backend is built with Laravel 12 following best practices:

- ✅ **RESTful API** with consistent response format
- ✅ **Role-Based Access Control** (volunteer, organization, admin)
- ✅ **Comprehensive validation** and error handling
- ✅ **Security-first approach** with multiple security layers
- ✅ **Well-documented codebase** with clear patterns
- ✅ **Test coverage** for critical functionality
- ✅ **Scalable architecture** ready for production

For specific implementation details, refer to the respective controller and model files listed throughout this documentation.
