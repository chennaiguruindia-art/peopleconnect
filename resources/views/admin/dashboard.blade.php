@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- District Grievance Overview Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h3 class="fw-bold text-dark mb-0 fs-4 fs-md-3">District Grievance Overview</h3>
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0.5 small d-inline-flex align-items-center gap-1">
                <span class="spinner-grow spinner-grow-sm text-success" style="width: 6px; height: 6px;" role="status"></span>
                Live Analytics
            </span>
        </div>
        <p class="text-muted small mb-0">Virudhunagar District Public Grievance Administration & Real-Time Monitoring</p>
    </div>
    <div class="d-flex flex-wrap gap-2 w-100 w-md-auto">
        <a href="{{ route('admin.complaints.export') }}" class="btn btn-outline-success btn-sm flex-fill flex-md-grow-0 d-inline-flex align-items-center justify-content-center py-2 px-3 shadow-xs">
            <i class="bi bi-file-earmark-excel me-1.5 text-success"></i>
            <span>Export Master CSV</span>
        </a>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-primary btn-sm flex-fill flex-md-grow-0 d-inline-flex align-items-center justify-content-center py-2 px-3 shadow-xs" style="background: linear-gradient(135deg, #ff7722, #ea580c); border: none;">
            <i class="bi bi-inbox me-1.5"></i>
            <span>View All Complaints</span>
        </a>
    </div>
</div>

<!-- 8 Dashboard Metric Cards: 2-column on mobile, 4-column on desktop -->
<div class="row g-2 g-md-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="metric-card border-total">
            <div class="min-w-0">
                <div class="metric-value">{{ number_format($stats['total']) }}</div>
                <div class="metric-label text-truncate">Total Grievances</div>
            </div>
            <div class="metric-icon bg-primary-subtle text-primary">
                <i class="bi bi-inbox-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-submitted">
            <div class="min-w-0">
                <div class="metric-value text-secondary">{{ number_format($stats['submitted']) }}</div>
                <div class="metric-label text-truncate">Submitted / New</div>
            </div>
            <div class="metric-icon bg-secondary-subtle text-secondary">
                <i class="bi bi-clock-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-under-review">
            <div class="min-w-0">
                <div class="metric-value text-info">{{ number_format($stats['under_review']) }}</div>
                <div class="metric-label text-truncate">Under Review</div>
            </div>
            <div class="metric-icon bg-info-subtle text-info">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-pending">
            <div class="min-w-0">
                <div class="metric-value text-warning">{{ number_format($stats['pending']) }}</div>
                <div class="metric-label text-truncate">Awaiting Info</div>
            </div>
            <div class="metric-icon bg-warning-subtle text-warning">
                <i class="bi bi-question-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-in-progress">
            <div class="min-w-0">
                <div class="metric-value text-primary">{{ number_format($stats['in_progress']) }}</div>
                <div class="metric-label text-truncate">In Progress</div>
            </div>
            <div class="metric-icon bg-primary-subtle text-primary">
                <i class="bi bi-gear-wide-connected"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-referred">
            <div class="min-w-0">
                <div class="metric-value text-info">{{ number_format($stats['referred']) }}</div>
                <div class="metric-label text-truncate">Referred to Dept</div>
            </div>
            <div class="metric-icon bg-info-subtle text-info">
                <i class="bi bi-arrow-up-right-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-resolved">
            <div class="min-w-0">
                <div class="metric-value text-success">{{ number_format($stats['resolved']) }}</div>
                <div class="metric-label text-truncate">Resolved</div>
            </div>
            <div class="metric-icon bg-success-subtle text-success">
                <i class="bi bi-check-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="metric-card border-rejected">
            <div class="min-w-0">
                <div class="metric-value text-danger">{{ number_format($stats['rejected']) }}</div>
                <div class="metric-label text-truncate">Rejected / Closed</div>
            </div>
            <div class="metric-icon bg-danger-subtle text-danger">
                <i class="bi bi-x-circle-fill"></i>
            </div>
        </div>
    </div>
</div>

<!-- 4 Real-time AJAX Charts (Chart.js) -->
<div class="row g-3 g-md-4 mb-4">
    <!-- Chart 1: Monthly Grievances Trend -->
    <div class="col-12 col-lg-8">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                <h5 class="admin-card-title"><i class="bi bi-graph-up text-primary me-2"></i>Monthly Grievances Inflow</h5>
                <span class="badge bg-light text-secondary border small">Last 6 Months (Live Data)</span>
            </div>
            <div class="admin-card-body">
                <div class="chart-canvas-container" style="position: relative; width: 100%; min-height: 220px;">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart 2: Status Distribution -->
    <div class="col-12 col-lg-4">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                <h5 class="admin-card-title"><i class="bi bi-pie-chart text-success me-2"></i>Status Distribution</h5>
            </div>
            <div class="admin-card-body">
                <div class="chart-canvas-container" style="position: relative; width: 100%; min-height: 220px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart 3: Taluk-wise Volume -->
    <div class="col-12 col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                <h5 class="admin-card-title"><i class="bi bi-bar-chart-fill text-success me-2"></i>Taluk-wise Grievances (10 Taluks)</h5>
            </div>
            <div class="admin-card-body">
                <div class="chart-canvas-container" style="position: relative; width: 100%; min-height: 220px;">
                    <canvas id="talukChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart 4: Category Distribution -->
    <div class="col-12 col-lg-5">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                <h5 class="admin-card-title"><i class="bi bi-pie-chart-fill text-warning me-2"></i>Category Breakdown</h5>
            </div>
            <div class="admin-card-body">
                <div class="chart-canvas-container" style="position: relative; width: 100%; min-height: 220px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Complaints Table -->
<div class="admin-card">
    <div class="admin-card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-clock-history text-primary fs-5"></i>
            <h5 class="admin-card-title mb-0">Latest Registered Grievances</h5>
        </div>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <span>View All</span>
            <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-admin mb-0 align-middle">
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
                            <a href="{{ route('admin.complaints.show', $c->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2.5 rounded-pill">
                                <i class="bi bi-eye me-1"></i> Manage
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
