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
            <!-- Event Card 1: Green Steps -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="event-card">
                    <div class="event-image">
                        <img src="{{ asset('images/events/green-steps.jpg') }}" alt="Green Steps: Urban Restoration and Eco-Awareness Drive">
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">Green Steps: Urban Restoration and Eco-Awareness Drive</h3>
                        <p class="event-org">EcoHope PH</p>
                        <p class="event-description">Join us in taking Green Steps toward a more sustainable Metro Manila! Help restore green spaces and educate communities about sustainable living.</p>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> Nov 16, 2025</span>
                            <span><i class="far fa-clock"></i> 8:00 AM</span>
                        </div>
                        <div class="event-tags">
                            <span class="event-tag">Environment</span>
                            <span class="event-tag">Outdoor</span>
                            <span class="event-tag">Community</span>
                        </div>
                        <div class="event-sdgs">
                            <img src="{{ asset('images/sdg-13-logo.svg') }}" alt="SDG 13" class="sdg-badge">
                            <img src="{{ asset('images/sdg-15-logo.svg') }}" alt="SDG 15" class="sdg-badge">
                            <img src="{{ asset('images/sdg-11-logo.svg') }}" alt="SDG 11" class="sdg-badge">
                        </div>
                        <a href="{{ route('events.green-steps') }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 2: Read & Rise -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="event-card">
                    <div class="event-image">
                        <img src="{{ asset('images/events/read-rise.jpg') }}" alt="Read & Rise: Weekend Literacy Program">
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">Read & Rise: Weekend Literacy Program</h3>
                        <p class="event-org">BrightFutures Org</p>
                        <p class="event-description">Be a changemaker in your own city! Join the Read & Rise weekend reading sessions and help children build confidence, comprehension, and a lifelong love of learning.</p>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> Every Saturday</span>
                            <span><i class="far fa-clock"></i> 9:00 AM</span>
                        </div>
                        <div class="event-tags">
                            <span class="event-tag">Education</span>
                            <span class="event-tag">Children</span>
                            <span class="event-tag">Literacy</span>
                        </div>
                        <div class="event-sdgs">
                            <img src="{{ asset('images/sdg-4-logo.svg') }}" alt="SDG 4" class="sdg-badge">
                            <img src="{{ asset('images/sdg-10-logo.svg') }}" alt="SDG 10" class="sdg-badge">
                            <img src="{{ asset('images/sdg-1-logo.svg') }}" alt="SDG 1" class="sdg-badge">
                        </div>
                        <a href="{{ route('events.read-rise') }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 3: Kusina at Kabuhayan -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="event-card">
                    <div class="event-image">
                        <img src="{{ asset('images/events/kusina-kabuhayan.jpg') }}" alt="Kusina at Kabuhayan: Community Outreach Program">
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">Kusina at Kabuhayan: Community Outreach Program</h3>
                        <p class="event-org">Bayanihan Hands</p>
                        <p class="event-description">Be part of a movement that nourishes both body and future. Join our weekend outreach program combining feeding activities with livelihood workshops for low-income families.</p>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> Nov 17, 2025</span>
                            <span><i class="far fa-clock"></i> 8:00 AM</span>
                        </div>
                        <div class="event-tags">
                            <span class="event-tag">Community</span>
                            <span class="event-tag">Food</span>
                            <span class="event-tag">Livelihood</span>
                        </div>
                        <div class="event-sdgs">
                            <img src="{{ asset('images/sdg-2-logo.svg') }}" alt="SDG 2" class="sdg-badge">
                            <img src="{{ asset('images/sdg-8-logo.svg') }}" alt="SDG 8" class="sdg-badge">
                            <img src="{{ asset('images/sdg-10-logo.svg') }}" alt="SDG 10" class="sdg-badge">
                        </div>
                        <a href="{{ route('events.kusina-kabuhayan') }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 4: Care Companions -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="event-card">
                    <div class="event-image">
                        <img src="{{ asset('images/events/care-companions.jpg') }}" alt="Care Companions: Hospital Volunteer Program">
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">Care Companions: Hospital Volunteer Program</h3>
                        <p class="event-org">Heal Together PH</p>
                        <p class="event-description">Make healing more human. Join the Care Companions program and help ease the hospital experience by offering support, companionship, and practical help in clinical settings.</p>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> Every Saturday</span>
                            <span><i class="far fa-clock"></i> 9:00 AM</span>
                        </div>
                        <div class="event-tags">
                            <span class="event-tag">Healthcare</span>
                            <span class="event-tag">Community</span>
                            <span class="event-tag">Support</span>
                        </div>
                        <div class="event-sdgs">
                            <img src="{{ asset('images/sdg-3-logo.svg') }}" alt="SDG 3" class="sdg-badge">
                            <img src="{{ asset('images/sdg-10-logo.svg') }}" alt="SDG 10" class="sdg-badge">
                            <img src="{{ asset('images/sdg-17-logo.svg') }}" alt="SDG 17" class="sdg-badge">
                        </div>
                        <a href="{{ route('events.care-companions') }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 5: Tindahan ng Pag-asa -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="event-card">
                    <div class="event-image">
                        <img src="{{ asset('images/events/tindahan-pag-asa.jpg') }}" alt="Tindahan ng Pag-asa: Pop-up Livelihood Fair">
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">Tindahan ng Pag-asa: Pop-up Livelihood Fair</h3>
                        <p class="event-org">Bayanihan Hands</p>
                        <p class="event-description">Help families build sustainable futures! Join our weekend pop-up livelihood fair showcasing community-made products and offering hands-on workshops.</p>
                        <div class="event-meta">
                            <span><i class="far fa-calendar"></i> Nov 10-15, 2025</span>
                            <span><i class="far fa-clock"></i> 9:00 AM</span>
                        </div>
                        <div class="event-tags">
                            <span class="event-tag">Entrepreneurship</span>
                            <span class="event-tag">Community</span>
                            <span class="event-tag">Economic</span>
                        </div>
                        <div class="event-sdgs">
                            <img src="{{ asset('images/sdg-8-logo.svg') }}" alt="SDG 8" class="sdg-badge">
                            <img src="{{ asset('images/sdg-1-logo.svg') }}" alt="SDG 1" class="sdg-badge">
                            <img src="{{ asset('images/sdg-10-logo.svg') }}" alt="SDG 10" class="sdg-badge">
                        </div>
                        <a href="{{ route('events.tindahan-pag-asa') }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            </div>
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