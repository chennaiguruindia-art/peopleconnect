@extends('layouts.app')

@section('title', __('messages.nav_district_info') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_district_info') }}</li>
        </ol>
    </nav>

    <div class="text-center mb-4">
        <span class="badge bg-secondary-subtle text-secondary border px-3 py-1 rounded-pill mb-2 fw-bold">
            Administrative Directory • நிர்வாக விபரம்
        </span>
        <h1 class="fw-bold text-dark display-6">{{ $district?->name }} ({{ $district?->name_en }}) Revenue Setup</h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 750px;">
            Official Revenue Administration: {{ $divisions->count() }} Revenue Divisions and {{ $divisions->sum(fn($d) => $d->taluks->count()) }} Taluks.
        </p>
    </div>

    <!-- District Selection Dropdown -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6 col-lg-5">
            <form method="GET" action="{{ route('district.info') }}" class="d-flex align-items-center gap-2 bg-white p-2 rounded-3 shadow-sm border">
                <label for="districtSelectNav" class="small fw-bold text-nowrap text-secondary ms-1">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>மாவட்டம் / District:
                </label>
                <select name="district_id" id="districtSelectNav" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach($districts as $d)
                        <option value="{{ $d->id }}" {{ ($district?->id == $d->id) ? 'selected' : '' }}>
                            {{ $d->name }} ({{ $d->name_en }})
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <!-- Administrative Hierarchy Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4 gap-2" id="districtTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4 fw-bold" id="divisions-tab" data-bs-toggle="pill" data-bs-target="#divisions-pane" type="button" role="tab">
                <i class="bi bi-diagram-3 me-1"></i> Revenue Divisions & Taluks (10)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4 fw-bold" id="urban-tab" data-bs-toggle="pill" data-bs-target="#urban-pane" type="button" role="tab">
                <i class="bi bi-buildings me-1"></i> Municipalities & Corporation (6)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4 fw-bold" id="town-tab" data-bs-toggle="pill" data-bs-target="#town-pane" type="button" role="tab">
                <i class="bi bi-shop me-1"></i> Town Panchayats (9)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4 fw-bold" id="blocks-tab" data-bs-toggle="pill" data-bs-target="#blocks-pane" type="button" role="tab">
                <i class="bi bi-tree me-1"></i> Development Blocks (11)
            </button>
        </li>
    </ul>

    <div class="tab-content" id="districtTabContent">
        <!-- TAB 1: REVENUE DIVISIONS & TALUKS -->
        <div class="tab-pane fade show active" id="divisions-pane" role="tabpanel">
            <div class="row g-4">
                @foreach($divisions as $div)
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-dark text-white p-3 border-0">
                                <h5 class="fw-bold mb-0">
                                    <i class="bi bi-folder2-open text-warning me-2"></i>{{ $div->name }} Division
                                </h5>
                                <small class="text-white-50">Code: {{ $div->code }}</small>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-primary fw-bold small text-uppercase mb-3">Taluks Under Jurisdiction:</h6>
                                <div class="accordion accordion-flush" id="accDiv{{ $div->id }}">
                                    @foreach($div->taluks as $t)
                                        <div class="accordion-item border rounded mb-2">
                                            <h2 class="accordion-header" id="headingTlk{{ $t->id }}">
                                                <button class="accordion-button collapsed py-2 px-3 fw-bold small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTlk{{ $t->id }}">
                                                    <span>{{ $t->name }} ({{ $t->name_en }})</span>
                                                    <span class="badge bg-light text-dark border ms-auto me-2">{{ $t->revenueVillages->count() }} Villages</span>
                                                </button>
                                            </h2>
                                            <div id="collapseTlk{{ $t->id }}" class="accordion-collapse collapse" data-bs-parent="#accDiv{{ $div->id }}">
                                                <div class="accordion-body p-2 bg-light small">
                                                    <div class="fw-semibold text-muted mb-1">Key Revenue Villages:</div>
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($t->revenueVillages as $rv)
                                                            <span class="badge bg-white text-dark border">{{ $rv->name }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- TAB 2: MUNICIPALITIES & CORPORATION -->
        <div class="tab-pane fade" id="urban-pane" role="tabpanel">
            <div class="row g-4">
                @foreach($municipalities as $mun)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border rounded-4 shadow-sm p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="rounded-circle bg-primary-subtle text-primary p-3 fs-4">
                                    <i class="bi bi-building"></i>
                                </div>
                                <span class="badge bg-secondary">{{ $mun->type }}</span>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">{{ $mun->name }}</h5>
                            <p class="text-muted small mb-3">Official Code: {{ $mun->code }}</p>
                            <div class="pt-2 border-top small text-secondary">
                                <i class="bi bi-geo-fill text-danger me-1"></i> Total Wards: <strong>{{ $mun->wards->count() > 0 ? $mun->wards->count() : 'Urban Wards Designated' }}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- TAB 3: TOWN PANCHAYATS -->
        <div class="tab-pane fade" id="town-pane" role="tabpanel">
            <div class="row g-3">
                @foreach($townPanchayats as $tp)
                    <div class="col-md-4 col-sm-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <div>
                                    <div class="fw-bold text-dark">{{ $tp->name }}</div>
                                    <small class="text-muted font-monospace">{{ $tp->code }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- TAB 4: DEVELOPMENT BLOCKS -->
        <div class="tab-pane fade" id="blocks-pane" role="tabpanel">
            <div class="row g-3">
                @foreach($blocks as $block)
                    <div class="col-md-4 col-sm-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-diagram-2-fill text-primary fs-5"></i>
                                <div>
                                    <div class="fw-bold text-dark">{{ $block->name }}</div>
                                    <small class="text-muted">{{ $block->code }} • {{ $block->villagePanchayats->count() }} Village Panchayats</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
