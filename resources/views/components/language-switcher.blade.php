@php
    $isAdmin = request()->is('admin*');
    $currentLocale = app()->getLocale();
    $switchRoute = $isAdmin ? 'admin.locale.set' : 'locale.set';
@endphp

<div class="dropdown language-switcher d-inline-block">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1.5 py-1 px-2.5" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ $isAdmin ? 'Admin Language' : 'Site Language' }}">
        <i class="bi bi-translate text-warning"></i>
        <span class="fw-semibold">{{ $currentLocale === 'ta' ? 'தமிழ்' : 'English' }}</span>
        @if(!$isAdmin)
            <span class="badge bg-warning text-dark py-0 px-1 rounded-pill fw-bold ms-1" style="font-size: 0.62rem;">{{ strtoupper($currentLocale) }}</span>
        @endif
        @if($isAdmin)
            <span class="badge bg-secondary-subtle text-secondary ms-1 py-0 px-1 d-none d-sm-inline" style="font-size: 0.65rem;">Admin</span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between {{ $currentLocale === 'ta' ? 'active bg-primary text-white' : '' }}" 
               href="{{ route($switchRoute, 'ta') }}" 
               onclick="clearGoogleTransCookies()">
                <span>🇮🇳 தமிழ் (Tamil)</span>
                @if($currentLocale === 'ta')
                    <i class="bi bi-check2"></i>
                @endif
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between {{ $currentLocale === 'en' ? 'active bg-primary text-white' : '' }}" 
               href="{{ route($switchRoute, 'en') }}" 
               onclick="clearGoogleTransCookies()">
                <span>🌐 English</span>
                @if($currentLocale === 'en')
                    <i class="bi bi-check2"></i>
                @endif
            </a>
        </li>
    </ul>
</div>

<script>
function clearGoogleTransCookies() {
    try {
        var host = window.location.hostname;
        var domains = ['', host, '.' + host];
        var paths = ['/', '/admin'];
        domains.forEach(function(d) {
            paths.forEach(function(p) {
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=" + p + ";" + (d ? " domain=" + d + ";" : "");
            });
        });
    } catch(e) {}
}

// Clear any unwanted Google Translate cookies on page load to prevent toolbar bar from appearing
document.addEventListener('DOMContentLoaded', function() {
    clearGoogleTransCookies();
    // Also remove any banner frame if injected
    var frame = document.querySelector('.goog-te-banner-frame');
    if (frame) { frame.remove(); }
    document.body.style.top = '0px';
});
</script>
