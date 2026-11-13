/**
 * குரலற்ற மகளின் குரல் - Admin Panel JS
 * Handles Chart.js visualization, AJAX filtering, and complaint workflows
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // ==========================================
        // 1. DASHBOARD CHARTS INITIALIZATION
        // ==========================================
        if ($('#monthlyChart').length) {
            loadDashboardCharts();
        }

        function loadDashboardCharts() {
            $.ajax({
                url: '/admin/api/dashboard-charts',
                type: 'GET',
                success: function(res) {
                    if (res.success) {
                        initMonthlyChart(res.data.monthly);
                        initCategoryChart(res.data.categories);
                        initTalukChart(res.data.taluks);
                        initStatusChart(res.data.statuses);
                    }
                },
                error: function(err) {
                    console.error('Failed to load dashboard chart data', err);
                }
            });
        }

        function initMonthlyChart(data) {
            var ctx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Complaints Registered',
                        data: data.values,
                        backgroundColor: 'rgba(230, 81, 0, 0.15)',
                        borderColor: '#e65100',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#e65100'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
        }

        function initCategoryChart(data) {
            var ctx = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.values,
                        backgroundColor: [
                            '#e65100', '#1b5e20', '#0284c7', '#f59e0b',
                            '#8b5cf6', '#ec4899', '#10b981', '#64748b'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
                }
            });
        }

        function initTalukChart(data) {
            var ctx = document.getElementById('talukChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Grievances',
                        data: data.values,
                        backgroundColor: '#1b5e20',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } }
                    }
                }
            });
        }

        function initStatusChart(data) {
            var ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.values,
                        backgroundColor: [
                            '#64748b', '#06b6d4', '#f59e0b', '#3b82f6',
                            '#0ea5e9', '#8b5cf6', '#10b981', '#1e293b', '#ef4444'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
                }
            });
        }

        // ==========================================
        // 2. COMPLAINT LIST AJAX FILTER & SEARCH
        // ==========================================
        var complaintFilterTimeout = null;

        $('#adminComplaintSearch, #adminDistrictFilter, #adminStatusFilter, #adminTalukFilter, #adminCategoryFilter').on('change keyup', function() {
            clearTimeout(complaintFilterTimeout);
            complaintFilterTimeout = setTimeout(function() {
                loadComplaintsTable(1);
            }, 300);
        });

        // When District changes in Admin -> update Taluks dropdown
        $('#adminDistrictFilter').on('change', function() {
            var districtId = $(this).val();
            var $talukSelect = $('#adminTalukFilter');

            if (!districtId) {
                // If reset to all districts, restore default prompt
                $talukSelect.html('<option value="">-- All Taluks --</option>');
                return;
            }

            $talukSelect.html('<option value="">-- Loading Taluks... --</option>');
            $.ajax({
                url: '/locations/taluks',
                type: 'GET',
                data: { district_id: districtId },
                success: function(res) {
                    if (res.success && res.data.length > 0) {
                        var opts = '<option value="">-- All Taluks in District (' + res.data.length + ') --</option>';
                        $.each(res.data, function(i, t) {
                            opts += '<option value="' + t.id + '">' + t.name_en + ' (' + (t.name_ta || '') + ')</option>';
                        });
                        $talukSelect.html(opts);
                    } else {
                        $talukSelect.html('<option value="">-- No Taluks found --</option>');
                    }
                },
                error: function() {
                    $talukSelect.html('<option value="">-- All Taluks --</option>');
                }
            });
        });

        $(document).on('click', '#complaintsPagination a', function(e) {
            e.preventDefault();
            var pageUrl = $(this).attr('href');
            if (pageUrl) {
                var urlParams = new URLSearchParams(pageUrl.split('?')[1]);
                var page = urlParams.get('page') || 1;
                loadComplaintsTable(page);
            }
        });

        window.loadComplaintsTable = function(page) {
            var search = $('#adminComplaintSearch').val() || '';
            var districtId = $('#adminDistrictFilter').val() || '';
            var status = $('#adminStatusFilter').val() || '';
            var talukId = $('#adminTalukFilter').val() || '';
            var categoryId = $('#adminCategoryFilter').val() || '';

            $('#complaintsTableContainer').addClass('opacity-50');

            $.ajax({
                url: '/admin/complaints',
                type: 'GET',
                data: {
                    search: search,
                    district_id: districtId,
                    status: status,
                    taluk_id: talukId,
                    category_id: categoryId,
                    page: page,
                    ajax: 1
                },
                success: function(res) {
                    $('#complaintsTableContainer').removeClass('opacity-50').html(res.html);
                },
                error: function() {
                    $('#complaintsTableContainer').removeClass('opacity-50');
                }
            });
        };

        // ==========================================
        // 3. WORKFLOW ACTIONS (STATUS UPDATE & PROOF)
        // ==========================================

        // Dynamic Proof toggle based on selected status
        function updateProofUI() {
            var selectedStatus = $('#statusSelect').val();
            var $container = $('#proofContainer');
            var $badge = $('#proofBadge');
            var $fileInput = $('#resolutionPhoto');
            var $helpText = $('#proofHelpText');

            if (selectedStatus === 'resolved') {
                $badge.removeClass('bg-secondary').addClass('bg-danger').text('Required *');
                $container.removeClass('border bg-light').addClass('border border-danger border-2 bg-white shadow-sm');
                $fileInput.prop('required', true);
                $helpText.html('<span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Attached proof (photo or PDF) is mandatory when marking status as Completed.</span>');
            } else {
                $badge.removeClass('bg-danger').addClass('bg-secondary').text('Optional');
                $container.removeClass('border-danger border-2 shadow-sm').addClass('border bg-light');
                $fileInput.prop('required', false);
                $helpText.text('Attach inspection photo or verification proof document.');
            }
        }

        $('#statusSelect').on('change', updateProofUI);
        $('#statusModal').on('shown.bs.modal', updateProofUI);

        // Update Status Form Submission
        $('#updateStatusForm').on('submit', function(e) {
            e.preventDefault();

            var selectedStatus = $('#statusSelect').val();
            var fileInput = $('#resolutionPhoto')[0];

            // Client-side validation: proof mandatory if completed
            if (selectedStatus === 'resolved' && (!fileInput || !fileInput.files || fileInput.files.length === 0)) {
                alert('Please attach proof (photo or document) to mark this complaint as Completed.');
                $('#resolutionPhoto').focus();
                return false;
            }

            var complaintId = $(this).data('id');
            var formData = new FormData(this);

            var $btn = $(this).find('button[type="submit"]');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');

            $.ajax({
                url: '/admin/complaints/' + complaintId + '/status',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        $btn.prop('disabled', false).html('<i class="bi bi-check2-circle me-1"></i> Save Status Update');
                        alert(res.message || 'Failed to update status.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html('<i class="bi bi-check2-circle me-1"></i> Save Status Update');
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Error updating status.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errorList = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        msg += '\n' + errorList;
                    }
                    alert(msg);
                }
            });
        });

        // Assign Staff Form (Fallback if used elsewhere)
        $('#assignStaffForm').on('submit', function(e) {
            e.preventDefault();
            var complaintId = $(this).data('id');
            var data = $(this).serialize();

            var $btn = $(this).find('button[type="submit"]');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Assigning...');

            $.ajax({
                url: '/admin/complaints/' + complaintId + '/assign',
                type: 'POST',
                data: data,
                success: function(res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        $btn.prop('disabled', false).text('Confirm Assignment');
                        alert(res.message || 'Failed to assign staff.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text('Confirm Assignment');
                    alert(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error assigning staff.');
                }
            });
        });

        // Department Referral Form
        $('#referralForm').on('submit', function(e) {
            e.preventDefault();
            var complaintId = $(this).data('id');
            var data = $(this).serialize();

            var $btn = $(this).find('button[type="submit"]');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Recording...');

            $.ajax({
                url: '/admin/complaints/' + complaintId + '/refer',
                type: 'POST',
                data: data,
                success: function(res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        $btn.prop('disabled', false).text('Record Referral');
                        alert(res.message || 'Failed to record referral.');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text('Record Referral');
                    alert(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error recording referral.');
                }
            });
        });

    });

})(jQuery);
