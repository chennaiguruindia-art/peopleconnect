@extends('layouts.admin')

@section('title', 'Staff & Grievance Officers')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-0">Portal Staff & Nodal Officers</h3>
        <p class="text-muted small mb-0">Manage authorized portal staff, assignable field officers, and administrative roles.</p>
    </div>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStaffModal" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
        <i class="bi bi-person-plus-fill me-1"></i> Register New Staff
    </button>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover table-admin">
            <thead>
                <tr>
                    <th>Officer Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Designation & Department</th>
                    <th>Role</th>
                    <th>Assigned Cases</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $u)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $u->name }}</div>
                            <small class="text-muted">ID: #{{ $u->id }}</small>
                        </td>
                        <td class="font-monospace">{{ $u->mobile ?? '-' }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $u->designation ?? 'Nodal Officer' }}</div>
                            <small class="text-muted">{{ $u->department ?? 'District Grievance Cell' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                {{ $u->role?->display_name ?? 'Staff' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $u->assigned_complaints_count }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $u->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $u->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" data-bs-toggle="modal" data-bs-target="#editStaffModal{{ $u->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Staff Modal -->
                    <div class="modal fade" id="editStaffModal{{ $u->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.staff.update', $u->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Edit Staff: {{ $u->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Full Name</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="{{ $u->name }}" required>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Mobile Number</label>
                                                <input type="text" name="mobile" class="form-control form-control-sm" value="{{ $u->mobile }}" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Email Address</label>
                                                <input type="email" name="email" class="form-control form-control-sm" value="{{ $u->email }}" required>
                                            </div>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Designation</label>
                                                <input type="text" name="designation" class="form-control form-control-sm" value="{{ $u->designation }}" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Department</label>
                                                <input type="text" name="department" class="form-control form-control-sm" value="{{ $u->department }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Role</label>
                                            <select name="role_id" class="form-select form-select-sm" required>
                                                @foreach($roles as $r)
                                                    <option value="{{ $r->id }}" {{ $u->role_id == $r->id ? 'selected' : '' }}>
                                                        {{ $r->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Reset Password (leave empty to keep current)</label>
                                            <input type="password" name="password" class="form-control form-control-sm" placeholder="New password">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="is_active" class="form-check-input" id="actU{{ $u->id }}" value="1" {{ $u->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="actU{{ $u->id }}">Account Active</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Update Staff</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Register Staff / Officer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. R. Subramanian" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Mobile (10 digits) <span class="text-danger">*</span></label>
                            <input type="tel" name="mobile" class="form-control form-control-sm" pattern="[6-9][0-9]{9}" placeholder="9842000000" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="officer@virudhunagar.org" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Designation <span class="text-danger">*</span></label>
                            <input type="text" name="designation" class="form-control form-control-sm" placeholder="e.g. Sanitary Inspector" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Department <span class="text-danger">*</span></label>
                            <input type="text" name="department" class="form-control form-control-sm" placeholder="e.g. Municipal Health Wing" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Role <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-select form-select-sm" required>
                                @foreach($roles as $r)
                                    <option value="{{ $r->id }}">{{ $r->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control form-control-sm" placeholder="Minimum 6 characters" minlength="6" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Register Staff</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
