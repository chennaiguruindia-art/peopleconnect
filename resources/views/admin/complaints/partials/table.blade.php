<div class="table-responsive">
    <table class="table table-hover table-admin">
        <thead>
            <tr>
                <th>Complaint ID</th>
                <th>Citizen Details</th>
                <th>Taluk / Village</th>
                <th>Category</th>
                <th>Submitted Date</th>
                <th>Status</th>
                <th>Referral</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints as $c)
                <tr>
                    <td class="font-monospace fw-bold text-primary">
                        <a href="{{ route('admin.complaints.show', $c->id) }}" class="text-decoration-none">
                            {{ $c->complaint_id }}
                        </a>
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $c->citizen_name }}</div>
                        <div class="text-muted small"><i class="bi bi-phone me-1"></i>{{ $c->citizen_mobile }}</div>
                    </td>
                    <td>
                        <div class="fw-semibold">
                            {{ $c->district?->name_en ?? $c->district?->name ?? 'TN' }} • {{ $c->taluk?->name }}
                            @if($c->has_live_location)
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-1" style="font-size: 0.65rem;" title="Live GPS captured: {{ $c->live_latitude }}, {{ $c->live_longitude }}">
                                    <i class="bi bi-crosshair"></i> GPS
                                </span>
                            @endif
                        </div>
                        <small class="text-muted">{{ $c->revenueVillage?->name ?? 'Town / Ward ' . ($c->ward_number ?? '-') }}</small>
                    </td>
                    <td>
                        <div class="small fw-semibold">{{ $c->category->name }}</div>
                        <span class="badge bg-{{ $c->priority === 'urgent' ? 'danger' : ($c->priority === 'high' ? 'warning text-dark' : 'light text-dark border') }} small">
                            {{ ucfirst($c->priority) }}
                        </span>
                    </td>
                    <td>
                        <div class="small">{{ $c->created_at->format('d M Y') }}</div>
                        <div class="text-muted small" style="font-size: 0.75rem;">{{ $c->created_at->format('h:i A') }}</div>
                    </td>
                    <td>
                        <span class="badge {{ $c->status_badge_class }} py-1 px-2">
                            {{ $c->status_label }}
                        </span>
                    </td>
                    <td>
                        @if($c->referral_status !== 'not_referred')
                            <span class="badge bg-info-subtle text-info border border-info small">
                                <i class="bi bi-arrow-right-short"></i> {{ trans('messages.referral_' . $c->referral_status) }}
                            </span>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.complaints.show', $c->id) }}" class="btn btn-sm btn-outline-primary" title="View & Act">
                            <i class="bi bi-pencil-square"></i> Act
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                        No complaints found matching the selected filters.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top px-3" id="complaintsPagination">
    <div class="small text-muted">
        Showing {{ $complaints->firstItem() ?? 0 }} to {{ $complaints->lastItem() ?? 0 }} of {{ $complaints->total() }} grievances
    </div>
    <div>
        {{ $complaints->links('pagination::bootstrap-5') }}
    </div>
</div>
