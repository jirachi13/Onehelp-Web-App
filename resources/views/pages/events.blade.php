@extends('layouts.app')

@section('title', 'Browse Events - OneHelp')

@section('content')
<!-- Events Hero -->
<section class="hero-section" style="min-height: 400px;">
    <div class="hero-content">
        <h1>Volunteer Events</h1>
        <p>Find opportunities to make a difference in your community</p>
    </div>
</section>

<!-- Events Filters & Grid -->
<section style="padding: 4rem 0; background: #f8f9fa;">
    <div class="container">
        <!-- Filter Bar -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                    <div class="d-flex gap-2 flex-wrap">
                        <select class="form-select" style="width: auto;">
                            <option>All Categories</option>
                            <option>Environment</option>
                            <option>Education</option>
                            <option>Community</option>
                            <option>Health</option>
                        </select>
                        <select class="form-select" style="width: auto;">
                            <option>All Locations</option>
                            <option>Manila</option>
                            <option>Quezon City</option>
                            <option>Makati</option>
                            <option>Pasig</option>
                        </select>
                        <input type="date" class="form-control" style="width: auto;">
                    </div>
                    <div>
                        <input type="search" class="form-control" placeholder="Search events...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="row g-4">
            <!-- Event 1: Green Steps -->
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

            <!-- Event 2: Read & Rise -->
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

            <!-- Event 3: Kusina at Kabuhayan -->
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

            <!-- Event 4: Care Companions -->
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

            <!-- Event 5: Tindahan ng Pag-asa -->
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

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .form-select, .form-control {
        border: 2px solid var(--navy);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-weight: 600;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--primary-teal);
        box-shadow: 0 0 0 0.2rem rgba(125, 211, 192, 0.25);
    }

    .pagination .page-link {
        color: var(--navy);
        border: 2px solid var(--navy);
        margin: 0 0.25rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-teal);
        border-color: var(--navy);
        color: var(--navy);
    }

    .pagination .page-link:hover {
        background-color: var(--accent-yellow);
        border-color: var(--navy);
        color: var(--navy);
    }
</style>
@endpush