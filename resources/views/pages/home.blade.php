@extends('layouts.app')

@section('title', 'OneHelp - Connecting Hearts to Communities')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(28, 77, 94, 0.6), rgba(28, 77, 94, 0.6)), url('{{ asset('images/community_photo.jpg') }}') center/cover;">
    <div class="hero-content">
        <h1>"Connecting Hearts to<br>Communities"</h1>
        <p>Empowering volunteers and organizations to<br>make a difference.</p>
        <button class="btn-browse-events" onclick="window.location.href='{{ url('/events') }}'">Browse Events</button>
    </div>
    
    <!-- SDG Logo at bottom right -->
    <div style="position: absolute; bottom: 2rem; right: 2rem; z-index: 10;">
        <img src="{{ asset('images/sdg_logo.svg') }}" alt="UN Sustainable Development Goals" style="height: 60px; width: auto;">
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works">
    <div class="container">
        <h2>How It Works?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="how-card">
                    <div class="how-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3>Register</h3>
                    <p>Sign up easily as a volunteer or organization to get started. Create your profile and tell us about your interests, skills, and availability. It only takes a few minutes to join our community.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="how-card">
                    <div class="how-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Match</h3>
                    <p>Our AI-based system connects volunteers with organizations that align with their passions and availability. Browse through various opportunities and find the perfect match for your skills and interests.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="how-card">
                    <div class="how-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3>Volunteer</h3>
                    <p>Join events, contribute your time, and make a real difference in your community. Track your impact, earn recognition, and build meaningful connections with like-minded individuals along the way.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Events Section -->
<section class="featured-events">
    <div class="container">
        <h2>FEATURED VOLUNTEER EVENTS</h2>
        <div class="row g-4">
            @forelse($events as $event)
            <!-- Event Card -->
            <div class="col-md-6 col-lg-3">
                <div class="event-card">
                    <div class="event-image">
                        @if($event->images && $event->images->count() > 0)
                            <img src="{{ asset($event->images->first()->image_url) }}" alt="{{ $event->event_name }}">
                        @else
                            <img src="{{ asset('images/event-placeholder.jpg') }}" alt="{{ $event->event_name }}">
                        @endif
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->event_name }}</h3>
                        <p class="event-org">{{ $event->organization->org_name ?? 'Community Partner' }}</p>
                        <p class="event-description">{{ $event->description }}</p>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</span>
                            <span><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}</span>
                        </div>
                        <div class="event-tags">
                            @if($event->category)
                                <span class="event-tag">{{ $event->category }}</span>
                            @endif
                            @php
                                // Add a secondary tag based on category for visual consistency
                                $secondaryTags = [
                                    'Environment' => 'Outdoor',
                                    'Education' => 'Youth',
                                    'Community' => 'Outreach',
                                    'Health' => 'Care',
                                ];
                                $secondaryTag = $secondaryTags[$event->category] ?? null;
                            @endphp
                            @if($secondaryTag)
                                <span class="event-tag">{{ $secondaryTag }}</span>
                            @endif
                        </div>
                        <a href="{{ route('events.show', $event->event_id) }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback if no events -->
            <div class="col-12">
                <p class="text-center">No featured events available at the moment. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Sustainable Future Section -->
<section class="sustainable-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>A Sustainable Future with you</h2>
                <p>Together, we empower communities to create a brighter, more sustainable future. Our platform connects volunteers and organizations to build a stronger, more resilient society. By aligning with the United Nations Sustainable Development Goals, we're making a real difference in people's lives.</p>
            </div>
            <div class="col-md-6">
                <div class="sdg-grid">
                    <!-- SDG Placeholders -->
                    <div class="sdg-item">
                        <img src="{{ asset('images/sdg-2-logo.svg') }}" alt="SDG 1" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="sdg-item">
                        <img src="{{ asset('images/sdg-4-logo.svg') }}" alt="SDG 2" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="sdg-item">
                        <img src="{{ asset('images/sdg-11-logo.svg') }}" alt="SDG 3" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="sdg-item">
                        <img src="{{ asset('images/sdg-16-logo.svg') }}" alt="SDG 4" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="sdg-item">
                        <img src="{{ asset('images/sdg-3-logo.svg') }}" alt="SDG 5" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="sdg-item">
                        <img src="{{ asset('images/sdg-17-logo.svg') }}" alt="SDG 6" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <div class="sdg-logo">
                    <img src="{{ asset('images/sdg_logo.svg') }}" alt="UN SDG Logo" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection