@extends('layouts.admin')

@section('title', 'Add Revenue Village')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <a href="{{ route('admin.locations.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Location Master
        </a>

        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-plus-circle me-2"></i>Add Revenue Village / வருவாய் கிராமம்</h5>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.locations.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="talukSelect" class="form-label small fw-bold">Select Revenue Taluk <span class="text-danger">*</span></label>
                        <select name="taluk_id" id="talukSelect" class="form-select" required>
                            <option value="">-- Choose Taluk --</option>
                            @foreach($taluks as $t)
                                <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->name_en }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="nameEn" class="form-label small fw-bold">Village Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name_en" id="nameEn" class="form-control" placeholder="e.g. Allampatti" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nameTa" class="form-label small fw-bold">Village Name (Tamil) <span class="text-danger">*</span></label>
                            <input type="text" name="name_ta" id="nameTa" class="form-control" placeholder="எ.கா: அல்லம்பட்டி" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="code" class="form-label small fw-bold">Official Village Code (LGD / Census)</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="e.g. RV-VNR-07 (Leave blank to auto-generate)">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
                            Save Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
