<!-- Indian Tricolor Top Accent Line -->
<div class="top-tricolor-line" style="height: 3px; background: linear-gradient(90deg, #ff9933 0%, #ff9933 33.3%, #ffffff 33.3%, #ffffff 66.6%, #138808 66.6%, #138808 100%);"></div>

<!-- Top Utility & Civic Notice Bar (Dark Navy #08162b Theme) -->
<div class="top-utility-bar py-1">
    <div class="container-fluid px-2 px-md-3 px-xl-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <!-- Top Left: Megaphone Notice Badge + Disclaimer Text -->
        <div class="d-flex align-items-center gap-2 flex-grow-1 overflow-hidden py-0.5">
            <span class="badge-notice-orange flex-shrink-0">
                <i class="bi bi-megaphone-fill me-1"></i>{{ app()->getLocale() === 'en' ? 'NOTICE' : 'அறிவிப்பு / NOTICE' }}
            </span>
            <span class="top-bar-divider d-none d-md-inline">|</span>
            <span class="top-notice-text text-truncate" title="{{ __('messages.disclaimer_text') }}">
                {{ __('messages.disclaimer_text') }}
            </span>
        </div>

        <!-- Right: Helpline Pill + Language Switcher Pill -->
        <div class="d-flex align-items-center gap-2 ms-auto py-0.5 flex-shrink-0">
            <a href="tel:+919384995222" class="top-helpline-pill text-decoration-none">
                <span class="helpline-icon-circle"><i class="bi bi-telephone-fill"></i></span>
                <span class="helpline-text">{{ app()->getLocale() === 'en' ? 'Helpline: +91 9384995222' : 'உதவி எண்: +91 9384995222' }}</span>
            </a>
            <span class="top-bar-divider d-none d-sm-inline">|</span>
            @include('components.language-switcher')
        </div>
    </div>
</div>
