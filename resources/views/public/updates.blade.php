@extends('layouts.app')

@section('title', __('messages.nav_updates') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_updates') }}</li>
        </ol>
    </nav>

    <div class="text-center mb-5">
        <span class="badge bg-warning-subtle text-dark border border-warning px-3 py-1 rounded-pill mb-2 fw-bold">
            District Civic Bulletins • அறிவிப்புகள்
        </span>
        <h1 class="fw-bold text-dark display-6">{{ __('messages.latest_news') }}</h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 650px;">
            Official updates on water pipeline maintenance, drainage desilting drives, and public health advisories across Virudhunagar District.
        </p>
    </div>

    <div class="row g-4">
        @forelse($updates as $update)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border rounded-4 shadow-sm hover-shadow d-flex flex-column">
                    <div class="card-body p-4 flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">{{ $update->category }}</span>
                            <span class="small text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $update->published_at->format('d M Y') }}</span>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">{{ $update->title }}</h4>
                        <p class="text-secondary small mb-0">{{ $update->content }}</p>
                    </div>
                    <div class="card-footer bg-light border-top p-3 text-end">
                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                            <i class="bi bi-patch-check-fill me-1"></i> Verified Notice
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No news or updates currently published.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $updates->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
