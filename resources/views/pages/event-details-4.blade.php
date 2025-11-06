@extends('layouts.app')

@section('title', 'Care Companions: Hospital Volunteer Program - OneHelp')

@section('content')
<style>
    .event-detail-hero {
        background: linear-gradient(rgba(28, 77, 94, 0.85), rgba(28, 77, 94, 0.85)), 
                    url('{{ asset('images/events/care-companions.jpg') }}') center/cover;
        padding: 4rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .event-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 4rem;
    }

    .event-hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .event-hero-org {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .event-hero-meta {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
        font-size: 1rem;
    }

    .event-hero-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .event-section {
        background: white;
        border: 3px solid var(--navy);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .event-section h2 {
        color: var(--navy);
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        border-bottom: 3px solid var(--accent-yellow);
        padding-bottom: 0.5rem;
    }

    .event-section p, .event-section li {
        color: var(--text-dark);
        line-height: 1.8;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .event-section ul {
        padding-left: 1.5rem;
    }

    .event-section li {
        margin-bottom: 0.8rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .info-item {
        background: var(--primary-teal);
        border: 2px solid var(--navy);
        border-radius: 15px;
        padding: 1.5rem;
    }

    .info-item h3 {
        color: var(--navy);
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .info-item p {
        color: var(--navy);
        margin-bottom: 0.5rem;
    }

    .sdg-section {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .sdg-item-detail {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--primary-teal);
        border: 2px solid var(--navy);
        border-radius: 15px;
        padding: 1rem;
        flex: 1;
        min-width: 250px;
    }

    .sdg-item-detail img {
        width: 60px;
        height: 60px;
        border: 2px solid var(--navy);
        border-radius: 8px;
    }

    .sdg-item-detail div {
        flex: 1;
    }

    .sdg-item-detail h3 {
        color: var(--navy);
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
    }

    .sdg-item-detail p {
        color: var(--navy);
        font-size: 0.85rem;
        margin: 0;
    }

    .btn-join-event {
        background: var(--accent-yellow);
        color: var(--navy);
        padding: 1.2rem 3rem;
        border-radius: 50px;
        border: 3px solid var(--navy);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-align: center;
        display: inline-block;
        text-decoration: none;
        letter-spacing: 1px;
        box-shadow: 0 5px 20px rgba(244, 213, 141, 0.4);
    }

    .btn-join-event:hover {
        background: white;
        color: var(--navy);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(244, 213, 141, 0.6);
    }

    .contact-info {
        background: var(--accent-yellow);
        border: 3px solid var(--navy);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        margin: 3rem 0;
    }

    .contact-info h3 {
        color: var(--navy);
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .contact-info p {
        color: var(--navy);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .event-hero-content h1 {
            font-size: 2rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .event-section {
            padding: 1.5rem;
        }

        .sdg-item-detail {
            min-width: 100%;
        }
    }
</style>

<!-- Hero Section -->
<section class="event-detail-hero">
    <div class="container">
        <div class="event-hero-content">
            <h1>Care Companions: Hospital Volunteer Program</h1>
            <p class="event-hero-org">Organized by Heal Together PH</p>
            <div class="event-hero-meta">
                <span><i class="far fa-calendar"></i> Every Saturday</span>
                <span><i class="far fa-clock"></i> 9:00 AM – 12:00 NN</span>
                <span><i class="fas fa-map-marker-alt"></i> Pasay City General Hospital</span>
            </div>
        </div>
    </div>
</section>

<!-- Event Details -->
<div class="event-detail-container">
    <!-- What is the event about? -->
    <div class="event-section">
        <h2>💙 What is the event about?</h2>
        <p>Make healing more human. Heal Together PH invites volunteers to join the Care Companions program — a weekend initiative focused on patient care and assistance. Volunteers will help ease the hospital experience by offering support, companionship, and practical help in clinical settings.</p>
        <p>This program recognizes that healing involves more than medical treatment. By providing emotional support and practical assistance, volunteers help create a more compassionate and healing environment for patients and their families.</p>
    </div>

    <!-- When and Where? -->
    <div class="event-section">
        <h2>📍 When and Where?</h2>
        <div class="info-grid">
            <div class="info-item">
                <h3><i class="far fa-calendar"></i> Date & Time</h3>
                <p><strong>Schedule:</strong> Every Saturday</p>
                <p><strong>Time:</strong> 9:00 AM – 12:00 NN</p>
            </div>
            <div class="info-item">
                <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                <p><strong>Venue:</strong> Outpatient Wing, Pasay City General Hospital</p>
                <p><strong>Meet-up Point:</strong> Hospital lobby by 8:45 AM</p>
            </div>
        </div>
    </div>

    <!-- Responsibilities -->
    <div class="event-section">
        <h2>🤝 What are my responsibilities as a volunteer?</h2>
        <p>As a Care Companion volunteer, you will:</p>
        <ul>
            <li>Assist patients with directions, forms, and basic needs within the hospital</li>
            <li>Offer companionship and emotional support to patients and their families</li>
            <li>Help distribute snacks, water, or hygiene kits to those in need</li>
            <li>Support hospital staff with simple, non-medical tasks</li>
            <li>Maintain a compassionate and professional demeanor at all times</li>
        </ul>
        <p>Note: This is a non-medical volunteer role. All volunteers will receive orientation on hospital protocols and patient interaction guidelines.</p>
    </div>

    <!-- Preparation -->
    <div class="event-section">
        <h2>🎒 What are the things I need to prepare?</h2>
        <ul>
            <li><strong>Arrive by 8:45 AM</strong> for orientation and security clearance</li>
            <li>Wear comfortable clothes and closed shoes (white or neutral colors preferred)</li>
            <li>Bring a valid government-issued ID (required for hospital entry)</li>
            <li>Bring a refillable water bottle</li>
            <li>Come with empathy, patience, and a caring attitude</li>
            <li>Follow all hospital health and safety protocols</li>
        </ul>
    </div>

    <!-- SDGs -->
    <div class="event-section">
        <h2>🌍 What are the SDGs targeted by this program?</h2>
        <p>This event contributes to the following United Nations Sustainable Development Goals:</p>
        <div class="sdg-section">
            <div class="sdg-item-detail">
                <img src="{{ asset('images/sdg-3-logo.svg') }}" alt="SDG 3">
                <div>
                    <h3>SDG 3: Good Health and Well-being</h3>
                    <p>Ensure healthy lives and promote well-being for all at all ages</p>
                </div>
            </div>
            <div class="sdg-item-detail">
                <img src="{{ asset('images/sdg-10-logo.svg') }}" alt="SDG 10">
                <div>
                    <h3>SDG 10: Reduced Inequalities</h3>
                    <p>Reduce inequality within and among countries</p>
                </div>
            </div>
            <div class="sdg-item-detail">
                <img src="{{ asset('images/sdg-17-logo.svg') }}" alt="SDG 17">
                <div>
                    <h3>SDG 17: Partnerships for the Goals</h3>
                    <p>Strengthen the means of implementation and revitalize partnerships</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="contact-info">
        <h3>📞 Contact Information</h3>
        <p><i class="far fa-envelope"></i> healtogetherph@gmail.com</p>
        <p><i class="fas fa-phone"></i> 0917-456-7890</p>
    </div>

    <!-- CTA Button -->
    <div style="text-align: center;">
        <a href="#" class="btn-join-event">Join This Event</a>
    </div>
</div>
@endsection
