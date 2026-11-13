@extends('layouts.app')

@section('title', __('messages.nav_about') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_about') }}</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill mb-2 fw-bold">
                    {{ __('messages.tagline') }}
                </span>
                <h1 class="fw-bold text-dark display-6">{{ __('messages.site_name') }}</h1>
                <p class="text-muted fs-5 mx-auto" style="max-width: 750px;">
                    @if(app()->getLocale() === 'en')
                        A transparent, direct citizen grievance redressal and civic facilitation platform addressing drinking water, roads, sanitation, electricity, and public infrastructure needs across Virudhunagar District.
                    @else
                        விருதுநகர் மாவட்ட மக்களின் குடிநீர், சாலை, சுகாதாரம் உள்ளிட்ட அனைத்து அடிப்படை பிரச்சனைகளுக்கும் வெளிப்படைத்தன்மையுடன் உடனடி தீர்வு காணும் மக்கள் சேவைத் தளம்.
                    @endif
                </p>
            </div>

            <!-- =========================================================================
                 THE VISIONARY & BRAIN BEHIND THE PROJECT: THIRU. RAJESH GURUSAMY
                 ========================================================================= -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white">
                <div class="p-1" style="background: linear-gradient(90deg, #ff7722, #ffffff, #138808);"></div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4 text-center">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('assets/images/rajesh/rajesh.png') }}" 
                                     alt="Rajesh Gurusamy - State Vice President, Kisan Morcha, BJP Tamil Nadu" 
                                     class="img-fluid rounded-4 shadow-sm border border-3 border-white"
                                     style="max-height: 290px; width: 100%; object-fit: cover; object-position: top center;">
                                <span class="badge bg-warning text-dark position-absolute bottom-0 start-50 translate-middle-x mb-2 shadow-sm px-3 py-1.5 fw-bold rounded-pill text-nowrap" style="font-size: 0.76rem;">
                                    <i class="bi bi-star-fill text-danger me-1"></i> {{ app()->getLocale() === 'en' ? '25 Years Public Service' : '25 ஆண்டுகால மக்கள் பணி' }}
                                </span>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-light text-secondary border px-2.5 py-1 small">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Watrap & Virudhunagar Roots
                                </span>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 fw-bold" style="font-size: 0.75rem;">
                                    {{ app()->getLocale() === 'en' ? 'Project Visionary & Guide' : 'திட்டத்தின் வழிகாட்டி & தொலைநோக்காளர்' }}
                                </span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 fw-bold" style="font-size: 0.75rem;">
                                    State Vice President of Kisan Morcha
                                </span>
                            </div>

                            @if(app()->getLocale() === 'en')
                                <h2 class="fw-bold text-dark mb-1 fs-3">Thiru. Rajesh Gurusamy</h2>
                                <div class="text-primary fw-bold mb-3" style="font-size: 1.05rem;">
                                    State Vice President — Kisan Morcha, Bharatiya Janata Party (BJP) Tamil Nadu
                                </div>

                                <p class="text-secondary leading-relaxed mb-3">
                                    The visionary and brain behind this civic grievance redressal initiative is <strong>Thiru. Rajesh Gurusamy</strong>. With a quarter-century of disciplined public service and grassroots leadership, he initiated this platform to ensure that the voice of every rural citizen, family, and agricultural producer in Virudhunagar District reaches administrative authorities directly without intermediaries or delays.
                                </p>

                                <p class="text-muted small mb-4">
                                    Beginning his public service in 2001 as Watrap Union Yuva Morcha President in Virudhunagar District, he has served across district executive bodies, statewide IT cell modernisation, state call centre leadership, Commerce Cell State Secretary, and Kisan Morcha State Secretary. He currently serves as the State Vice President of Kisan Morcha, BJP Tamil Nadu, championing farmers' rights, central agricultural schemes, and rural economic upliftment.
                                </p>
                            @else
                                <h2 class="fw-bold text-dark mb-1 fs-3">திரு. ராஜேஷ் குருசாமி</h2>
                                <div class="text-primary fw-bold mb-3" style="font-size: 1.05rem;">
                                    மாநில துணைத் தலைவர் — விவசாய அணி (Kisan Morcha), பாரதிய ஜனதா கட்சி (BJP) தமிழ்நாடு
                                </div>

                                <p class="text-secondary leading-relaxed mb-3">
                                    விருதுநகர் மாவட்டத்தின் கடைக்கோடி கிராமத்து பாமர மக்களின் குரலும், உழவர்களின் நியாயமான கோரிக்கைகளும் எந்தவொரு இடைத்தரகரும் இன்றி நேரடியாக அதிகாரிகளையும் மக்கள் பிரதிநிதிகளையும் சென்றடைய வேண்டும் என்ற உயரிய தொலைநோக்கோடு இத்திட்டத்தை வடிவமைத்தவர் <strong>திரு. ராஜேஷ் குருசாமி</strong> அவர்கள்.
                                </p>

                                <p class="text-muted small mb-4">
                                    2001-ஆம் ஆண்டு விருதுநகர் மாவட்டம் வத்திராயிருப்பு ஒன்றிய இளைஞரணித் தலைவராக தனது மக்கள் பணியைத் தொடங்கி, மாவட்டச் செயற்குழு உறுப்பினர், மாநில தகவல் தொழில்நுட்பப் பிரிவு, வணிகர் அணி மாநிலச் செயலாளர், விவசாய அணி மாநிலச் செயலாளர் என 25 ஆண்டுகளாக பாரதிய ஜனதா கட்சியில் அர்ப்பணிப்புடன் செயலாற்றி, தற்போது தமிழ்நாடு விவசாய அணியின் மாநில துணைத் தலைவராக உழவர் நலம் மற்றும் கிராமப்புற மேம்பாட்டிற்காகத் தொடர்ந்து அயராது பாடுபட்டு வருகிறார்.
                                </p>
                            @endif

                            <div class="d-flex flex-wrap gap-2">
                                <a href="https://www.rajeshgurusamy.com/public-life.html" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm px-3 py-2 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                                    <i class="bi bi-globe2"></i>
                                    <span>{{ app()->getLocale() === 'en' ? 'Official Public Portfolio (rajeshgurusamy.com)' : 'அதிகாரப்பூர்வ பொதுவாழ்க்கை விபரங்கள் (rajeshgurusamy.com)' }}</span>
                                    <i class="bi bi-box-arrow-up-right small ms-1"></i>
                                </a>
                                <a href="tel:+918148145222" class="btn btn-light border btn-sm px-3 py-2 text-dark d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-telephone-fill text-success"></i>
                                    <span>{{ app()->getLocale() === 'en' ? 'Public Office Helpline: +91 81481 45222' : 'மக்கள் உதவி எண்: +91 81481 45222' }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 25 YEARS UNBROKEN PUBLIC SERVICE & LEADERSHIP TIMELINE
                 ========================================================================= -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white">
                <div class="text-center mb-4">
                    <span class="badge bg-warning-subtle text-dark border border-warning-subtle px-3 py-1 rounded-pill fw-bold mb-2">
                        {{ app()->getLocale() === 'en' ? 'Track Record: 2001 to Present' : '2001 முதல் இன்று வரை' }}
                    </span>
                    <h3 class="fw-bold text-dark">
                        {{ app()->getLocale() === 'en' ? '25 Years of Unbroken Organizational Service' : '25 ஆண்டுகால மக்கள் சேவை & கட்சிப் பொறுப்புகள்' }}
                    </h3>
                    <p class="text-muted small mx-auto" style="max-width: 650px;">
                        {{ app()->getLocale() === 'en' ? 'From youth mandal responsibilities in Watrap, Virudhunagar to statewide executive leadership in Tamil Nadu.' : 'விருதுநகர் மாவட்டத்தின் வத்திராயிருப்பு ஒன்றியத்தில் தொடங்கி தமிழ்நாடு மாநில அளவிலான மக்கள் நலப் பணிகள் வரையிலான வரலாற்றுப் பயணம்.' }}
                    </p>
                </div>

                <div class="row g-3">
                    @if(app()->getLocale() === 'en')
                        <!-- 2025 - Present -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #e65100 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-danger text-white fw-bold" style="font-size: 0.72rem;">2025 — PRESENT</span>
                                    <small class="text-primary fw-semibold">Current Responsibility</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">State Vice President — Kisan Morcha</h5>
                                <p class="text-muted small mb-0">
                                    Bharatiya Janata Party (BJP) — Tamil Nadu. Directing statewide farmer empowerment initiatives, agricultural grievance representations, rural economic policy dialogues, and grassroots civic coordination.
                                </p>
                            </div>
                        </div>

                        <!-- 2022 - 2025 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #1b5e20 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2022 — 2025</span>
                                    <small class="text-muted">State Executive</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">State Secretary — Kisan Morcha, Tamil Nadu BJP</h5>
                                <p class="text-muted small mb-0">
                                    Executed statewide agricultural seminars, farmer outreach camps, and led central agricultural welfare awareness tours across southern and delta districts.
                                </p>
                            </div>
                        </div>

                        <!-- 2020 - 2025 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #0284c7 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2020 — 2025</span>
                                    <small class="text-muted">Central Schemes Leadership</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">State In-Charge (Central Schemes) & Co-Zonal In-charge</h5>
                                <p class="text-muted small mb-0">
                                    State In-charge for PM-Kisan Samman Nidhi, Kisan Credit Card (KCC), and Organic Agriculture promotion. Oversaw organizational synchronization in the southern zones.
                                </p>
                            </div>
                        </div>

                        <!-- 2020 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #eab308 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2020</span>
                                    <small class="text-muted">Pandemic Economic Relief</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">MSME Loan Initiative & Small Business Support</h5>
                                <p class="text-muted small mb-0">
                                    Coordinated with banks and business chambers to facilitate collateral-free Emergency Credit Line Guarantee Scheme (ECLGS) loans to pandemic-affected small businesses and traders.
                                </p>
                            </div>
                        </div>

                        <!-- 2014 - 2017 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #6366f1 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2014 — 2017</span>
                                    <small class="text-muted">State Commerce Cell</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">State Secretary — Commerce Cell, Tamil Nadu BJP</h5>
                                <p class="text-muted small mb-0">
                                    Engaged commercial associations, wholesale trade bodies, and industry leaders to communicate central economic reforms and foster commercial enterprise confidence.
                                </p>
                            </div>
                        </div>

                        <!-- 2012 - 2016 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #ec4899 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2012 — 2016</span>
                                    <small class="text-muted">IT & Call Centre</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">State Organisation & IT Support; Call Centre In-charge</h5>
                                <p class="text-muted small mb-0">
                                    Built and managed state-wide election call centre infrastructure and coordinated record-breaking state membership enrollment drives across Tamil Nadu.
                                </p>
                            </div>
                        </div>

                        <!-- 2003 - 2008 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #0d9488 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2003 — 2008</span>
                                    <small class="text-muted">District Leadership</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">District Yuva Morcha / District Executive Member</h5>
                                <p class="text-muted small mb-0">
                                    Virudhunagar District, Tamil Nadu. Organized youth conventions, anti-corruption rallies, voter awareness campaigns, and civic welfare drives across the district.
                                </p>
                            </div>
                        </div>

                        <!-- 2001 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #ea580c !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-dark text-white" style="font-size: 0.72rem;">2001 — Grassroots Beginning</span>
                                    <small class="text-muted">Virudhunagar District</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">Watrap Union Yuva Morcha President / Leader</h5>
                                <p class="text-muted small mb-0">
                                    Entered active public service at the grassroots union level, establishing party presence and community welfare activities across rural villages in Watrap, Virudhunagar district.
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Tamil Timeline Nodes -->
                        <!-- 2025 - Present -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #e65100 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-danger text-white fw-bold" style="font-size: 0.72rem;">2025 — இன்று வரை</span>
                                    <small class="text-primary fw-semibold">தற்போதைய பொறுப்பு</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநில துணைத் தலைவர் — விவசாய அணி (Kisan Morcha)</h5>
                                <p class="text-muted small mb-0">
                                    பாரதிய ஜனதா கட்சி — தமிழ்நாடு. மாநிலம் தழுவிய விவசாயிகள் விழிப்புணர்வு, மத்திய அரசின் உழவர் நலத் திட்டங்களை கடைக்கோடி விவசாயிகளிடம் சேர்த்தல் மற்றும் கிராமப்புற வளர்ச்சிப் பணிகள்.
                                </p>
                            </div>
                        </div>

                        <!-- 2022 - 2025 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #1b5e20 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2022 — 2025</span>
                                    <small class="text-muted">மாநிலச் செயற்குழு</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநிலச் செயலாளர் — விவசாய அணி (Kisan Morcha)</h5>
                                <p class="text-muted small mb-0">
                                    தமிழ்நாடு முழுவதும் விவசாயிகள் மாநாடுகள், வேளாண் விழிப்புணர்வு முகாம்கள் மற்றும் மத்திய அரசின் நலத்திட்டப் பயணங்களை வெற்றிகரமாக முன்னெடுத்தார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2020 - 2025 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #0284c7 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2020 — 2025</span>
                                    <small class="text-muted">திட்ட ஒருங்கிணைப்பு</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மத்திய அரசுத் திட்டங்கள் & கன்னியாகுமரி மண்டல இணைப் பொறுப்பாளர்</h5>
                                <p class="text-muted small mb-0">
                                    PM-Kisan Samman Nidhi, கிசான் கடன் அட்டை (KCC) மற்றும் இயற்கை விவசாய ஊக்குவிப்புத் திட்டங்களின் மாநிலப் பொறுப்பாளராக களப்பணி ஆற்றினார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2020 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #eab308 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2020</span>
                                    <small class="text-muted">கொரோனா கால சேவை</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">MSME மற்றும் சிறு வணிகர்களுக்கான கடன் உதவி இயக்கம்</h5>
                                <p class="text-muted small mb-0">
                                    பெருந்தொற்று காலத்தில் வாழ்வாதாரம் பாதிக்கப்பட்ட சிறு வணிகர்கள் மற்றும் தொழில் முனைவோருக்கு மத்திய அரசின் பிணையில்லா அவசரகால கடன் திட்டத்தை (ECLGS) பெற்றுத்தந்தார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2014 - 2017 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #6366f1 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2014 — 2017</span>
                                    <small class="text-muted">வர்த்தகப் பிரிவு</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநிலச் செயலாளர் — வர்த்தகர் அணி (Commerce Cell)</h5>
                                <p class="text-muted small mb-0">
                                    வணிகர் சங்கங்கள், மொத்த வியாபாரக் கூட்டமைப்புகள் மற்றும் தொழில் அமைப்புகளுடன் இணைந்து மத்திய அரசின் பொருளாதாரச் சீர்திருத்தங்களை மக்களிடம் கொண்டு சேர்த்தார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2012 - 2016 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #ec4899 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2012 — 2016</span>
                                    <small class="text-muted">டிஜிட்டல் கட்டமைப்பு</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநில தேர்தல் அழைப்பு மையம் & உறுப்பினர் சேர்க்கை ஒருங்கிணைப்பாளர்</h5>
                                <p class="text-muted small mb-0">
                                    தமிழ்நாடு பாஜகவின் மாநில தேர்தல் அழைப்பு மையக் கட்டமைப்பை நிறுவி, சாதனை அளவிலான மாநில அளவிலான உறுப்பினர் சேர்க்கைப் பணிகளை வெற்றிகரமாக வழிநடத்தினார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2003 - 2008 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #0d9488 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2003 — 2008</span>
                                    <small class="text-muted">மாவட்டப் பணி</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">விருதுநகர் மாவட்ட செயற்குழு உறுப்பினர் & இளைஞரணி</h5>
                                <p class="text-muted small mb-0">
                                    விருதுநகர் மாவட்ட இளைஞரணி மாநாடுகள், வாக்காளர் விழிப்புணர்வு இயக்கங்கள் மற்றும் மக்கள் நலப் போராட்டங்களை முன்னின்று நடத்தினார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2001 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #ea580c !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-dark text-white" style="font-size: 0.72rem;">2001 — அடித்தள ஆரம்பம்</span>
                                    <small class="text-muted">விருதுநகர் மாவட்டம்</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">வத்திராயிருப்பு ஒன்றிய இளைஞரணித் தலைவர் (Watrap Union)</h5>
                                <p class="text-muted small mb-0">
                                    வத்திராயிருப்பு ஒன்றியத்தின் கிராமப்புறப் பகுதிகளில் கட்சியின் அடித்தளத்தை உருவாக்கி, அடிமட்டத் தொண்டனாய் தனது பொதுவாழ்வுப் பயணத்தைத் தொடங்கினார்.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- =========================================================================
                 BJP CIVIC VISION: ANTYODAYA & DIGITAL GOVERNANCE
                 ========================================================================= -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-top: 4px solid #ff7722 !important;">
                        <div class="rounded-circle bg-warning-subtle text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px; font-size: 22px;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ app()->getLocale() === 'en' ? 'Antyodaya (Serving the Last Person)' : 'அந்தியோதயா (Antyodaya)' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            @if(app()->getLocale() === 'en')
                                Inspired by Pandit Deendayal Upadhyaya's philosophy of Antyodaya, ensuring that essential government services, civic amenities, and justice reach the poorest citizen standing at the very end of the line.
                            @else
                                வரிசையில் நிற்கும் கடைசி மனிதருக்கும் அரசின் அடிப்படை சேவைகள் மற்றும் உரிமைகள் நேரடியாகச் சென்றடைய வேண்டும் என்ற பண்டிட் தீனதயாள் உபாத்யாயாவின் மக்கள் தத்துவமே இதன் அடித்தளம்.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-top: 4px solid #0284c7 !important;">
                        <div class="rounded-circle bg-info-subtle text-info d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px; font-size: 22px;">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ app()->getLocale() === 'en' ? 'Digital India Transparency' : 'டிஜிட்டல் இந்தியா வெளிப்படைத்தன்மை' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            @if(app()->getLocale() === 'en')
                                A transparent, direct digital governance framework where citizens register civic issues with live geotagged proof and track resolution progress without middlemen or administrative friction.
                            @else
                                இடைத்தரகர்கள் இன்றி பொதுமக்கள் தங்கள் பகுதியில் உள்ள பிரச்சனைகளை நேரடியாகவும், லைவ் ஜிபிஎஸ் சான்றுகளுடனும் பதிவு செய்து நிலையை உடனடி கண்காணிக்கும் வெளிப்படையான முறை.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-top: 4px solid #138808 !important;">
                        <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px; font-size: 22px;">
                            <i class="bi bi-tree-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ app()->getLocale() === 'en' ? 'Farmers & Rural Development' : 'உழவர் & ஊரக வளர்ச்சி' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            @if(app()->getLocale() === 'en')
                                Dedicated priority to addressing irrigation challenges, drinking water leakages, rural road repairs, and essential infrastructure needs across all agrarian villages and municipal wards.
                            @else
                                விவசாயக் குடும்பங்களின் பாசன வசதி, குடிநீர் தட்டுப்பாடு, ஊரகச் சாலைகள் மற்றும் அடிப்படை உட்கட்டமைப்புத் தேவைகளுக்கு முன்னுரிமை அளித்து தீர்வு காணும் செயல்பாடு.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Disclaimer Notice -->
            <div class="disclaimer-banner d-flex align-items-center gap-3 p-4 mb-5">
                <i class="bi bi-shield-exclamation fs-2 text-danger flex-shrink-0"></i>
                <div>
                    <h5 class="fw-bold text-danger mb-1">{{ __('messages.disclaimer_title') }}</h5>
                    <p class="mb-0 text-dark small">{{ __('messages.disclaimer_text') }}</p>
                </div>
            </div>

            <!-- Mission & Vision -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-left: 5px solid var(--primary-color) !important;">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-warning text-dark p-2 rounded-3"><i class="bi bi-bullseye fs-5"></i></span>
                            <h4 class="fw-bold mb-0">{{ app()->getLocale() === 'en' ? 'Our Mission' : 'நோக்கம் (Our Mission)' }}</h4>
                        </div>
                        <p class="text-secondary mb-0">
                            @if(app()->getLocale() === 'en')
                                To bridge the gap between citizens and local administrative bodies across all 10 taluks of Virudhunagar by offering a transparent, bilingual, digital petition portal that tracks resolutions step-by-step.
                            @else
                                விருதுநகர் மாவட்டத்தின் 10 வட்டங்களிலும் உள்ள பாமர மக்களின் அடிப்படைத் தேவைகளுக்கும் அரசு நிர்வாகத்திற்கும் இடையே பாலமாக அமைந்து, ஒவ்வொரு மனுவையும் வெளிப்படைத்தன்மையுடன் தீர்வு காண்பதே எங்களின் முதன்மை நோக்கம்.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-left: 5px solid var(--secondary-color) !important;">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-success text-white p-2 rounded-3"><i class="bi bi-eye-fill fs-5"></i></span>
                            <h4 class="fw-bold mb-0">{{ app()->getLocale() === 'en' ? 'Our Vision' : 'தொலைநோக்கு (Our Vision)' }}</h4>
                        </div>
                        <p class="text-secondary mb-0">
                            @if(app()->getLocale() === 'en')
                                A responsive, citizen-first civic ecosystem where community problems—from drinking water pipeline leakages to rural road repairs—are documented with authentic geolocation data and resolved with measurable service level agreements.
                            @else
                                குடிநீர் குழாய் உடைப்பு முதல் கிராமப்புற சாலை சீரமைப்பு வரை அனைத்து பொதுப் பிரச்சனைகளும் உண்மையான களத்தரவுகளுடன் ஆவணப்படுத்தப்பட்டு, காலக்கெடுவுடன் தீர்க்கப்படும் ஒரு முன்மாதிரி மாவட்ட மக்கள் நிர்வாகத்தை உருவாக்குதல்.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Key Operating Principles -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white">
                <h3 class="fw-bold text-dark mb-4 text-center">
                    {{ app()->getLocale() === 'en' ? 'Core Pillars of Tamil Nadu Makkal Kural' : 'தமிழ்நாடு மக்கள் குரலின் முதன்மைக் கொள்கைகள்' }}
                </h3>
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; font-size: 28px; color: var(--primary-color);">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() === 'en' ? 'Privacy & Citizen Security' : 'தனியுரிமை & தகவல் பாதுகாப்பு' }}</h5>
                        <p class="text-muted small">
                            {{ app()->getLocale() === 'en' ? 'Citizen phone numbers and private addresses are strictly protected and never disclosed on public feeds.' : 'மனுதாரர்களின் தொலைபேசி எண் மற்றும் வீட்டு முகவரி போன்ற தனிப்பட்ட விபரங்கள் பொதுவெளியில் பகிரப்படாமல் முழுமையாகப் பாதுகாக்கப்படுகின்றன.' }}
                        </p>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; font-size: 28px; color: var(--secondary-color);">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() === 'en' ? 'Accurate Administrative Mapping' : 'துல்லியமான நிர்வாகக் கட்டமைப்பு' }}</h5>
                        <p class="text-muted small">
                            {{ app()->getLocale() === 'en' ? 'Covers all 3 Revenue Divisions (Aruppukkottai, Sivakasi, Sattur) and 10 Revenue Taluks with authentic revenue village datasets.' : 'அருப்புக்கோட்டை, சிவகாசி, சாத்தூர் ஆகிய 3 வருவாய் கோட்டங்கள், 10 தாலுகாக்கள் மற்றும் 600 வருவாய் கிராமங்களையும் உள்ளடக்கிய நேரடி கட்டமைப்பு.' }}
                        </p>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; font-size: 28px; color: #0284c7;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() === 'en' ? 'Clear Accountability' : 'வெளிப்படையான கண்காணிப்பு' }}</h5>
                        <p class="text-muted small">
                            {{ app()->getLocale() === 'en' ? 'Every grievance gets an immutable audit log from registration, officer assignment, and department referral to verified on-site resolution.' : 'மனு பதிவு முதல் அதிகாரி நியமனம், துறைக்குப் பரிந்துரை மற்றும் களத் தீர்வு வரை ஒவ்வொரு கட்டமும் வெளிப்படையாக ஆவணப்படுத்தப்படுகிறது.' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
