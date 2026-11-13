@extends('layouts.app')

@section('title', __('messages.form_title'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Title & Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_submit_complaint') }}</li>
                </ol>
            </nav>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">{{ __('messages.form_title') }}</h2>
                    <p class="text-muted mb-0">{{ __('messages.form_subtitle') }}</p>
                </div>
                <div class="badge bg-warning-subtle text-dark border border-warning px-3 py-2 small d-none d-md-block">
                    <i class="bi bi-shield-lock-fill text-warning me-1"></i> SSL Encrypted & Verifiable
                </div>
            </div>

            <!-- Disclaimer Banner -->
            <div class="disclaimer-banner d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-info-circle-fill fs-5 flex-shrink-0"></i>
                <div>
                    <strong>{{ __('messages.disclaimer_title') }}:</strong>
                    {{ __('messages.disclaimer_text') }}
                </div>
            </div>

            <!-- Alert Container for AJAX Responses -->
            <div id="formAlertContainer"></div>

            <!-- Success Card (Shown after AJAX submission) -->
            <div id="complaintSuccessCard" class="card border-0 shadow-lg rounded-4 p-5 text-center d-none mb-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center" style="width: 72px; height: 72px; font-size: 36px;">
                        <i class="bi bi-check-lg"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-success mb-2">Grievance Successfully Registered!</h3>
                <p class="text-muted mb-3">உங்கள் பொது கோரிக்கை முறைப்படி பதிவு செய்யப்பட்டுள்ளது.</p>
                
                <div class="bg-light border rounded-3 p-3 my-3 mx-auto" style="max-width: 450px;">
                    <div class="small text-muted mb-1">{{ __('messages.lbl_complaint_id') }}</div>
                    <div class="fs-3 fw-bold text-primary font-monospace" id="generatedComplaintId">VNK-XXXXXXXX-XXXX</div>
                    <div class="small text-secondary mt-1">Please note this reference number for SMS updates and online tracking.</div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="#" id="trackLinkBtn" class="btn btn-primary-civic btn-lg">
                        <i class="bi bi-search me-1"></i> Track Grievance Status
                    </a>
                    <a href="{{ route('complaints.create') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-plus-circle me-1"></i> Register Another Grievance
                    </a>
                </div>
            </div>

            <!-- Complaint Registration Form Card -->
            <div id="complaintFormCard">
                <form id="complaintForm" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- Hidden Live GPS Location Fields (Admin Confidential) -->
                    <input type="hidden" name="live_latitude" id="liveLatitude">
                    <input type="hidden" name="live_longitude" id="liveLongitude">
                    <input type="hidden" name="live_address" id="liveAddress">

                    <!-- SECTION 1: CITIZEN DETAILS -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="bi bi-person-badge-fill text-primary"></i>
                            <span>{{ __('messages.sec_citizen_info') }}</span>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="citizenName" class="form-label">{{ __('messages.lbl_name') }} <span class="required-star">*</span></label>
                                    <input type="text" name="citizen_name" id="citizenName" class="form-control" placeholder="Enter full name as per Aadhaar / Identity" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="citizenMobile" class="form-label">{{ __('messages.lbl_mobile') }} <span class="required-star">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold px-3 text-secondary">+91</span>
                                        <input type="tel" name="citizen_mobile" id="citizenMobile" class="form-control" placeholder="10-digit mobile number" pattern="[6-9][0-9]{9}" maxlength="10" required>
                                    </div>
                                    <div class="small text-muted mt-1">Used for tracking alerts and official field verification.</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="citizenEmail" class="form-label">{{ __('messages.lbl_email') }}</label>
                                    <input type="email" name="citizen_email" id="citizenEmail" class="form-control" placeholder="e.g. name@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label for="citizenAddress" class="form-label">{{ __('messages.lbl_address') }} <span class="required-star">*</span></label>
                                    <input type="text" name="citizen_address" id="citizenAddress" class="form-control" placeholder="Door No, Street Name, Residential Area" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: LOCATION OF GRIEVANCE (DEPENDENT DROPDOWNS) -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="bi bi-geo-alt-fill text-primary"></i>
                            <span>{{ __('messages.sec_location_info') }}</span>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="districtSelect" class="form-label">{{ __('messages.lbl_district') }} <span class="required-star">*</span></label>
                                    <select name="district_id" id="districtSelect" class="form-select" required>
                                        <option value="">-- {{ __('messages.select_district') }} --</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }} ({{ $d->name_en }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="divisionSelect" class="form-label">{{ __('messages.lbl_division') }} <span class="required-star">*</span></label>
                                    <select name="revenue_division_id" id="divisionSelect" class="form-select" required disabled>
                                        <option value="">-- {{ __('messages.select_district_first') }} --</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="talukSelect" class="form-label">{{ __('messages.lbl_taluk') }} <span class="required-star">*</span></label>
                                    <select name="taluk_id" id="talukSelect" class="form-select" required disabled>
                                        <option value="">-- {{ __('messages.select_division_first') }} --</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="villageSelect" class="form-label">
                                        {{ __('messages.lbl_village') }} <span class="text-muted fw-normal small">(Village / Town)</span>
                                    </label>
                                    
                                    <!-- Select Dropdown Mode (Default) -->
                                    <div class="input-group" id="villageSelectGroup">
                                        <select name="revenue_village_id" id="villageSelect" class="form-select" disabled>
                                            <option value="">-- {{ __('messages.select_taluk_first') }} --</option>
                                        </select>
                                        <button type="button" class="btn btn-outline-primary px-3 text-nowrap fw-semibold btn-sm d-flex align-items-center gap-1" id="btnSwitchToManual" title="பட்டியலில் இல்லாத ஊரை தட்டச்சு செய்ய">
                                            <i class="bi bi-pencil-square"></i>
                                            <span>தட்டச்சு செய்ய</span>
                                        </button>
                                    </div>

                                    <!-- Direct Manual Text Mode (Active when toggled or 'other' chosen) -->
                                    <div class="input-group d-none" id="villageManualGroup">
                                        <span class="input-group-text bg-light text-primary"><i class="bi bi-geo-alt-fill"></i></span>
                                        <input type="text" name="custom_village_name" id="customVillageInput" class="form-control" placeholder="கிராமம் / நகர் / காலனி பெயர் உள்ளிடவும் (e.g. அண்ணா நகர், காந்தி காலனி)">
                                        <button type="button" class="btn btn-outline-secondary px-3 text-nowrap fw-semibold btn-sm d-flex align-items-center gap-1" id="btnSwitchToSelect" title="மீண்டும் கிராமப் பட்டியலுக்கு மாற">
                                            <i class="bi bi-list-ul"></i>
                                            <span>பட்டியல்</span>
                                        </button>
                                    </div>
                                    <div class="small text-muted mt-1" style="font-size: 0.74rem;">
                                        பட்டியலிலும் தேர்ந்தெடுக்கலாம் அல்லது 'தட்டச்சு செய்ய' பட்டனை அழுத்தி நேரடியாகவும் உள்ளிடலாம்.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="wardNumber" class="form-label">{{ __('messages.lbl_ward') }}</label>
                                    <input type="text" name="ward_number" id="wardNumber" class="form-control" placeholder="e.g. Ward 12 (if municipality / town)">
                                </div>

                                <div class="col-md-6">
                                    <label for="landmark" class="form-label">{{ __('messages.lbl_landmark') }}</label>
                                    <input type="text" name="landmark" id="landmark" class="form-control" placeholder="e.g. Near Bus Stand, Opposite High School, Water Tank">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: GRIEVANCE SPECIFICS -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="bi bi-card-text text-primary"></i>
                            <span>{{ __('messages.sec_complaint_info') }}</span>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="categorySelect" class="form-label">{{ __('messages.lbl_category') }} <span class="required-star">*</span></label>
                                    <select name="category_id" id="categorySelect" class="form-select" required>
                                        <option value="">{{ __('messages.select_category') }}</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">
                                                {{ $cat->name }} ({{ $cat->department_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="prioritySelect" class="form-label">{{ __('messages.lbl_priority') }}</label>
                                    <select name="priority" id="prioritySelect" class="form-select">
                                        <option value="medium" selected>{{ __('messages.priority_medium') }}</option>
                                        <option value="low">{{ __('messages.priority_low') }}</option>
                                        <option value="high">{{ __('messages.priority_high') }}</option>
                                        <option value="urgent">{{ __('messages.priority_urgent') }}</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="complaintSubject" class="form-label">{{ __('messages.lbl_subject') }} <span class="required-star">*</span></label>
                                    <input type="text" name="subject" id="complaintSubject" class="form-control" placeholder="Brief one-line summary of the issue (e.g. Low water pressure in South Street)" minlength="5" maxlength="255" required>
                                </div>

                                <div class="col-12">
                                    <label for="complaintDesc" class="form-label">{{ __('messages.lbl_description') }} <span class="required-star">*</span></label>
                                    <textarea name="description" id="complaintDesc" class="form-control" rows="5" placeholder="Provide full details: when it started, how many households are affected, previous attempts made, and specific action requested." minlength="20" required></textarea>
                                    <div class="small text-muted mt-1">Minimum 20 characters required.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: PHOTOS & EVIDENCE UPLOAD -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="bi bi-paperclip text-primary"></i>
                            <span>{{ __('messages.sec_attachments') }}</span>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="photoFile" class="form-label">{{ __('messages.lbl_photo') }}</label>
                                    <input type="file" name="photo" id="photoFile" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
                                    <div class="small text-muted mt-1">Visual evidence significantly speeds up department field verification.</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="docFile" class="form-label">{{ __('messages.lbl_document') }}</label>
                                    <input type="file" name="document" id="docFile" class="form-control" accept=".pdf,image/jpeg,image/png,image/jpg">
                                    <div class="small text-muted mt-1">Previous petitions, receipts, or official endorsements (PDF/JPG).</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 5: CONSENT & SUBMISSION -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="bi bi-check-all text-primary"></i>
                            <span>{{ __('messages.sec_verification') }}</span>
                        </div>
                        <div class="form-section-body">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="privacy_consent" id="privacyConsent" value="1" required>
                                <label class="form-check-label small text-secondary" for="privacyConsent">
                                    {{ __('messages.lbl_consent') }}
                                </label>
                            </div>

                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" class="btn btn-primary-civic btn-lg px-4" id="btnSubmitComplaint">
                                    <i class="bi bi-send-fill me-2"></i> {{ __('messages.btn_submit_complaint') }}
                                </button>
                                <button type="reset" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> {{ __('messages.btn_reset') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
