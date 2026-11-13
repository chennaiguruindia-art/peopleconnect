/**
 * Grievance Registration & Tracking AJAX Handling
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // ==========================================
        // 1. LIVE GPS LOCATION CAPTURE (LATITUDE & LONGITUDE & REVERSE GEOCODE)
        // ==========================================
        function captureLiveLocation() {
            if (!navigator.geolocation) {
                return;
            }

            var geoOptions = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 30000
            };

            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                $('#liveLatitude').val(lat.toFixed(7));
                $('#liveLongitude').val(lng.toFixed(7));

                // Reverse geocode in background to fetch human-readable address for admin
                var nominatimUrl = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&zoom=18&addressdetails=1';
                
                $.ajax({
                    url: nominatimUrl,
                    type: 'GET',
                    dataType: 'json',
                    timeout: 6000,
                    success: function(data) {
                        if (data && data.display_name) {
                            $('#liveAddress').val(data.display_name);
                        } else {
                            $('#liveAddress').val('GPS Pin: ' + lat.toFixed(5) + ', ' + lng.toFixed(5));
                        }
                    },
                    error: function() {
                        $('#liveAddress').val('GPS Pin: ' + lat.toFixed(5) + ', ' + lng.toFixed(5));
                    }
                });
            }, function(error) {
                // Citizen denied location or timeout - form remains fully functional
                console.log('GPS Geolocation status:', error.message);
            }, geoOptions);
        }

        // Trigger on complaint page load
        if ($('#complaintForm').length > 0) {
            captureLiveLocation();
        }

        // ==========================================
        // 2. COMPLAINT FORM SUBMISSION VIA AJAX (DIRECT PHONE NUMBER - NO OTP REQUIRED)
        // ==========================================
        $('#complaintForm').on('submit', function(e) {
            e.preventDefault();

            // Client-side quick check
            var name = $('#citizenName').val().trim();
            var mobile = $('#citizenMobile').val().trim();
            var district = $('#districtSelect').val();
            var division = $('#divisionSelect').val();
            var taluk = $('#talukSelect').val();
            var category = $('#categorySelect').val();
            var subject = $('#complaintSubject').val().trim();
            var description = $('#complaintDesc').val().trim();
            var consent = $('#privacyConsent').is(':checked');

            if (!name || !mobile || !district || !division || !taluk || !category || !subject || !description) {
                showAlert('error', 'Please fill in all mandatory fields marked with an asterisk (*) / கட்டாய புலங்கள் அனைத்தையும் பூர்த்தி செய்யவும்.', 'formAlertContainer');
                return;
            }

            if (!/^[6-9]\d{9}$/.test(mobile)) {
                showAlert('error', 'Please enter a valid 10-digit Indian mobile number (சரியான 10 இலக்க கைபேசி எண்ணை உள்ளிடவும்).', 'formAlertContainer');
                return;
            }

            if (!consent) {
                showAlert('error', 'Please accept the privacy and truthfulness consent checkbox before submitting.', 'formAlertContainer');
                return;
            }

            // Create FormData object to support file uploads
            var formData = new FormData(this);

            var $submitBtn = $('#btnSubmitComplaint');
            var origBtnText = $submitBtn.html();
            $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Submitting Grievance / பதிவாகிறது...');
            showLoading('Encrypting and submitting your grievance to Virudhunagar Civic Portal...');

            $.ajax({
                url: '/complaints',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    hideLoading();
                    $submitBtn.prop('disabled', false).html(origBtnText);

                    if (res.success) {
                        $('#complaintFormCard').hide();
                        $('#complaintSuccessCard').removeClass('d-none').fadeIn();
                        $('#generatedComplaintId').text(res.complaint_id);
                        $('#trackLinkBtn').attr('href', '/track-complaint?complaint_id=' + res.complaint_id + '&mobile=' + encodeURIComponent(mobile));

                        $('html, body').animate({ scrollTop: $('#complaintSuccessCard').offset().top - 70 }, 300);
                    } else {
                        showAlert('error', res.message || 'Error occurred while saving grievance.', 'formAlertContainer');
                    }
                },
                error: function(xhr) {
                    hideLoading();
                    $submitBtn.prop('disabled', false).html(origBtnText);

                    var errorHtml = '<strong>Submission Error:</strong><ul class="mb-0 mt-2">';
                    if (xhr.status === 419) {
                        errorHtml += '<li>அமர்வு காலாவதியாகிவிட்டது (Session expired). தயவுசெய்து பக்கத்தை Refresh செய்து மீண்டும் சமர்ப்பிக்கவும்.</li>';
                    } else if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(field, messages) {
                            $.each(messages, function(i, msg) {
                                errorHtml += '<li>' + msg + '</li>';
                            });
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                    } else {
                        errorHtml += '<li>An unexpected error occurred. Please verify your internet connection.</li>';
                    }
                    errorHtml += '</ul>';

                    showAlert('error', errorHtml, 'formAlertContainer');
                }
            });
        });

        // ==========================================
        // 3. COMPLAINT TRACKING AJAX
        // ==========================================
        $('#trackingForm').on('submit', function(e) {
            e.preventDefault();

            var complaintId = $('#trackComplaintId').val().trim();
            var mobile = $('#trackMobile').val().trim();

            if (!complaintId || !mobile) {
                showAlert('error', 'Please enter both Grievance ID and registered mobile number.', 'trackAlertContainer');
                return;
            }

            var $btn = $('#btnTrackSubmit');
            var origText = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Searching...');
            $('#trackingResultCard').slideUp();

            $.ajax({
                url: '/track-complaint',
                type: 'POST',
                data: {
                    complaint_id: complaintId,
                    citizen_mobile: mobile
                },
                success: function(res) {
                    $btn.prop('disabled', false).html(origText);

                    if (res.success && res.data) {
                        renderTrackingDetails(res.data);
                        $('#trackingResultCard').removeClass('d-none').slideDown();
                        $('#trackAlertContainer').empty();
                    } else {
                        showAlert('error', res.message || 'No grievance record found with the given details.', 'trackAlertContainer');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(origText);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Record not found. Please double-check your Grievance ID and Mobile Number.';
                    showAlert('error', msg, 'trackAlertContainer');
                }
            });
        });

        // Helper function to render tracking result safely
        function renderTrackingDetails(d) {
            $('#resComplaintId').text(d.complaint_id);
            $('#resSubject').text(d.subject);
            $('#resCategory').text(d.category_name);
            $('#resDepartment').text(d.department_name);
            $('#resDate').text(d.created_at_formatted);
            $('#resLocation').text((d.district_name ? d.district_name + ' • ' : '') + d.taluk_name + (d.village_name ? ' - ' + d.village_name : '') + (d.ward_number ? ' (Ward ' + d.ward_number + ')' : ''));
            
            // Status Badge
            $('#resStatusBadge').html('<span class="badge ' + d.status_badge_class + ' px-3 py-2 fs-6">' + d.status_label + '</span>');

            // Officer / Referral info
            if (d.assigned_officer) {
                $('#resAssignedTo').text(d.assigned_officer.name + ' (' + d.assigned_officer.designation + ', ' + d.assigned_officer.department + ')');
                $('#assignedRow').show();
            } else {
                $('#assignedRow').hide();
            }

            if (d.referral_status && d.referral_status !== 'not_referred') {
                $('#resReferralStatus').text(d.referral_status_label);
                $('#referralRow').show();
            } else {
                $('#referralRow').hide();
            }

            if (d.resolution_remarks) {
                $('#resRemarks').text(d.resolution_remarks);
                $('#resolutionBox').show();
            } else {
                $('#resolutionBox').hide();
            }

            // Timeline
            var timelineHtml = '';
            if (d.history && d.history.length > 0) {
                $.each(d.history, function(i, h) {
                    var markerClass = h.new_status === 'resolved' ? 'resolved' : (i === 0 ? 'active' : '');
                    timelineHtml += '<div class="timeline-step">' +
                        '<div class="timeline-marker ' + markerClass + '"></div>' +
                        '<div class="timeline-content">' +
                        '<div class="d-flex justify-content-between align-items-center mb-1">' +
                        '<span class="badge bg-secondary">' + h.new_status_label + '</span>' +
                        '<span class="timeline-date"><i class="bi bi-clock me-1"></i>' + h.created_at_formatted + '</span>' +
                        '</div>' +
                        '<div class="timeline-title">' + (h.action || 'Status Update') + '</div>' +
                        (h.remarks ? '<p class="text-muted small mb-0 mt-1">' + h.remarks + '</p>' : '') +
                        '</div>' +
                        '</div>';
                });
            } else {
                timelineHtml = '<p class="text-muted small">Initial registration recorded.</p>';
            }
            $('#timelineContainer').html(timelineHtml);
        }

        // Auto-run track if complaint_id and mobile parameters are in URL
        var urlParams = new URLSearchParams(window.location.search);
        var qId = urlParams.get('complaint_id');
        var qMobile = urlParams.get('mobile');
        if (qId && qMobile && $('#trackingForm').length) {
            $('#trackComplaintId').val(qId);
            $('#trackMobile').val(qMobile);
            $('#trackingForm').trigger('submit');
        }

    });

})(jQuery);
