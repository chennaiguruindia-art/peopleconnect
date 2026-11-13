<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrative Login - குரலற்ற மகளின் குரல்</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/logo.png') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100 py-5">

    <div class="container" style="max-width: 440px;">
        <div class="text-center mb-4">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt=" Logo" class="rounded-3 shadow-sm bg-white p-2" style="height: 64px; width: auto; object-fit: contain; max-width: 100px;">
                <img src="{{ asset('assets/images/bjp/image.png') }}" alt="BJP Logo" class="rounded-3 shadow-sm bg-white p-2" style="height: 64px; width: 64px; object-fit: contain;">
            </div>
            <h4 class="fw-bold text-dark mb-0">குரலற்ற மகளின் குரல்</h4>
            <div class="text-muted small">Officer & Administrator Portal</div>
        </div>

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-dark text-white p-3 text-center border-0">
                <span class="small fw-semibold"><i class="bi bi-key-fill text-warning me-1"></i> Secure Administrative Access</span>
            </div>
            <div class="card-body p-4 bg-white">
                @if(session('success'))
                    <div class="alert alert-success small mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger small mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger small mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label small fw-bold">Admin Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="adminEmail" class="form-control" value="{{ old('email', 'admin@virudhunagar.org') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adminPassword" class="form-label small fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="adminPassword" class="form-control" value="password123" required>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                        <label class="form-check-label small text-muted" for="rememberMe">Remember my login</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Dashboard
                    </button>
                </form>

                <div class="p-3 bg-light rounded-3 mt-4 small border">
                    <div class="fw-bold text-dark mb-1"><i class="bi bi-info-circle-fill text-primary me-1"></i> Demo Credentials:</div>
                    <div class="text-muted">Email: <code>admin@virudhunagar.org</code></div>
                    <div class="text-muted">Password: <code>password123</code></div>
                </div>
            </div>
            <div class="card-footer bg-light p-3 text-center border-top">
                <a href="{{ route('home') }}" class="small text-decoration-none text-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Return to Public Website
                </a>
            </div>
        </div>
    </div>

</body>
</html>
