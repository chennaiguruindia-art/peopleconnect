@extends('layouts.admin')

@section('title', 'Reports & District Analytics')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-0">District Grievance Reports & Analytics</h3>
        <p class="text-muted small mb-0">Performance indicators, taluk-wise progress, and departmental resolution rates.</p>
    </div>
    <a href="{{ route('admin.complaints.export') }}" class="btn btn-outline-success btn-sm">
        <i class="bi bi-download me-1"></i> Download Master Complaints CSV
    </a>
</div>

<!-- Performance Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="metric-card border-total">
            <div>
                <div class="metric-value">{{ number_format($total) }}</div>
                <div class="metric-label">Total Submissions</div>
            </div>
            <div class="metric-icon bg-primary-subtle text-primary"><i class="bi bi-file-earmark-text-fill"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="metric-card border-resolved">
            <div>
                <div class="metric-value text-success">{{ number_format($resolved) }}</div>
                <div class="metric-label">Successfully Resolved</div>
            </div>
            <div class="metric-icon bg-success-subtle text-success"><i class="bi bi-check2-all"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="metric-card border-referred">
            <div>
                <div class="metric-value text-info">{{ number_format($referred) }}</div>
                <div class="metric-label">Department Referrals</div>
            </div>
            <div class="metric-icon bg-info-subtle text-info"><i class="bi bi-arrow-up-right-circle-fill"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="metric-card border-pending">
            <div>
                <div class="metric-value text-warning">{{ $resolutionRate }}%</div>
                <div class="metric-label">Resolution Efficiency</div>
            </div>
            <div class="metric-icon bg-warning-subtle text-warning"><i class="bi bi-pie-chart-fill"></i></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Taluk-wise Progress Breakdown -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Taluk-wise Grievance Status</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th>Revenue Taluk</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Resolved</th>
                            <th class="text-center">Pending</th>
                            <th class="text-end">Success %</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($talukReports as $tr)
                            @php
                                $tRate = $tr->total_count > 0 ? round(($tr->resolved_count / $tr->total_count) * 100) : 0;
                            @endphp
                            <tr>
                                <td class="fw-bold text-dark">{{ $tr->name }}</td>
                                <td class="text-center">{{ $tr->total_count }}</td>
                                <td class="text-center text-success fw-bold">{{ $tr->resolved_count }}</td>
                                <td class="text-center text-warning fw-bold">{{ $tr->pending_count }}</td>
                                <td class="text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <div class="progress flex-grow-1" style="height: 6px; width: 50px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $tRate }}%"></div>
                                        </div>
                                        <span class="small fw-bold">{{ $tRate }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category Breakdown Table -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-tag-fill text-warning me-2"></i>Category Volume & Redressal</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Civic Department</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Resolved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryReports as $cr)
                            <tr>
                                <td class="fw-bold text-dark">{{ $cr->name }}</td>
                                <td class="small text-muted">{{ Str::limit($cr->department_name, 28) }}</td>
                                <td class="text-center">{{ $cr->total_count }}</td>
                                <td class="text-center text-success fw-bold">{{ $cr->resolved_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
