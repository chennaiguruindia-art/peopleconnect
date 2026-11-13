@extends('layouts.admin')

@section('title', 'Manage Public Updates')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-0">Public Updates & Civic News</h3>
        <p class="text-muted small mb-0">Publish district updates, maintenance notices, and health advisories for citizens.</p>
    </div>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUpdateModal" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
        <i class="bi bi-megaphone-fill me-1"></i> Publish New Update
    </button>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover table-admin">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Title (English & Tamil)</th>
                    <th>Published Date</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($updates as $u)
                    <tr>
                        <td>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                {{ $u->category }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $u->title_en }}</div>
                            <small class="text-muted">{{ $u->title_ta }}</small>
                        </td>
                        <td>{{ $u->published_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <span class="badge {{ $u->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $u->is_active ? 'Active' : 'Draft' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" data-bs-toggle="modal" data-bs-target="#editUpdateModal{{ $u->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.updates.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this update?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editUpdateModal{{ $u->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ route('admin.updates.update', $u->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Edit Update: {{ $u->title_en }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="row g-2 mb-3">
                                            <div class="col-8">
                                                <label class="form-label small fw-bold">Category</label>
                                                <input type="text" name="category" class="form-control form-control-sm" value="{{ $u->category }}" required>
                                            </div>
                                            <div class="col-4 d-flex align-items-end">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" name="is_active" class="form-check-input" id="actU{{ $u->id }}" value="1" {{ $u->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label small" for="actU{{ $u->id }}">Published Active</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Title (English)</label>
                                            <input type="text" name="title_en" class="form-control form-control-sm" value="{{ $u->title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Title (Tamil)</label>
                                            <input type="text" name="title_ta" class="form-control form-control-sm" value="{{ $u->title_ta }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Content (English)</label>
                                            <textarea name="content_en" class="form-control form-control-sm" rows="3" required>{{ $u->content_en }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Content (Tamil)</label>
                                            <textarea name="content_ta" class="form-control form-control-sm" rows="3" required>{{ $u->content_ta }}</textarea>
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
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No updates published yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3 border-top d-flex justify-content-center">
        {{ $updates->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Add Update Modal -->
<div class="modal fade" id="addUpdateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.updates.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Publish Public Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category (e.g. Water Works, Road Works, Health) <span class="text-danger">*</span></label>
                        <input type="text" name="category" class="form-control form-control-sm" placeholder="Water Works" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title (English) <span class="text-danger">*</span></label>
                        <input type="text" name="title_en" class="form-control form-control-sm" placeholder="e.g. Pipeline desilting drive in Sivakasi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title (Tamil) <span class="text-danger">*</span></label>
                        <input type="text" name="title_ta" class="form-control form-control-sm" placeholder="எ.கா: சிவகாசியில் குடிநீர் குழாய் பராமரிப்பு பணிகள்" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Detailed Content (English) <span class="text-danger">*</span></label>
                        <textarea name="content_en" class="form-control form-control-sm" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Detailed Content (Tamil) <span class="text-danger">*</span></label>
                        <textarea name="content_ta" class="form-control form-control-sm" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Publish Now</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
