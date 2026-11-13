@extends('layouts.admin')

@section('title', 'Location Master Management')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-0">Location Master Management</h3>
        <p class="text-muted small mb-0">Manage Revenue Divisions, 10 Taluks, and verified Revenue Villages of Virudhunagar.</p>
    </div>
    <a href="{{ route('admin.locations.create') }}" class="btn btn-primary btn-sm" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
        <i class="bi bi-plus-lg me-1"></i> Add Revenue Village
    </a>
</div>

<!-- District & Division Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="metric-card border-total">
            <div>
                <div class="metric-value">3</div>
                <div class="metric-label">Revenue Divisions</div>
                <small class="text-muted">Aruppukkottai, Sivakasi, Sattur</small>
            </div>
            <div class="metric-icon bg-primary-subtle text-primary"><i class="bi bi-diagram-3-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="metric-card border-resolved">
            <div>
                <div class="metric-value text-success">{{ $taluks->count() }}</div>
                <div class="metric-label">Revenue Taluks</div>
                <small class="text-muted">10 Taluks across the district</small>
            </div>
            <div class="metric-icon bg-success-subtle text-success"><i class="bi bi-geo-alt-fill"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="metric-card border-referred">
            <div>
                <div class="metric-value text-info">{{ $villages->total() }}</div>
                <div class="metric-label">Revenue Villages in View</div>
                <small class="text-muted">Filtered by selected Taluk</small>
            </div>
            <div class="metric-icon bg-info-subtle text-info"><i class="bi bi-houses-fill"></i></div>
        </div>
    </div>
</div>

<!-- Taluk Selector Filter -->
<div class="admin-card mb-4">
    <div class="admin-card-body p-3">
        <form method="GET" action="{{ route('admin.locations.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <label class="form-label small fw-bold mb-0">Select Taluk to View Revenue Villages:</label>
            </div>
            <div class="col-md-6">
                <select name="taluk_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach($taluks as $t)
                        <option value="{{ $t->id }}" {{ $selectedTalukId == $t->id ? 'selected' : '' }}>
                            {{ $t->name }} ({{ $t->name_en }}) — Division: {{ $t->revenueDivision->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<!-- Villages Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="admin-card-title">
            <i class="bi bi-list-check me-2"></i>Revenue Villages List
        </h5>
        <a href="{{ route('admin.locations.create') }}" class="btn btn-sm btn-outline-primary">Add New Village</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-admin">
            <thead>
                <tr>
                    <th>Official Code</th>
                    <th>Firka</th>
                    <th>Village Name (English)</th>
                    <th>Village Name (Tamil)</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($villages as $v)
                    <tr>
                        <td class="font-monospace text-muted">{{ $v->code ?? '-' }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $v->firka ?? '-' }}</span></td>
                        <td class="fw-bold text-dark">{{ $v->name_en }}</td>
                        <td class="fw-semibold text-dark">{{ $v->name_ta }}</td>
                        <td>
                            <span class="badge {{ $v->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $v->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.locations.edit', $v->id) }}" class="btn btn-sm btn-outline-secondary py-0 px-2" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.locations.destroy', $v->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this location record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No revenue villages listed under this taluk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $villages->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
