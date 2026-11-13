/**
 * Gemini AI Dynamic Page Translator
 * Automatically translates any Tamil text to English (or vice versa) via backend Gemini API
 */
(function() {
    'use strict';

    // Tamil Unicode regex range: \u0B80-\u0BFF
    const TAMIL_REGEX = /[\u0B80-\u0BFF]/;

    function getTargetLocale() {
        const docLang = document.documentElement.lang || 'ta';
        return docLang.toLowerCase().startsWith('en') ? 'en' : 'ta';
    }

    function collectTranslatableElements() {
        const targetLocale = getTargetLocale();
        // If current site is Tamil, we don't need to auto-translate Tamil text
        if (targetLocale !== 'en') {
            return [];
        }

        const elements = [];
        // Target text containers, skipping scripts, styles, inputs, icons, etc.
        const candidates = document.querySelectorAll(
            'p, h1, h2, h3, h4, h5, h6, span, a, label, li, td, th, .badge, .alert, blockquote'
        );

        candidates.forEach(el => {
            // Skip hidden elements, Google translate elements, Select2, icons
            if (el.closest('#google_translate_element') || 
                el.closest('.select2-container') || 
                el.classList.contains('bi') || 
                el.tagName === 'SCRIPT' || 
                el.tagName === 'STYLE' || 
                el.getAttribute('data-no-translate') !== null) {
                return;
            }

            // Check if element has direct text nodes with Tamil characters
            for (let node of el.childNodes) {
                if (node.nodeType === Node.TEXT_NODE) {
                    const text = node.textContent.trim();
                    if (text.length > 1 && TAMIL_REGEX.test(text)) {
                        elements.push({ node: node, original: text });
                    }
                }
            }
        });

        return elements;
    }

    async function translateViaGeminiApi() {
        const targetLocale = getTargetLocale();
        if (targetLocale !== 'en') return;

        const targets = collectTranslatableElements();
        if (targets.length === 0) return;

        const uncached = [];
        const toUpdate = [];

        targets.forEach(item => {
            const cacheKey = 'gemini_trans_en_' + btoa(unescape(encodeURIComponent(item.original))).slice(0, 40);
            const cached = sessionStorage.getItem(cacheKey);
            if (cached) {
                item.node.textContent = item.node.textContent.replace(item.original, cached);
            } else {
                if (!uncached.includes(item.original)) {
                    uncached.push(item.original);
                }
                toUpdate.push({ node: item, cacheKey: cacheKey });
            }
        });

        if (uncached.length === 0) return;

        // Batch translate up to 30 items at once
        const batchSize = 30;
        for (let i = 0; i < uncached.length; i += batchSize) {
            const batch = uncached.slice(i, i + batchSize);
            try {
                const response = await fetch('/api/translate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        texts: batch,
                        target: 'en',
                        source: 'ta'
                    })
                });

                if (!response.ok) continue;

                const data = await response.json();
                if (data.success && data.translations) {
                    targets.forEach(item => {
                        const idx = batch.indexOf(item.original);
                        if (idx !== -1 && data.translations[idx]) {
                            const translated = data.translations[idx];
                            item.node.textContent = item.node.textContent.replace(item.original, translated);
                            const cacheKey = 'gemini_trans_en_' + btoa(unescape(encodeURIComponent(item.original))).slice(0, 40);
                            try {
                                sessionStorage.setItem(cacheKey, translated);
                            } catch(e) {}
                        }
                    });
                }
            } catch (err) {
                console.warn('Gemini API Translation error:', err);
            }
        }
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', translateViaGeminiApi);
    } else {
        translateViaGeminiApi();
    }

    // Expose helper on window for dynamic updates
    window.GeminiPageTranslator = {
        translate: translateViaGeminiApi
    };
})();
