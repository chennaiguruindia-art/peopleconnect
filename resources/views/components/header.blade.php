<!-- Indian Tricolor Top Accent Line -->
<div class="top-tricolor-line" style="height: 3px; background: linear-gradient(90deg, #ff9933 0%, #ff9933 33.3%, #ffffff 33.3%, #ffffff 66.6%, #138808 66.6%, #138808 100%);"></div>

<!-- Top Utility & Civic Notice Bar (Modern Sleek Civic Theme) -->
<div class="top-utility-bar py-1.5 notranslate" translate="no">
    <div class="container-fluid px-2 px-md-3 px-xl-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <!-- Top Left: Megaphone Notice Badge + Scrolling Disclaimer Text -->
        <div class="d-flex align-items-center gap-2 flex-grow-1 overflow-hidden top-notice-col">
            <span class="badge-notice-modern flex-shrink-0">
                <i class="bi bi-broadcast me-1"></i>{{ app()->getLocale() === 'en' ? 'NOTICE' : 'அறிவிப்பு / NOTICE' }}
            </span>
            <div class="notice-ticker-box flex-grow-1 overflow-hidden">
                <marquee behavior="scroll" direction="left" scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();" class="notice-marquee-text mb-0">
                    {{ __('messages.disclaimer_text') }}
                </marquee>
            </div>
        </div>

        <!-- Right: Helpline Pill + Language Switcher Pill -->
        <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">
            <a href="tel:+919384995222" class="top-helpline-pill text-decoration-none">
                <span class="helpline-icon-circle"><i class="bi bi-telephone-fill"></i></span>
                <span class="helpline-text">{{ app()->getLocale() === 'en' ? 'Helpline: +91 9384995222' : 'உதவி: +91 9384995222' }}</span>
            </a>
            <div class="top-lang-wrapper">
                @include('components.language-switcher')
            </div>
        </div>
    </div>
</div>
