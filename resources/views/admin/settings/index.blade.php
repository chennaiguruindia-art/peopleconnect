@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-0">System & Portal Settings</h3>
                <p class="text-muted small mb-0">Configure branding titles, support helpline, disclaimer texts, and system options.</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="bi bi-gear-fill me-2"></i>Branding & Taglines</h5>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Site Name (English)</label>
                            <input type="text" name="site_name_en" class="form-control" value="{{ \App\Models\SystemSetting::get('site_name_en', 'Tamil Nadu Makkal Kural') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Site Name (Tamil)</label>
                            <input type="text" name="site_name_ta" class="form-control" value="{{ \App\Models\SystemSetting::get('site_name_ta', 'தமிழ்நாடு மக்கள் குரல்') }}" required>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tagline (English)</label>
                            <input type="text" name="tagline_en" class="form-control" value="{{ \App\Models\SystemSetting::get('tagline_en', 'Your Voice, Your Community, Your Development.') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tagline (Tamil)</label>
                            <input type="text" name="tagline_ta" class="form-control" value="{{ \App\Models\SystemSetting::get('tagline_ta', 'மக்களின் குரல், மக்களின் கோரிக்கை.') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="bi bi-telephone-fill me-2"></i>Contact Information</h5>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Helpline Phone Number</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ \App\Models\SystemSetting::get('contact_phone', '+91 9384995222') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ \App\Models\SystemSetting::get('contact_email', 'kural@virudhunagar.org') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Physical Office Address</label>
                        <input type="text" name="office_address" class="form-control" value="{{ \App\Models\SystemSetting::get('office_address', 'Civic Grievance Facilitation Center, Madurai Main Road, Virudhunagar - 626001') }}" required>
                    </div>
                </div>
            </div>

            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="bi bi-shield-check me-2"></i>Legal Disclaimers</h5>
                </div>
                <div class="admin-card-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Disclaimer Notice (English)</label>
                        <textarea name="disclaimer_en" class="form-control" rows="2" required>{{ \App\Models\SystemSetting::get('disclaimer_en') }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold">Disclaimer Notice (Tamil)</label>
                        <textarea name="disclaimer_ta" class="form-control" rows="2" required>{{ \App\Models\SystemSetting::get('disclaimer_ta') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
                    <i class="bi bi-save me-1"></i> Save All Portal Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
