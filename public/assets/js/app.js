/**
 * குரலற்ற மகளின் குரல் - Core Application JS
 * Setup CSRF tokens, AJAX defaults, and global helpers
 */

(function($) {
    'use strict';

    // Configure jQuery AJAX with CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    // Global loading helpers
    window.showLoading = function(message) {
        if (message) {
            $('#loadingMessage').text(message);
        }
        $('#globalLoadingOverlay').css('display', 'flex').hide().fadeIn(150);
    };

    window.hideLoading = function() {
        $('#globalLoadingOverlay').fadeOut(150);
    };

    // Alert display helper
    window.showAlert = function(type, message, containerId) {
        var alertClass = 'alert-' + (type === 'error' ? 'danger' : type);
        var icon = type === 'success' ? 'bi-check-circle-fill' : (type === 'error' ? 'bi-exclamation-triangle-fill' : 'bi-info-circle-fill');
        var html = '<div class="alert ' + alertClass + ' alert-dismissible fade show shadow-sm" role="alert">' +
            '<div class="d-flex align-items-center gap-2">' +
            '<i class="bi ' + icon + ' fs-5"></i>' +
            '<div>' + message + '</div>' +
            '</div>' +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>';

        if (containerId) {
            $('#' + containerId).html(html);
        } else {
            $('#alertContainer').html(html);
            $('html, body').animate({ scrollTop: $('#alertContainer').offset().top - 80 }, 300);
        }
    };

})(jQuery);
