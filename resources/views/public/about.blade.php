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

            <!-- Page Header: Tamil Nadu Scope with Deep Virudhunagar Focus -->
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1.5 rounded-pill mb-3 fw-bold shadow-xs">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                    {{ app()->getLocale() === 'en' ? 'Statewide Vision — Virudhunagar District Grassroots Hub' : 'தமிழ்நாடு அளவிலான தொலைநோக்கு — விருதுநகர் மாவட்டத்திற்கான சிறப்பு களப்பணி' }}
                </span>
                <h1 class="fw-bold text-dark display-5 mb-3">{{ __('messages.site_name') }}</h1>
                <p class="text-muted fs-5 mx-auto leading-relaxed" style="max-width: 820px;">
                    @if(app()->getLocale() === 'en')
                        <strong>Tamil Nadu Makkal Kural</strong> is a dedicated civic facilitation and public grievance redressal initiative empowering the citizens of Tamil Nadu, with a pioneering, intensive grassroots focus on the agrarian families, hardworking labourers, and rural communities across all 10 Taluks of <strong>Virudhunagar District</strong>.
                    @else
                        <strong>தமிழ்நாடு மக்கள் குரல்</strong> என்பது ஒட்டுமொத்த தமிழ்நாட்டு மக்களின் குரலாகவும், குறிப்பாக <strong>விருதுநகர் மாவட்டத்தின்</strong> உழவர்கள், தொழிலாளர்கள், வணிகர்கள் மற்றும் கடைக்கோடி கிராமத்து பாமர மக்களின் குடிநீர், சாலை, மின்சாரம், சுகாதாரம் உள்ளிட்ட அனைத்து அடிப்படை பிரச்சனைகளுக்கும் இடைத்தரகர்கள் இன்றி வெளிப்படைத்தன்மையுடன் உடனடி தீர்வு காணும் அர்ப்பணிப்புமிக்க மக்கள் சேவைத் தளமாகும்.
                    @endif
                </p>

                <!-- District Highlights Quick Counter Badge Row -->
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">
                        <i class="bi bi-compass-fill text-primary me-1"></i> {{ app()->getLocale() === 'en' ? 'Tamil Nadu 38 Districts Outreach' : 'தமிழ்நாட்டின் 38 மாவட்டங்களுக்கான குரல்' }}
                    </span>
                    <span class="badge bg-warning-subtle text-dark border border-warning px-3 py-2 rounded-pill small fw-semibold">
                        <i class="bi bi-pin-map-fill text-danger me-1"></i> {{ app()->getLocale() === 'en' ? 'Virudhunagar: 3 Divisions | 10 Taluks | 600 Villages' : 'விருதுநகர்: 3 கோட்டங்கள் | 10 தாலுகாக்கள் | 600 கிராமங்கள்' }}
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill small fw-semibold">
                        <i class="bi bi-shield-check me-1"></i> {{ app()->getLocale() === 'en' ? 'Zero Middlemen • 100% Direct Action' : 'இடைத்தரகர்கள் இல்லாத நேரடி தீர்வு' }}
                    </span>
                </div>
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
                                    {{ app()->getLocale() === 'en' ? 'State Leadership — Kisan Morcha' : 'மாநில தலைமை — விவசாய அணி' }}
                                </span>
                            </div>

                            @if(app()->getLocale() === 'en')
                                <h2 class="fw-bold text-dark mb-1 fs-3">Thiru. Rajesh Gurusamy</h2>
                                <div class="text-primary fw-bold mb-3" style="font-size: 1.05rem;">
                                    State Vice President — Kisan Morcha, Bharatiya Janata Party (BJP) Tamil Nadu
                                </div>

                                <p class="text-secondary leading-relaxed mb-3">
                                    The visionary and architect behind <strong>Tamil Nadu Makkal Kural</strong> is <strong>Thiru. Rajesh Gurusamy</strong>. Deeply rooted in the soil of Watrap and Virudhunagar, he initiated this civic grievance facilitation platform to ensure that the genuine concerns of common citizens, agricultural families, trade communities, and daily-wage workers reach government authorities directly without hurdles, paperwork exhaustion, or middlemen delays.
                                </p>

                                <p class="text-muted small mb-4">
                                    Beginning his dedicated public life in 2001 as Watrap Union Yuva Morcha President in Virudhunagar District, he has devoted 25 continuous years to grassroots leadership. Serving successively across district executive bodies, statewide IT cell modernisation, state election call center leadership, Commerce Cell State Secretary, and Kisan Morcha State Secretary, he currently guides statewide farmer empowerment as the State Vice President of Kisan Morcha, BJP Tamil Nadu, while keeping his heartbeat firmly anchored in the welfare of Virudhunagar District.
                                </p>
                            @else
                                <h2 class="fw-bold text-dark mb-1 fs-3">திரு. ராஜேஷ் குருசாமி</h2>
                                <div class="text-primary fw-bold mb-3" style="font-size: 1.05rem;">
                                    மாநில துணைத் தலைவர் — விவசாய அணி (Kisan Morcha), பாரதிய ஜனதா கட்சி (BJP) தமிழ்நாடு
                                </div>

                                <p class="text-secondary leading-relaxed mb-3">
                                    <strong>தமிழ்நாடு மக்கள் குரல்</strong> மக்கள் நலக் குறைதீர்க்கும் தளத்தின் வழிகாட்டியும், தொலைநோக்காளருமான <strong>திரு. ராஜேஷ் குருசாமி</strong> அவர்கள், விருதுநகர் மாவட்டத்தின் வத்திராயிருப்பு மண்ணின் மைந்தராவார். தமிழ்நாட்டு மக்களின் பொதுவான பிரச்சினைகளைத் தீர்ப்பதோடு, குறிப்பாக தனது சொந்த மாவட்டமான விருதுநகர் மாவட்டத்தின் கடைக்கோடி கிராமத்து பாமர மக்களின் குரலும், உழவர்கள் மற்றும் பட்டாசு-தீப்பெட்டி-நெசவுத் தொழிலாளர்களின் நியாயமான கோரிக்கைகளும் எந்தவொரு இடைத்தரகரும் இன்றி நேரடியாக அதிகாரிகளையும் மக்கள் பிரதிநிதிகளையும் சென்றடைய வேண்டும் என்ற உயரிய இலக்கோடு இத்தளத்தை வடிவமைத்துள்ளார்.
                                </p>

                                <p class="text-muted small mb-4">
                                    2001-ஆம் ஆண்டு விருதுநகர் மாவட்டம் வத்திராயிருப்பு ஒன்றிய இளைஞரணித் தலைவராக தனது மக்கள் பணியைத் தொடங்கி, மாவட்டச் செயற்குழு உறுப்பினர், மாநில தகவல் தொழில்நுட்பப் பிரிவு, மாநில தேர்தல் அழைப்பு மையத் தலைமை, வணிகர் அணி மாநிலச் செயலாளர், விவசாய அணி மாநிலச் செயலாளர் என 25 ஆண்டுகளாக பாரதிய ஜனதா கட்சியில் அர்ப்பணிப்புடன் செயலாற்றி, தற்போது தமிழ்நாடு விவசாய அணியின் மாநில துணைத் தலைவராக உழவர் நலம், ஊரக வளர்ச்சி மற்றும் விருதுநகர் மக்களின் உரிமைக்காகத் தொடர்ந்து அயராது பாடுபட்டு வருகிறார்.
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
                 SPECIAL FOCUS: WHY VIRUDHUNAGAR DISTRICT IS THE PRIMARY OPERATIONAL HUB
                 ========================================================================= -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5 bg-white" style="border-left: 5px solid #ff7722 !important;">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-warning text-dark px-2.5 py-1 fw-bold small">
                                <i class="bi bi-bullseye me-1"></i> {{ app()->getLocale() === 'en' ? 'Special Ground Focus' : 'சிறப்பு களப்பணி மையம்' }}
                            </span>
                            <span class="text-muted small fw-semibold">
                                {{ app()->getLocale() === 'en' ? 'Virudhunagar District' : 'விருதுநகர் மாவட்டம்' }}
                            </span>
                        </div>

                        @if(app()->getLocale() === 'en')
                            <h3 class="fw-bold text-dark mb-3">Dedicated to the Pride and Welfare of Virudhunagar District</h3>
                            <p class="text-secondary leading-relaxed mb-3">
                                Virudhunagar District—the revered birthplace of <em>Karma Veerar Perunthalaivar Kamarajar</em>—is renowned for its entrepreneurial energy, commercial trade, match works, fireworks clusters, printing presses, cotton handlooms, and resilient farmers. Yet, across rural taluks like Watrap, Rajapalayam, Sattur, and Aruppukkottai, thousands of families face chronic drinking water shortages, unpaved agricultural link roads, irrigation channel blocks, and delayed civic amenities.
                            </p>
                            <p class="text-muted small mb-0">
                                <strong>Tamil Nadu Makkal Kural</strong> directly bridges this gap. With complete geographic mapping across all <strong>3 Revenue Divisions</strong> (Aruppukkottai, Sivakasi, Sattur), <strong>10 Taluks</strong>, 39 Firkas, and <strong>600 Revenue Villages</strong>, every village petition is logged with authentic GPS proof and tracked till actual on-ground resolution.
                            </p>
                        @else
                            <h3 class="fw-bold text-dark mb-3">விருதுநகர் மாவட்ட மக்களின் உரிமையும், உடனடி களத் தீர்வுகளும்</h3>
                            <p class="text-secondary leading-relaxed mb-3">
                                கர்மவீரர் பெருந்தலைவர் காமராஜர் அவதரித்த புண்ணிய பூமி விருதுநகர் மாவட்டம்! கடுமையான உழைப்பிற்கும், வணிகத் திறனுக்கும், பட்டாசு-தீப்பெட்டி-அச்சுத் தொழில்களுக்கும், பருத்தி மற்றும் உழவுத் தொழிலுக்கும் உலகளவில் பெயர்பெற்ற இம்மாவட்டத்தில், இன்றும் பல கிராமங்களில் குடிநீர் பற்றாக்குறை, சேதமடைந்த ஊரகச் சாலைகள், பாசனக் கால்வாய் தூர்வாரப்படாமை மற்றும் அடிப்படை உட்கட்டமைப்புத் தேவைகள் தீர்க்கப்படாமல் உள்ளன.
                            </p>
                            <p class="text-muted small mb-0">
                                <strong>தமிழ்நாடு மக்கள் குரல்</strong> தளம், விருதுநகர் மாவட்டத்தின் <strong>3 வருவாய் கோட்டங்கள்</strong> (அருப்புக்கோட்டை, சிவகாசி, சாத்தூர்), <strong>10 வட்டங்கள்</strong> (விருதுநகர், சிவகாசி, ராஜபாளையம், ஸ்ரீவில்லிபுத்தூர், வத்திராயிருப்பு, சாத்தூர், அருப்புக்கோட்டை, காரியாபட்டி, திருச்சுழி, வெம்பக்கோட்டை) மற்றும் <strong>600 வருவாய் கிராமங்களில்</strong> உள்ள மக்களின் மனுக்களை எவ்வித அலைச்சலுமின்றி உடனடியாகப் பதிவு செய்து, சம்பந்தப்பட்ட துறை அதிகாரிகளிடம் முறையிட்டு தீர்வு காண முன்னுரிமை அளிக்கிறது.
                            </p>
                        @endif
                    </div>

                    <div class="col-lg-5">
                        <div class="p-3.5 rounded-4 bg-light border">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                                <i class="bi bi-building-check text-primary"></i>
                                {{ app()->getLocale() === 'en' ? 'Virudhunagar Administrative Coverage' : 'விருதுநகர் நிர்வாக வரைபடம்' }}
                            </h6>
                            <ul class="list-unstyled mb-0 small text-secondary">
                                <li class="py-1.5 border-bottom d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-geo-alt text-danger me-1"></i> {{ app()->getLocale() === 'en' ? 'Revenue Divisions (3)' : 'வருவாய் கோட்டங்கள் (3)' }}</span>
                                    <strong class="text-dark">Aruppukkottai, Sivakasi, Sattur</strong>
                                </li>
                                <li class="py-1.5 border-bottom d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-diagram-3 text-primary me-1"></i> {{ app()->getLocale() === 'en' ? 'Taluks Covered (10)' : 'தாலுகாக்கள் (10)' }}</span>
                                    <strong class="text-dark">10 Taluks</strong>
                                </li>
                                <li class="py-1.5 border-bottom d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-houses-fill text-success me-1"></i> {{ app()->getLocale() === 'en' ? 'Revenue Villages' : 'வருவாய் கிராமங்கள்' }}</span>
                                    <strong class="text-dark">600 Villages</strong>
                                </li>
                                <li class="py-1.5 border-bottom d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-people-fill text-warning me-1"></i> {{ app()->getLocale() === 'en' ? 'Firkas Covered' : 'உள்வட்டங்கள் (Firkas)' }}</span>
                                    <strong class="text-dark">39 Firkas</strong>
                                </li>
                                <li class="pt-1.5 d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-globe-central-south text-info me-1"></i> {{ app()->getLocale() === 'en' ? 'Tamil Nadu Coverage' : 'தமிழ்நாடு முழுமைக்குமான கட்டமைப்பு' }}</span>
                                    <strong class="text-success fw-bold">38 Districts</strong>
                                </li>
                            </ul>
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
                                    பாரதிய ஜனதா கட்சி (BJP) — தமிழ்நாடு. மாநிலம் தழுவிய உழவர் நலம், விவசாயக் குறைதீர்க்கும் முன்னெடுப்புகள், மத்திய அரசு திட்டங்களை மக்களிடம் கொண்டு சேர்த்தல் மற்றும் கிராமப்புற கட்டமைப்புப் பணிகள்.
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
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநிலச் செயலாளர் — விவசாய அணி, பாஜக தமிழ்நாடு</h5>
                                <p class="text-muted small mb-0">
                                    விவசாயிகள் மாநாடுகள், கள ஆய்வு முகாம்கள், உழவர் விழிப்புணர்வுப் பயணங்கள் மற்றும் தென் மாவட்ட விவசாயிகளின் பாசனப் பிரச்சனைகளுக்குத் தீர்வு காணும் போராட்டங்களை முன்னின்று நடத்தினார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2020 - 2025 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #0284c7 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2020 — 2025</span>
                                    <small class="text-muted">மத்திய திட்டங்கள்</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநிலப் பொறுப்பாளர் (மத்திய திட்டங்கள்) & மண்டல இணைப் பொறுப்பாளர்</h5>
                                <p class="text-muted small mb-0">
                                    பிரதமரின் கிசான் சம்மான் நிதி (PM-Kisan), கிசான் கடன் அட்டை (KCC) மற்றும் இயற்கை விவசாய ஊக்குவிப்பு திட்டங்களுக்கான மாநிலப் பொறுப்பாளராகச் செயல்பட்டார்.
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
                                <h5 class="fw-bold text-dark fs-6 mb-1">சிறு, குறு வணிகர்கள் மற்றும் MSME கடன் வழிகாட்டுதல்</h5>
                                <p class="text-muted small mb-0">
                                    கொரோனா பெருந்தொற்றுப் பொதுமுடக்கத்தால் பாதிக்கப்பட்ட வணிகர்கள் மற்றும் சிறு நிறுவனங்களுக்கு மத்திய அரசின் பிணையில்லா அவசரகாலக் கடன் (ECLGS) கிடைக்க வங்கிகளுடன் ஒருங்கிணைந்து வழிகாட்டினார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2014 - 2017 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #6366f1 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2014 — 2017</span>
                                    <small class="text-muted">வணிகர் அணி</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநிலச் செயலாளர் — வணிகர் அணி, பாஜக தமிழ்நாடு</h5>
                                <p class="text-muted small mb-0">
                                    தமிழ்நாடு முழுவதும் உள்ள வணிகர் சங்கங்கள், மொத்த விற்பனை அமைப்புகள் மற்றும் தொழில்முனைவோரை ஒருங்கிணைத்து வர்த்தக வளர்ச்சிக்கு உறுதுணையாக நின்றார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2012 - 2016 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #ec4899 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2012 — 2016</span>
                                    <small class="text-muted">தகவல் தொழில்நுட்பம்</small>
                                </div>
                                <h5 class="fw-bold text-dark fs-6 mb-1">மாநில தகவல் தொழில்நுட்பப் பிரிவு & அழைப்பு மையத் தலைமை</h5>
                                <p class="text-muted small mb-0">
                                    தமிழ்நாடு மாநில அளவிலான தேர்தல் அழைப்பு மையம் (State Call Centre) மற்றும் தகவல் தொழில்நுட்ப உள்கட்டமைப்பை நிறுவி, சாதனை அளவிலான உறுப்பினர் சேர்க்கையை ஒருங்கிணைத்தார்.
                                </p>
                            </div>
                        </div>

                        <!-- 2003 - 2008 -->
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 border bg-light h-100" style="border-left: 4px solid #0d9488 !important;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary text-white" style="font-size: 0.72rem;">2003 — 2008</span>
                                    <small class="text-muted">விருதுநகர் மாவட்ட நிர்வாகம்</small>
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
                                <h5 class="fw-bold text-dark fs-6 mb-1">வத்திராயிருப்பு ஒன்றிய இளைஞரணித் தலைவர்</h5>
                                <p class="text-muted small mb-0">
                                    விருதுநகர் மாவட்டம் வத்திராயிருப்பு ஒன்றிய அளவில் தனது நேரடி மக்கள் பணியைத் தொடங்கி, கிராமப்புற அடித்தள மக்களின் நலனுக்காகச் செயலாற்றினார்.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- =========================================================================
                 THE GUIDING IDEOLOGY: ANTYODAYA & DIGITAL CITIZEN SERVICE
                 ========================================================================= -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-top: 4px solid #ff7722 !important;">
                        <div class="rounded-circle bg-warning-subtle text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px; font-size: 22px;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ app()->getLocale() === 'en' ? 'Antyodaya Civic Mission' : 'கடைக்கோடி மனிதனுக்கும் சேவை (அந்தியோதயா)' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            @if(app()->getLocale() === 'en')
                                Inspired by Pandit Deendayal Upadhyaya's Antyodaya principle, ensuring that government welfare and basic civic infrastructure reach the most underprivileged rural family in Virudhunagar and across Tamil Nadu.
                            @else
                                பண்டிட் தீனதயாள் உபாத்யாயாவின் 'அந்தியோதயா' தத்துவத்தின்படி, வரிசையில் நிற்கும் கடைக்கோடி மனிதனுக்கும் அடிப்படை அரசு நலன்களும் பொது உட்கட்டமைப்புகளும் சென்றடைவதை உறுதி செய்தல்.
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
                        <p class="text-secondary mb-0 leading-relaxed">
                            @if(app()->getLocale() === 'en')
                                To provide the people of Tamil Nadu, and specifically every citizen across the 10 taluks and 600 villages of Virudhunagar District, a transparent, bilingual, digital petition portal that eliminates middlemen, ensures administrative accountability, and follows through until issues are resolved.
                            @else
                                தமிழ்நாட்டின் அனைத்து பகுதி மக்களுக்கும், குறிப்பாக விருதுநகர் மாவட்டத்தின் 10 வட்டங்கள் மற்றும் 600 வருவாய் கிராமங்களில் வாழும் அடித்தட்டு உழவர்கள், தொழிலாளர்கள் மற்றும் குடும்பங்களின் அடிப்படைத் தேவைகளுக்கும் அரசு நிர்வாகத்திற்கும் இடையே நம்பகமான பாலமாக அமைந்து, ஒவ்வொரு கோரிக்கையையும் வெளிப்படைத்தன்மையுடன் தீர்வு காண்பதே எங்களின் முதன்மை நோக்கம்.
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
                        <p class="text-secondary mb-0 leading-relaxed">
                            @if(app()->getLocale() === 'en')
                                A responsive, citizen-first civic ecosystem where community problems—from drinking water pipeline leakages to rural road repairs—are documented with authentic geolocation data and resolved with measurable service level agreements.
                            @else
                                குடிநீர் குழாய் உடைப்பு முதல் கிராமப்புற சாலை சீரமைப்பு வரை அனைத்து பொதுப் பிரச்சனைகளும் உண்மையான களத்தரவுகளுடன் ஆவணப்படுத்தப்பட்டு, காலக்கெடுவுடன் தீர்க்கப்படும் ஒரு முன்மாதிரி மாவட்ட மக்கள் நிர்வாகத்தை உருவாக்கி அதைத் தமிழ்நாடு முழுமைக்கும் முன்மாதிரியாக மாற்றுதல்.
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
