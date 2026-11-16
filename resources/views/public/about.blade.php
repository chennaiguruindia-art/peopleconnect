@extends('layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'About Us' : 'எங்களைப் பற்றி') . ' - Public Grievance Management Platform')

@section('content')
<div class="container py-4 py-md-5 px-3 px-sm-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">{{ __('messages.nav_home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_about') }}</li>
                </ol>
            </nav>

            <!-- 1. PAGE HERO HEADER: WHO WE ARE -->
            <div class="text-center mb-4 mb-md-5">
                <span class="badge bg-warning-subtle text-dark border border-warning px-3 py-1.5 rounded-pill mb-3 fw-bold shadow-xs text-wrap text-center" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <i class="bi bi-megaphone-fill text-danger me-1"></i>
                    {{ app()->getLocale() === 'en' ? 'VOICE OF THE VOICELESS — CITIZEN CIVIC PLATFORM' : 'குரலற்ற மக்களின் குரல் — பொது மக்கள் குறைதீர்க்கும் தளம்' }}
                </span>

                <h1 class="fw-extrabold text-navy fs-2 fs-md-1 mb-3">
                    {{ app()->getLocale() === 'en' ? 'About Public Grievance Management Platform' : 'பொது மக்கள் குறைதீர்க்கும் தளம் — எங்களைப் பற்றி' }}
                </h1>

                <p class="text-muted fs-6 fs-md-5 mx-auto leading-relaxed" style="max-width: 820px;">
                    @if(app()->getLocale() === 'en')
                        <strong>Public Grievance Management Platform</strong> is an independent, citizen-first civic facilitation network established to bridge the gap between citizens and administrative bodies. We empower residents across Tamil Nadu to report, document, and resolve community problems transparently without middlemen or procedural delays.
                    @else
                        <strong>பொது மக்கள் குறைதீர்க்கும் தளம் (Public Grievance Management Platform)</strong> என்பது பொதுமக்களுக்கும் அரசு நிர்வாக அமைப்புகளுக்கும் இடையே வெளிப்படையான பாலமாகச் செயல்படும் ஒரு சுயாதீன மக்கள் சேவைத் தளமாகும். தமிழ்நாட்டு மக்கள் தங்கள் பகுதியில் உள்ள குடிநீர், சாலை, மின்சாரம், சுகாதாரம் உள்ளிட்ட அனைத்து அடிப்படைப் பொதுப் பிரச்சனைகளையும் இடைத்தரகர்கள் இன்றி நேரடியாகப் பதிவு செய்து துரித தீர்வு காண இத்தளம் உதவுகிறது.
                    @endif
                </p>

                <!-- Core Highlights Badge Row -->
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">
                        <i class="bi bi-shield-check text-success me-1"></i>
                        {{ app()->getLocale() === 'en' ? '100% Direct Citizen Action' : 'இடைத்தரகர்கள் இல்லாத நேரடி தீர்வு' }}
                    </span>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill small fw-semibold">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                        {{ app()->getLocale() === 'en' ? 'Grassroots District & Village Reach' : 'மாவட்டம், வட்டம் & கிராமப்புற நேரடி இணைப்பு' }}
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill small fw-semibold">
                        <i class="bi bi-broadcast me-1"></i>
                        {{ app()->getLocale() === 'en' ? 'End-to-End Live Tracking' : 'முழுமையான நேரடி கண்காணிப்பு' }}
                    </span>
                </div>
            </div>

            <!-- 2. WHO WE ARE (OVERVIEW CARD) -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 mb-md-5 bg-white">
                <div class="p-1" style="background: linear-gradient(90deg, #ea580c, #ffffff, #16a34a);"></div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <span class="badge bg-primary text-white px-2.5 py-1 fw-bold small mb-2 text-uppercase" style="letter-spacing: 0.5px;">
                                {{ app()->getLocale() === 'en' ? 'Who We Are' : 'நாம் யார்?' }}
                            </span>
                            <h2 class="fw-bold text-navy fs-3 mb-3">
                                {{ app()->getLocale() === 'en' ? 'Empowering Citizens, Elevating Civic Life' : 'மக்களின் உரிமைகளுக்காக, மக்களின் குரலாக ஒலிக்கும் தளம்' }}
                            </h2>

                            @if(app()->getLocale() === 'en')
                                <p class="text-secondary leading-relaxed mb-3">
                                    In many localities, genuine civic difficulties—from contaminated drinking water and broken roads to non-functioning streetlights—often go unheard due to complicated administrative workflows or lack of documentation.
                                </p>
                                <p class="text-secondary leading-relaxed mb-0">
                                    Our platform provides every citizen an equal, straightforward digital channel to document grievances with photos and location details. Once recorded, petitions are organized, verified, and officially presented to the respective municipal and government departments for measurable, time-bound action.
                                </p>
                            @else
                                <p class="text-secondary leading-relaxed mb-3">
                                    பல கிராமங்களிலும் நகர்ப்புறப் பகுதிகளிலும் சேதமடைந்த சாலைகள், குடிநீர் பற்றாக்குறை, தெருவிளக்கு எரியாமை, சாக்கடை அடைப்பு போன்ற அன்றாடப் பொதுப் பிரச்சனைகள் உரிய அதிகாரிகளைச் சென்றடைவதில் தாமதம் ஏற்படுகிறது. மனுக்களை யாரிடம் கொடுப்பது என்ற விழிப்புணர்வு இன்மை மற்றும் முறையான ஆவணப்படுத்துதல் இல்லாததே இதற்கு முக்கிய காரணமாகும்.
                                </p>
                                <p class="text-secondary leading-relaxed mb-0">
                                    இச்சிக்கலுக்கு முற்றுப்புள்ளி வைக்கும் வகையில், இத்தளம் எளிய மக்களுக்கும் தொழில்நுட்பத்தின் வலிமையைக் கொண்டு சேர்க்கிறது. பொதுமக்கள் தங்கள் ஸ்மார்ட்போன் வழியாகவே புகைப்படங்களுடன் புகார்களைப் பதிவு செய்யலாம். அப்புகார்கள் சரிபார்க்கப்பட்டு, சம்பந்தப்பட்ட அரசு மற்றும் உள்ளாட்சித் துறைகளின் கவனத்திற்குக் கொண்டு செல்லப்பட்டு தீர்வு காண வழிவகை செய்யப்படுகிறது.
                                </p>
                            @endif
                        </div>

                        <div class="col-lg-6">
                            <div class="p-4 rounded-4 bg-light border">
                                <h5 class="fw-bold text-navy mb-3 d-flex align-items-center gap-2 fs-6">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    {{ app()->getLocale() === 'en' ? 'What Sets This Platform Apart?' : 'இத்தளத்தின் தனித்துவங்கள் என்ன?' }}
                                </h5>
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex align-items-start gap-2.5">
                                        <div class="rounded-circle bg-white text-primary shadow-xs d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                                            <i class="bi bi-check-lg fw-bold"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark small fw-bold">
                                                {{ app()->getLocale() === 'en' ? 'Direct Registration without Middlemen' : 'இடைத்தரகர்கள் இல்லாத நேரடி பதிவு' }}
                                            </strong>
                                            <small class="text-secondary">
                                                {{ app()->getLocale() === 'en' ? 'Citizens register petitions directly without paying any fees or relying on intermediaries.' : 'பொதுமக்கள் யாரிடமும் கெஞ்சாமல், எந்தக் கட்டணமும் இன்றி தங்கள் புகார்களை நேரடியாகப் பதிவு செய்யலாம்.' }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-2.5">
                                        <div class="rounded-circle bg-white text-success shadow-xs d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                                            <i class="bi bi-camera-fill"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark small fw-bold">
                                                {{ app()->getLocale() === 'en' ? 'Authentic Photo & Location Proof' : 'உண்மையான புகைப்படச் சான்றுகள்' }}
                                            </strong>
                                            <small class="text-secondary">
                                                {{ app()->getLocale() === 'en' ? 'Every petition is accompanied by real visual evidence ensuring authentic administrative review.' : 'புகைப்படம் மற்றும் பகுதி விவரங்களுடன் பதிவு செய்யப்படுவதால் அதிகாரிகள் உடனடியாக கள ஆய்வு செய்ய முடிகிறது.' }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-2.5">
                                        <div class="rounded-circle bg-white text-warning shadow-xs d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                                            <i class="bi bi-qr-code-scan"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark small fw-bold">
                                                {{ app()->getLocale() === 'en' ? 'Unique Tracking ID' : 'தனித்துவமான புகார் அடையாள எண்' }}
                                            </strong>
                                            <small class="text-secondary">
                                                {{ app()->getLocale() === 'en' ? 'Instant complaint tracking ID enables citizens to follow petition progress at every stage.' : 'ஒவ்வொரு புகாருக்கும் தனி எண் வழங்கப்பட்டு, அதன் நடவடிக்கை நிலை என்னவென்று வெளிப்படையாகத் தெரிந்து கொள்ளலாம்.' }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. MISSION & VISION -->
            <div class="row g-3 g-md-4 mb-4 mb-md-5">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-left: 5px solid #ea580c !important;">
                        <div class="d-flex align-items-center gap-2.5 mb-3">
                            <span class="badge bg-warning-subtle text-warning p-2.5 rounded-3">
                                <i class="bi bi-bullseye fs-4 text-danger"></i>
                            </span>
                            <h4 class="fw-bold text-navy mb-0 fs-5">{{ app()->getLocale() === 'en' ? 'Our Mission' : 'எங்கள் நோக்கம் (Our Mission)' }}</h4>
                        </div>
                        <p class="text-secondary mb-0 leading-relaxed small">
                            @if(app()->getLocale() === 'en')
                                To provide an accessible, transparent, and bilingual grievance redressal portal where every citizen's voice is heard, accurately documented, and coordinated with public authorities to achieve measurable civic solutions.
                            @else
                                தமிழ்நாட்டின் ஒவ்வொரு குடிமகனும் தங்கள் பகுதிப் பொதுப் பிரச்சனைகளை எளிமையாகவும் வெளிப்படைத்தன்மையுடனும் பதிவு செய்யவும், அப்புகார்களை முறைப்படி ஆவணப்படுத்தி சம்பந்தப்பட்ட அரசு நிர்வாக அமைப்புகளுக்குக் கொண்டு சென்று மக்கள் நலனை உறுதி செய்வதே எங்களின் தலையாய நோக்கமாகும்.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="border-left: 5px solid #16a34a !important;">
                        <div class="d-flex align-items-center gap-2.5 mb-3">
                            <span class="badge bg-success-subtle text-success p-2.5 rounded-3">
                                <i class="bi bi-eye-fill fs-4 text-success"></i>
                            </span>
                            <h4 class="fw-bold text-navy mb-0 fs-5">{{ app()->getLocale() === 'en' ? 'Our Vision' : 'எங்கள் தொலைநோக்கு (Our Vision)' }}</h4>
                        </div>
                        <p class="text-secondary mb-0 leading-relaxed small">
                            @if(app()->getLocale() === 'en')
                                To cultivate a modern, responsive civic ecosystem where community infrastructure needs—clean drinking water, proper drainage, safe roads, and reliable power—are addressed promptly with digital transparency and zero administrative apathy.
                            @else
                                சுத்தமான குடிநீர், பாதுகாப்பான சாலைகள், முறையான மின்சார வசதி மற்றும் தூய்மையான சுற்றுப்புறம் ஆகியவை ஒவ்வொரு குடிமகனுக்கும் தடையின்றி கிடைப்பதை உறுதி செய்து, மக்கள் குறைகள் உடனுக்குடன் தீர்க்கப்படும் ஒரு முன்மாதிரி டிஜிட்டல் சமூகத்தை உருவாக்குவதே எங்களின் தொலைநோக்காகும்.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- 4. HOW THE PLATFORM WORKS (4-STEP PROCESS) -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 mb-md-5 bg-white">
                <div class="text-center mb-4">
                    <span class="badge bg-secondary-subtle text-secondary px-3 py-1 rounded-pill small fw-bold text-uppercase" style="letter-spacing: 0.5px;">
                        {{ app()->getLocale() === 'en' ? 'Workflow' : 'செயல்முறை' }}
                    </span>
                    <h3 class="fw-bold text-navy fs-4 fs-md-3 mt-1 mb-2">
                        {{ app()->getLocale() === 'en' ? 'How the Grievance Redressal Platform Works' : 'புகார் பதிவு முதல் நடவடிக்கை வரை — எளிய செயல்முறை' }}
                    </h3>
                    <p class="text-muted small mx-auto" style="max-width: 620px;">
                        {{ app()->getLocale() === 'en' ? 'A systematic, step-by-step workflow designed to ensure every complaint is verified and addressed.' : 'உங்கள் புகார் உரிய அதிகாரிகளைச் சென்றடைய நாங்கள் பின்பற்றும் எளிய 4-படி நடைமுறை.' }}
                    </p>
                </div>

                <div class="row g-3 g-md-4 text-center">
                    <!-- Step 1 -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light h-100 border">
                            <div class="rounded-circle text-white mx-auto mb-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 52px; height: 52px; background: #ea580c; font-size: 20px;">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <h5 class="fw-bold text-dark fs-6 mb-1">{{ app()->getLocale() === 'en' ? '1. Submit' : '1. புகார் பதிவு' }}</h5>
                            <small class="text-muted d-block" style="font-size: 0.78rem;">
                                {{ app()->getLocale() === 'en' ? 'Register details with photos and location' : 'விவரங்கள் & புகைப்படங்களுடன் புகாரைப் பதிவு செய்யவும்' }}
                            </small>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light h-100 border">
                            <div class="rounded-circle text-white mx-auto mb-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 52px; height: 52px; background: #0284c7; font-size: 20px;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h5 class="fw-bold text-dark fs-6 mb-1">{{ app()->getLocale() === 'en' ? '2. Verification' : '2. சரிபார்ப்பு' }}</h5>
                            <small class="text-muted d-block" style="font-size: 0.78rem;">
                                {{ app()->getLocale() === 'en' ? 'Our civic team reviews authenticity' : 'புகார் விவரங்கள் எங்கள் குழுவால் சரிபார்க்கப்படும்' }}
                            </small>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light h-100 border">
                            <div class="rounded-circle text-white mx-auto mb-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 52px; height: 52px; background: #16a34a; font-size: 20px;">
                                <i class="bi bi-bank2"></i>
                            </div>
                            <h5 class="fw-bold text-dark fs-6 mb-1">{{ app()->getLocale() === 'en' ? '3. Official Escalation' : '3. அரசுத் துறைக்கு அனுப்புதல்' }}</h5>
                            <small class="text-muted d-block" style="font-size: 0.78rem;">
                                {{ app()->getLocale() === 'en' ? 'Forwarded to the concerned civic department' : 'சம்பந்தப்பட்ட அரசு அல்லது உள்ளாட்சித் துறைக்கு அனுப்பப்படும்' }}
                            </small>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-light h-100 border">
                            <div class="rounded-circle text-white mx-auto mb-3 d-flex align-items-center justify-content-center shadow-xs" style="width: 52px; height: 52px; background: #7c3aed; font-size: 20px;">
                                <i class="bi bi-clipboard2-check-fill"></i>
                            </div>
                            <h5 class="fw-bold text-dark fs-6 mb-1">{{ app()->getLocale() === 'en' ? '4. Tracking' : '4. கண்காணிப்பு' }}</h5>
                            <small class="text-muted d-block" style="font-size: 0.78rem;">
                                {{ app()->getLocale() === 'en' ? 'Follow resolution status live with Complaint ID' : 'புகாரின் நடவடிக்கை நிலையை ஆன்லைனில் அறியலாம்' }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. CATEGORIES OF GRIEVANCES WE ADDRESS -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 mb-md-5 bg-white">
                <div class="text-center mb-4">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill small fw-bold text-uppercase" style="letter-spacing: 0.5px;">
                        {{ app()->getLocale() === 'en' ? 'Scope of Service' : 'சேவை வகைகள்' }}
                    </span>
                    <h3 class="fw-bold text-navy fs-4 fs-md-3 mt-1 mb-2">
                        {{ app()->getLocale() === 'en' ? 'Civic Categories We Cover' : 'நாங்கள் தீர்வு காணும் பொதுப் பிரச்சனைகள்' }}
                    </h3>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-md-4">
                        <div class="p-3 rounded-4 bg-light border text-center h-100">
                            <div class="fs-2 text-dark mb-2"><i class="bi bi-signpost-2-fill"></i></div>
                            <h6 class="fw-bold text-navy mb-1 small">{{ app()->getLocale() === 'en' ? 'Roads & Bridges' : 'சாலை வசதி' }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">சேதமடைந்த சாலைகள், பாலங்கள் & போக்குவரத்து</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3 rounded-4 bg-light border text-center h-100">
                            <div class="fs-2 text-primary mb-2"><i class="bi bi-droplet-fill"></i></div>
                            <h6 class="fw-bold text-navy mb-1 small">{{ app()->getLocale() === 'en' ? 'Drinking Water' : 'குடிநீர் விநியோகம்' }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">குடிநீர் பற்றாக்குறை, குழாய் உடைப்பு & தூய்மை</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3 rounded-4 bg-light border text-center h-100">
                            <div class="fs-2 text-warning mb-2"><i class="bi bi-lightning-charge-fill"></i></div>
                            <h6 class="fw-bold text-navy mb-1 small">{{ app()->getLocale() === 'en' ? 'Electricity & Lighting' : 'மின்சாரம் & தெருவிளக்கு' }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">தெருவிளக்கு எரியாமை, மின்கம்ப பழுது</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3 rounded-4 bg-light border text-center h-100">
                            <div class="fs-2 text-success mb-2"><i class="bi bi-trash3-fill"></i></div>
                            <h6 class="fw-bold text-navy mb-1 small">{{ app()->getLocale() === 'en' ? 'Sanitation & Hygiene' : 'சுகாதாரம் & துப்புரவு' }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">சாக்கடை அடைப்பு, குப்பை அகற்றுதல்</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3 rounded-4 bg-light border text-center h-100">
                            <div class="fs-2 text-info mb-2"><i class="bi bi-mortarboard-fill"></i></div>
                            <h6 class="fw-bold text-navy mb-1 small">{{ app()->getLocale() === 'en' ? 'Education & Schools' : 'கல்வி & பள்ளிகள்' }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">பள்ளி உள்கட்டமைப்பு, கல்வி உதவிகள்</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="p-3 rounded-4 bg-light border text-center h-100">
                            <div class="fs-2 text-danger mb-2"><i class="bi bi-hospital-fill"></i></div>
                            <h6 class="fw-bold text-navy mb-1 small">{{ app()->getLocale() === 'en' ? 'Healthcare & Clinics' : 'மருத்துவம் & பொது சுகாதாரம்' }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">ஆரம்ப சுகாதார நிலையங்கள், மருத்துவ வசதிகள்</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. CORE OPERATING PRINCIPLES -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 mb-md-5 bg-white">
                <h3 class="fw-bold text-navy mb-4 text-center fs-4 fs-md-3">
                    {{ app()->getLocale() === 'en' ? 'Our Core Operating Principles' : 'எங்கள் முதன்மைக் கொள்கைகள்' }}
                </h3>
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; font-size: 24px; color: #ea580c;">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2 fs-6">{{ app()->getLocale() === 'en' ? 'Citizen Privacy & Security' : 'தனியுரிமை & தகவல் பாதுகாப்பு' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() === 'en' ? 'Citizen phone numbers and private addresses are strictly protected and never disclosed publicly.' : 'மனுதாரர்களின் தொலைபேசி எண் மற்றும் முகவரி போன்ற தனிப்பட்ட விவரங்கள் பொதுவெளியில் பகிரப்படாமல் முழுமையாகப் பாதுகாக்கப்படுகின்றன.' }}
                        </p>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; font-size: 24px; color: #16a34a;">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2 fs-6">{{ app()->getLocale() === 'en' ? 'Authentic Civic Mapping' : 'துல்லியமான பகுதி விவரங்கள்' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() === 'en' ? 'Every complaint is accurately mapped to its district, taluk, ward, or revenue village for direct administrative action.' : 'ஒவ்வொரு புகாரும் அதன் மாவட்டம், வட்டம், கிராமம் மற்றும் வார்டு வாரியாக துல்லியமாக ஆவணப்படுத்தப்படுகிறது.' }}
                        </p>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 54px; height: 54px; font-size: 24px; color: #0284c7;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h5 class="fw-bold mb-2 fs-6">{{ app()->getLocale() === 'en' ? 'Full Transparency' : 'வெளிப்படையான கண்காணிப்பு' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() === 'en' ? 'From registration to departmental referral and verified on-site completion, progress is tracked clearly.' : 'மனு பதிவு முதல் துறைக்கு பரிந்துரைப்பது மற்றும் களத் தீர்வு வரை ஒவ்வொரு கட்டமும் வெளிப்படையாக கண்காணிக்கப்படுகிறது.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 7. OFFICIAL DISCLAIMER BANNER -->
            <div class="disclaimer-banner d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3 p-3 p-sm-4 mb-4 mb-md-5 rounded-4 shadow-xs" style="background-color: #fff7ed; border: 1px solid #fed7aa;">
                <i class="bi bi-info-circle-fill fs-2 text-warning flex-shrink-0"></i>
                <div>
                    <h5 class="fw-bold text-dark mb-1 fs-6">
                        {{ app()->getLocale() === 'en' ? 'Independent Civic Portal Disclaimer' : 'சுயாதீன மக்கள் குறைதீர்ப்பு உதவி தளம்' }}
                    </h5>
                    <p class="mb-0 text-secondary small">
                        {{ __('messages.disclaimer_text') }}
                    </p>
                </div>
            </div>

            <!-- 8. CALL TO ACTION -->
            <div class="card border-0 rounded-4 p-4 p-md-5 text-white text-center shadow-sm" style="background-color: #0b1f3a;">
                <h3 class="fw-bold mb-2 fs-4 fs-md-3">
                    {{ app()->getLocale() === 'en' ? 'Have a civic problem in your neighborhood?' : 'உங்கள் பகுதியில் பொதுப் பிரச்சனை உள்ளதா?' }}
                </h3>
                <p class="text-white-50 small mb-4 mx-auto" style="max-width: 600px;">
                    {{ app()->getLocale() === 'en' ? 'Submit your complaint online with photos or check the live progress of an existing petition anytime.' : 'புகாரை உடனடியாக புகைப்படங்களுடன் பதிவு செய்யுங்கள் அல்லது உங்கள் புகாரின் நடவடிக்கை நிலையை உடனே ஆன்லைனில் தெரிந்து கொள்ளுங்கள்.' }}
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-2 gap-sm-3">
                    <a href="{{ route('complaints.create') }}" class="btn btn-hero-orange rounded-pill px-4 py-2.5 fw-bold d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="bi bi-pencil-fill"></i>
                        <span>{{ app()->getLocale() === 'en' ? 'Submit Grievance' : 'புகாரைப் பதிவு செய்யுங்கள்' }}</span>
                    </a>
                    <a href="{{ route('complaints.track') }}" class="btn btn-outline-light rounded-pill px-4 py-2.5 fw-bold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-search"></i>
                        <span>{{ app()->getLocale() === 'en' ? 'Track Grievance' : 'புகார் நிலையை அறியுங்கள்' }}</span>
                    </a>
                    <a href="tel:+919384995222" class="btn btn-light rounded-pill px-3.5 py-2.5 fw-bold text-dark d-inline-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-success"></i>
                        <span>+91 9384995222</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
