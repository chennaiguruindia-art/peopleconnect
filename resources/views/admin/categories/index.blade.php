@extends('layouts.admin')

@section('title', 'Manage Complaint Categories')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-0">Complaint Categories & SLA Master</h3>
        <p class="text-muted small mb-0">Manage service grievance categories, SLA timelines, and mapped civic departments.</p>
    </div>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
        <i class="bi bi-plus-lg me-1"></i> Add Category
    </button>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover table-admin">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Code</th>
                    <th>Category (EN / TA)</th>
                    <th>Department</th>
                    <th>Target SLA</th>
                    <th>Total Complaints</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                    <tr>
                        <td>
                            <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="bi {{ $cat->icon }}"></i>
                            </div>
                        </td>
                        <td class="font-monospace fw-bold">{{ $cat->code }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $cat->name_en }}</div>
                            <small class="text-muted">{{ $cat->name_ta }}</small>
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $cat->department_name_en }}</div>
                            <small class="text-muted">{{ $cat->department_name_ta }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $cat->sla_days }} Days</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $cat->complaints_count }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $cat->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $cat->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" data-bs-toggle="modal" data-bs-target="#editCatModal{{ $cat->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editCatModal{{ $cat->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Edit Category: {{ $cat->name_en }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Category Name (English)</label>
                                            <input type="text" name="name_en" class="form-control form-control-sm" value="{{ $cat->name_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Category Name (Tamil)</label>
                                            <input type="text" name="name_ta" class="form-control form-control-sm" value="{{ $cat->name_ta }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Department Name (English)</label>
                                            <input type="text" name="department_name_en" class="form-control form-control-sm" value="{{ $cat->department_name_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Department Name (Tamil)</label>
                                            <input type="text" name="department_name_ta" class="form-control form-control-sm" value="{{ $cat->department_name_ta }}" required>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">SLA Days</label>
                                                <input type="number" name="sla_days" class="form-control form-control-sm" value="{{ $cat->sla_days }}" min="1" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Icon (Bootstrap Icon)</label>
                                                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $cat->icon }}">
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="is_active" class="form-check-input" id="act{{ $cat->id }}" value="1" {{ $cat->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="act{{ $cat->id }}">Active</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Complaint Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Unique Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control form-control-sm" placeholder="e.g. CAT-ENV" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name (English) <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" class="form-control form-control-sm" placeholder="e.g. Lake & Pond Conservation" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name (Tamil) <span class="text-danger">*</span></label>
                        <input type="text" name="name_ta" class="form-control form-control-sm" placeholder="எ.கா: குளம் மற்றும் நீர்நிலை பாதுகாப்பு" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Department Name (English) <span class="text-danger">*</span></label>
                        <input type="text" name="department_name_en" class="form-control form-control-sm" placeholder="e.g. Water Resources Department (PWD)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Department Name (Tamil) <span class="text-danger">*</span></label>
                        <input type="text" name="department_name_ta" class="form-control form-control-sm" placeholder="எ.கா: நீர்வளத்துறை" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">SLA (Days) <span class="text-danger">*</span></label>
                            <input type="number" name="sla_days" class="form-control form-control-sm" value="7" min="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Bootstrap Icon</label>
                            <input type="text" name="icon" class="form-control form-control-sm" value="bi-exclamation-triangle">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Create Category</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
