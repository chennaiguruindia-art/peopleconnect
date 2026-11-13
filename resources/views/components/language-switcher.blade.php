@php
    $isAdmin = request()->is('admin*');
    $currentLocale = app()->getLocale();
    $switchRoute = $isAdmin ? 'admin.locale.set' : 'locale.set';
@endphp

@if(!$isAdmin)
    <!-- Google Translate Official Widget kept intact in background but hidden per user request -->
    <div id="google_translate_element" class="d-none" style="display: none !important;" aria-hidden="true"></div>
@endif

<div class="dropdown language-switcher d-inline-block">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1.5 py-1 px-2.5" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ $isAdmin ? 'Admin Language' : 'Site Language (Powered by Gemini AI Translator)' }}">
        <i class="bi bi-translate text-warning"></i>
        <span class="fw-semibold">{{ $currentLocale === 'ta' ? 'தமிழ்' : 'English' }}</span>
        @if(!$isAdmin)
            <span class="badge bg-warning text-dark py-0 px-1 rounded-pill fw-bold ms-1" style="font-size: 0.62rem;" title="AI Powered Translation">AI</span>
        @endif
        @if($isAdmin)
            <span class="badge bg-secondary-subtle text-secondary ms-1 py-0 px-1" style="font-size: 0.65rem;">Admin</span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between {{ $currentLocale === 'ta' ? 'active bg-primary text-white' : '' }}" 
               href="{{ route($switchRoute, 'ta') }}" 
               onclick="return handleLanguageSwitch(event, 'ta', '{{ route($switchRoute, 'ta') }}')">
                <span>🇮🇳 தமிழ் (Tamil)</span>
                @if($currentLocale === 'ta')
                    <i class="bi bi-check2"></i>
                @endif
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between {{ $currentLocale === 'en' ? 'active bg-primary text-white' : '' }}" 
               href="{{ route($switchRoute, 'en') }}" 
               onclick="return handleLanguageSwitch(event, 'en', '{{ route($switchRoute, 'en') }}')">
                <span>🌐 English</span>
                @if($currentLocale === 'en')
                    <i class="bi bi-check2"></i>
                @endif
            </a>
        </li>
    </ul>
</div>

<script>
function handleLanguageSwitch(event, lang, fallbackUrl) {
    try {
        var cookieVal = (lang === 'en') ? '/ta/en' : '/ta/ta';
        var host = window.location.hostname;
        
        // Set cookie for Google Translate
        document.cookie = "googtrans=" + cookieVal + "; path=/;";
        document.cookie = "googtrans=" + cookieVal + "; path=/; domain=" + host + ";";
        if (host && host.indexOf('.') !== -1) {
            document.cookie = "googtrans=" + cookieVal + "; path=/; domain=." + host + ";";
        }

        // If Google Translate combo exists, dispatch change
        var combo = document.querySelector('.goog-te-combo');
        if (combo) {
            combo.value = lang;
            combo.dispatchEvent(new Event('change'));
        }
    } catch(e) {
        console.warn('Google Translate sync error:', e);
    }
    // Continue navigation to set Laravel session
    return true;
}
</script>
