@extends('layouts.app')

@section('title', 'Tindahan ng Pag-asa: Pop-up Livelihood Fair - OneHelp')

@section('content')
<style>
    .event-detail-hero {
        background: linear-gradient(rgba(28, 77, 94, 0.85), rgba(28, 77, 94, 0.85)), 
                    url('{{ asset('images/events/tindahan-pag-asa.jpg') }}') center/cover;
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
            <h1>Tindahan ng Pag-asa: Pop-up Livelihood Fair</h1>
            <p class="event-hero-org">Organized by Bayanihan Hands</p>
            <div class="event-hero-meta">
                <span><i class="far fa-calendar"></i> November 10-15, 2025</span>
                <span><i class="far fa-clock"></i> 9:00 AM – 1:00 PM</span>
                <span><i class="fas fa-map-marker-alt"></i> Brgy. Bagong Silang, Caloocan City</span>
            </div>
        </div>
    </div>
</section>

<!-- Event Details -->
<div class="event-detail-container">
    <!-- What is the event about? -->
    <div class="event-section">
        <h2>🛍️ What is the event about?</h2>
        <p>Help families build sustainable futures! Bayanihan Hands is launching Tindahan ng Pag-asa, a weekend pop-up livelihood fair that showcases community-made products and offers hands-on workshops for low-income families. Volunteers will assist in organizing booths, guiding participants, and supporting local entrepreneurs.</p>
        <p>This initiative empowers community members by providing them with a platform to showcase their products and learn new skills that can generate sustainable income for their families.</p>
    </div>

    <!-- When and Where? -->
    <div class="event-section">
        <h2>📍 When and Where?</h2>
        <div class="info-grid">
            <div class="info-item">
                <h3><i class="far fa-calendar"></i> Date & Time</h3>
                <p><strong>Duration:</strong> November 10-15, 2025 (6 days)</p>
                <p><strong>Time:</strong> 9:00 AM – 1:00 PM daily</p>
            </div>
            <div class="info-item">
                <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                <p><strong>Venue:</strong> Barangay Hall Grounds, Brgy. Bagong Silang, Caloocan City</p>
                <p><strong>Meet-up Point:</strong> Barangay Hall entrance by 8:30 AM</p>
            </div>
        </div>
    </div>

    <!-- Responsibilities -->
    <div class="event-section">
        <h2>🤝 What are my responsibilities as a volunteer?</h2>
        <p>Volunteers will be assigned to one of the following teams:</p>
        <ul>
            <li><strong>🛍️ Booth Support Team</strong> – Help vendors set up stalls and display products attractively</li>
            <li><strong>📣 Workshop Assistance Team</strong> – Support facilitators during mini livelihood sessions and skills training</li>
            <li><strong>🧾 Logistics Team</strong> – Manage registration, crowd flow, event coordination, and clean-up</li>
        </ul>
        <p>This is a multi-day event, and volunteers can choose to participate for one or more days based on their availability.</p>
    </div>

    <!-- Preparation -->
    <div class="event-section">
        <h2>🎒 What are the things I need to prepare?</h2>
        <ul>
            <li><strong>Arrive by 8:30 AM</strong> on your scheduled volunteer day(s)</li>
            <li>Wear comfortable clothes suitable for outdoor activities</li>
            <li>Bring a refillable water bottle</li>
            <li>Bring personal snacks if needed</li>
            <li>Come with enthusiasm to support local entrepreneurs and community members</li>
        </ul>
    </div>

    <!-- SDGs -->
    <div class="event-section">
        <h2>🌍 What are the SDGs targeted by this program?</h2>
        <p>This event contributes to the following United Nations Sustainable Development Goals:</p>
        <div class="sdg-section">
            <div class="sdg-item-detail">
                <img src="{{ asset('images/sdg-8-logo.svg') }}" alt="SDG 8">
                <div>
                    <h3>SDG 8: Decent Work and Economic Growth</h3>
                    <p>Promote sustained, inclusive and sustainable economic growth, full and productive employment</p>
                </div>
            </div>
            <div class="sdg-item-detail">
                <img src="{{ asset('images/sdg-1-logo.svg') }}" alt="SDG 1">
                <div>
                    <h3>SDG 1: No Poverty</h3>
                    <p>End poverty in all its forms everywhere</p>
                </div>
            </div>
            <div class="sdg-item-detail">
                <img src="{{ asset('images/sdg-10-logo.svg') }}" alt="SDG 10">
                <div>
                    <h3>SDG 10: Reduced Inequalities</h3>
                    <p>Reduce inequality within and among countries</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="contact-info">
        <h3>📞 Contact Information</h3>
        <p><i class="far fa-envelope"></i> bayanihanhands@gmail.com</p>
        <p><i class="fas fa-phone"></i> 0918-765-4321</p>
    </div>

    <!-- CTA Button -->
    <div style="text-align: center;">
        <a href="#" class="btn-join-event">Join This Event</a>
    </div>
</div>
@endsection
