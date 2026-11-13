@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-0">District Grievance Overview</h3>
        <p class="text-muted small mb-0">Virudhunagar District Public Grievance Administration & Live Analytics</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.complaints.export') }}" class="btn btn-outline-success btn-sm">
            <i class="bi bi-file-earmark-excel me-1"></i> Export Master CSV
        </a>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-primary btn-sm" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
            <i class="bi bi-inbox me-1"></i> View All Complaints
        </a>
    </div>
</div>

<!-- 8 Dashboard Metric Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-total">
            <div>
                <div class="metric-value">{{ number_format($stats['total']) }}</div>
                <div class="metric-label">Total Grievances</div>
            </div>
            <div class="metric-icon bg-primary-subtle text-primary">
                <i class="bi bi-inbox-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-submitted">
            <div>
                <div class="metric-value text-secondary">{{ number_format($stats['submitted']) }}</div>
                <div class="metric-label">Submitted / New</div>
            </div>
            <div class="metric-icon bg-secondary-subtle text-secondary">
                <i class="bi bi-clock-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-under-review">
            <div>
                <div class="metric-value text-info">{{ number_format($stats['under_review']) }}</div>
                <div class="metric-label">Under Review</div>
            </div>
            <div class="metric-icon bg-info-subtle text-info">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-pending">
            <div>
                <div class="metric-value text-warning">{{ number_format($stats['pending']) }}</div>
                <div class="metric-label">Awaiting Info</div>
            </div>
            <div class="metric-icon bg-warning-subtle text-warning">
                <i class="bi bi-question-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-in-progress">
            <div>
                <div class="metric-value text-primary">{{ number_format($stats['in_progress']) }}</div>
                <div class="metric-label">In Progress</div>
            </div>
            <div class="metric-icon bg-primary-subtle text-primary">
                <i class="bi bi-gear-wide-connected"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-referred">
            <div>
                <div class="metric-value text-info">{{ number_format($stats['referred']) }}</div>
                <div class="metric-label">Referred to Dept</div>
            </div>
            <div class="metric-icon bg-info-subtle text-info">
                <i class="bi bi-arrow-up-right-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-resolved">
            <div>
                <div class="metric-value text-success">{{ number_format($stats['resolved']) }}</div>
                <div class="metric-label">Resolved</div>
            </div>
            <div class="metric-icon bg-success-subtle text-success">
                <i class="bi bi-check-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="metric-card border-rejected">
            <div>
                <div class="metric-value text-danger">{{ number_format($stats['rejected']) }}</div>
                <div class="metric-label">Rejected / Closed</div>
            </div>
            <div class="metric-icon bg-danger-subtle text-danger">
                <i class="bi bi-x-circle-fill"></i>
            </div>
        </div>
    </div>
</div>

<!-- 4 Real-time AJAX Charts (Chart.js) -->
<div class="row g-4 mb-4">
    <!-- Chart 1: Monthly Grievances Trend -->
    <div class="col-lg-8">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-graph-up text-primary me-2"></i>Monthly Grievances Inflow</h5>
                <span class="badge bg-light text-secondary border small">Last 6 Months (MySQL Data)</span>
            </div>
            <div class="admin-card-body">
                <canvas id="monthlyChart" height="110"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 2: Status Distribution -->
    <div class="col-lg-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-pie-chart text-success me-2"></i>Status Distribution</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="statusChart" height="230"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 3: Taluk-wise Volume -->
    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-bar-chart-fill text-success me-2"></i>Taluk-wise Grievances (10 Taluks)</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="talukChart" height="130"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 4: Category Distribution -->
    <div class="col-lg-5">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-pie-chart-fill text-warning me-2"></i>Category Breakdown</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="categoryChart" height="190"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Complaints Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="admin-card-title"><i class="bi bi-clock-history me-2"></i>Latest Registered Grievances</h5>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-admin">
            <thead>
                <tr>
                    <th>Complaint ID</th>
                    <th>Citizen Name</th>
                    <th>Taluk</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Submitted Date</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentComplaints as $c)
                    <tr>
                        <td class="font-monospace fw-bold text-primary">{{ $c->complaint_id }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $c->citizen_name }}</div>
                            <small class="text-muted">{{ $c->masked_mobile }}</small>
                        </td>
                        <td>{{ $c->taluk?->name ?? 'Virudhunagar' }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $c->category->name }}</span></td>
                        <td>
                            <span class="badge bg-{{ $c->priority === 'urgent' ? 'danger' : ($c->priority === 'high' ? 'warning text-dark' : 'secondary') }}">
                                {{ ucfirst($c->priority) }}
                            </span>
                        </td>
                        <td>{{ $c->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <span class="badge {{ $c->status_badge_class }}">{{ $c->status_label }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.complaints.show', $c->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Manage
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No grievances registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
