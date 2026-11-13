@extends('layouts.admin')

@section('title', 'Edit Revenue Village')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <a href="{{ route('admin.locations.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Location Master
        </a>

        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-pencil-square me-2"></i>Edit Revenue Village</h5>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.locations.update', $village->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="talukSelect" class="form-label small fw-bold">Select Revenue Taluk <span class="text-danger">*</span></label>
                        <select name="taluk_id" id="talukSelect" class="form-select" required>
                            @foreach($taluks as $t)
                                <option value="{{ $t->id }}" {{ $village->taluk_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }} ({{ $t->name_en }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="nameEn" class="form-label small fw-bold">Village Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name_en" id="nameEn" class="form-control" value="{{ $village->name_en }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nameTa" class="form-label small fw-bold">Village Name (Tamil) <span class="text-danger">*</span></label>
                            <input type="text" name="name_ta" id="nameTa" class="form-control" value="{{ $village->name_ta }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label small fw-bold">Official Village Code</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{ $village->code }}">
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ $village->is_active ? 'checked' : '' }}>
                        <label class="form-check-label small fw-semibold" for="isActive">Active in public dropdowns</label>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
