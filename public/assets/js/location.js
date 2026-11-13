/**
 * Dependent Location Dropdowns Handler (District -> Revenue Division -> Taluk -> Revenue Village)
 * Enhanced with Select2 Searchable Dropdown Support (Type to Filter & Choose)
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        /**
         * Safe Select2 Setup Helper
         */
        function setupSelect2($el, placeholderText) {
            if (!$el.length || typeof $.fn.select2 === 'undefined') return;
            
            if ($el.data('select2')) {
                $el.select2('destroy');
            }

            var isTa = (document.documentElement.lang === 'ta');
            var defaultPlaceholder = isTa ? '-- தேர்வு செய்க --' : '-- Select --';

            $el.select2({
                theme: 'bootstrap-5',
                placeholder: placeholderText || defaultPlaceholder,
                allowClear: false,
                width: '100%',
                language: {
                    noResults: function() {
                        return isTa ? "பொருத்தமான விபரங்கள் கிடைக்கவில்லை" : "No matching results found";
                    },
                    searching: function() {
                        return isTa ? "தேடுகிறது..." : "Searching...";
                    }
                }
            });
        }

        // Auto-focus search input when any Select2 dropdown opens
        $(document).on('select2:open', function() {
            var searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        });

        // Initialize Select2 on existing dropdowns on page load
        setupSelect2($('#districtSelect'), '-- மாவட்டம் தேர்வு செய்க --');
        setupSelect2($('#divisionSelect'), '-- முதலில் மாவட்டம் தேர்வு செய்க --');
        setupSelect2($('#talukSelect'), '-- முதலில் வருவாய் கோட்டம் தேர்வு செய்க --');
        setupSelect2($('#villageSelect'), '-- முதலில் வட்டம் தேர்வு செய்க --');
        setupSelect2($('#categorySelect'), '-- கோரிக்கை வகை தேர்வு செய்க --');

        // When District changes -> Load Revenue Divisions
        $('#districtSelect').on('change', function() {
            var districtId = $(this).val();
            var $divisionSelect = $('#divisionSelect');
            var $talukSelect = $('#talukSelect');
            var $villageSelect = $('#villageSelect');
            var $villageSelectGroup = $('#villageSelectGroup');
            var $villageManualGroup = $('#villageManualGroup');
            var $customInput = $('#customVillageInput');

            $divisionSelect.html('<option value="">-- வருவாய் கோட்டம் ஏற்றுகிறது... --</option>').prop('disabled', true);
            $talukSelect.html('<option value="">-- முதலில் வருவாய் கோட்டம் தேர்வு செய்க --</option>').prop('disabled', true);
            $villageSelect.html('<option value="">-- முதலில் வட்டம் தேர்வு செய்க --</option>').prop('disabled', true);

            setupSelect2($divisionSelect, '-- வருவாய் கோட்டம் ஏற்றுகிறது... --');
            setupSelect2($talukSelect, '-- முதலில் வருவாய் கோட்டம் தேர்வு செய்க --');
            setupSelect2($villageSelect, '-- முதலில் வட்டம் தேர்வு செய்க --');

            $villageSelectGroup.removeClass('d-none');
            $villageManualGroup.addClass('d-none');
            $customInput.val('');

            if (!districtId) {
                $divisionSelect.html('<option value="">-- முதலில் மாவட்டம் தேர்வு செய்க --</option>');
                setupSelect2($divisionSelect, '-- முதலில் மாவட்டம் தேர்வு செய்க --');
                return;
            }

            $.ajax({
                url: '/locations/divisions',
                type: 'GET',
                data: { district_id: districtId },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        var options = '<option value="">-- வருவாய் கோட்டம் தேர்வு செய்க --</option>';
                        $.each(response.data, function(index, div) {
                            var name = (document.documentElement.lang === 'ta' && div.name_ta) ? div.name_ta : div.name_en;
                            options += '<option value="' + div.id + '">' + name + ' (' + div.name_en + ')</option>';
                        });
                        $divisionSelect.html(options).prop('disabled', false);
                        setupSelect2($divisionSelect, '-- வருவாய் கோட்டம் தேர்வு செய்க --');
                    } else {
                        $divisionSelect.html('<option value="">-- வருவாய் கோட்டங்கள் இல்லை --</option>');
                        setupSelect2($divisionSelect, '-- வருவாய் கோட்டங்கள் இல்லை --');
                    }
                },
                error: function() {
                    $divisionSelect.html('<option value="">-- வருவாய் கோட்டம் பெற இயலவில்லை --</option>');
                    setupSelect2($divisionSelect, '-- வருவாய் கோட்டம் பெற இயலவில்லை --');
                }
            });
        });

        // When Revenue Division changes -> Load Taluks
        $('#divisionSelect').on('change', function() {
            var divisionId = $(this).val();
            var $talukSelect = $('#talukSelect');
            var $villageSelect = $('#villageSelect');
            var $villageSelectGroup = $('#villageSelectGroup');
            var $villageManualGroup = $('#villageManualGroup');
            var $customInput = $('#customVillageInput');

            $talukSelect.html('<option value="">-- தாலுகாக்கள் ஏற்றுகிறது... --</option>').prop('disabled', true);
            $villageSelect.html('<option value="">-- முதலில் வட்டம் தேர்வு செய்க --</option>').prop('disabled', true);

            setupSelect2($talukSelect, '-- தாலுகாக்கள் ஏற்றுகிறது... --');
            setupSelect2($villageSelect, '-- முதலில் வட்டம் தேர்வு செய்க --');

            $villageSelectGroup.removeClass('d-none');
            $villageManualGroup.addClass('d-none');
            $customInput.val('');

            if (!divisionId) {
                $talukSelect.html('<option value="">-- முதலில் வருவாய் கோட்டம் தேர்வு செய்க --</option>');
                setupSelect2($talukSelect, '-- முதலில் வருவாய் கோட்டம் தேர்வு செய்க --');
                return;
            }

            $.ajax({
                url: '/locations/taluks',
                type: 'GET',
                data: { division_id: divisionId },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        var options = '<option value="">-- வட்டம் (தாலுகா) தேர்வு செய்க --</option>';
                        $.each(response.data, function(index, taluk) {
                            var name = (document.documentElement.lang === 'ta' && taluk.name_ta) ? taluk.name_ta : taluk.name_en;
                            options += '<option value="' + taluk.id + '">' + name + ' (' + taluk.name_en + ')</option>';
                        });
                        $talukSelect.html(options).prop('disabled', false);
                        setupSelect2($talukSelect, '-- வட்டம் (தாலுகா) தேர்வு செய்க --');
                    } else {
                        $talukSelect.html('<option value="">-- வட்டங்கள் இல்லை --</option>');
                        setupSelect2($talukSelect, '-- வட்டங்கள் இல்லை --');
                    }
                },
                error: function() {
                    $talukSelect.html('<option value="">-- தாலுகா பெற இயலவில்லை --</option>');
                    setupSelect2($talukSelect, '-- தாலுகா பெற இயலவில்லை --');
                }
            });
        });

        // When Taluk changes -> Load Revenue Villages & Towns
        $('#talukSelect').on('change', function() {
            var talukId = $(this).val();
            var $villageSelect = $('#villageSelect');
            var $villageSelectGroup = $('#villageSelectGroup');
            var $villageManualGroup = $('#villageManualGroup');
            var $customInput = $('#customVillageInput');

            $villageSelect.html('<option value="">-- கிராமங்கள் ஏற்றுகிறது... --</option>').prop('disabled', true);
            setupSelect2($villageSelect, '-- கிராமங்கள் ஏற்றுகிறது... --');

            $villageSelectGroup.removeClass('d-none');
            $villageManualGroup.addClass('d-none');
            $customInput.val('');

            if (!talukId) {
                $villageSelect.html('<option value="">-- முதலில் வட்டம் தேர்வு செய்க --</option>');
                setupSelect2($villageSelect, '-- முதலில் வட்டம் தேர்வு செய்க --');
                return;
            }

            $.ajax({
                url: '/locations/villages',
                type: 'GET',
                data: { taluk_id: talukId },
                success: function(response) {
                    var options = '<option value="">-- கிராமம் அல்லது நகரம் தேர்வு செய்க --</option>';
                    if (response.success && response.data.length > 0) {
                        $.each(response.data, function(index, village) {
                            var isTa = (document.documentElement.lang === 'ta');
                            var primary = isTa ? (village.name_ta || village.name_en) : (village.name_en || village.name_ta);
                            var secondary = isTa ? village.name_en : village.name_ta;
                            var display = (secondary && secondary !== primary) ? primary + ' (' + secondary + ')' : primary;
                            options += '<option value="' + village.id + '">' + display + '</option>';
                        });
                        options += '<option value="other" class="fw-bold text-primary">[+] பிற கிராமம் / நகர் (Type Manually)</option>';
                        $villageSelect.html(options).prop('disabled', false);
                        setupSelect2($villageSelect, '-- கிராமம் அல்லது நகரம் தேர்வு செய்க --');
                    } else {
                        // If no villages pre-seeded for this taluk, switch directly to manual entry
                        $villageSelect.html('<option value="other" selected>[+] பிற கிராமம் / நகர் (Type Manually)</option>').prop('disabled', false);
                        setupSelect2($villageSelect, '-- கிராமம் அல்லது நகரம் தேர்வு செய்க --');
                        $villageSelectGroup.addClass('d-none');
                        $villageManualGroup.removeClass('d-none');
                        $customInput.focus();
                    }
                },
                error: function() {
                    $villageSelect.html('<option value="other" selected>[+] பிற கிராமம் / நகர் (Type Manually)</option>').prop('disabled', false);
                    setupSelect2($villageSelect, '-- கிராமம் அல்லது நகரம் தேர்வு செய்க --');
                    $villageSelectGroup.addClass('d-none');
                    $villageManualGroup.removeClass('d-none');
                }
            });
        });

        // When Village Dropdown changes (if 'other' selected)
        $('#villageSelect').on('change', function() {
            var val = $(this).val();
            var $villageSelectGroup = $('#villageSelectGroup');
            var $villageManualGroup = $('#villageManualGroup');
            var $customInput = $('#customVillageInput');

            if (val === 'other') {
                $villageSelectGroup.addClass('d-none');
                $villageManualGroup.removeClass('d-none');
                $customInput.focus();
            } else {
                $customInput.val('');
            }
        });

        // Switch to Manual Text input button
        $('#btnSwitchToManual').on('click', function(e) {
            e.preventDefault();
            $('#villageSelectGroup').addClass('d-none');
            $('#villageManualGroup').removeClass('d-none');
            $('#villageSelect').val('other').trigger('change.select2');
            $('#customVillageInput').focus();
        });

        // Switch back to Village Select Dropdown button
        $('#btnSwitchToSelect').on('click', function(e) {
            e.preventDefault();
            $('#villageManualGroup').addClass('d-none');
            $('#villageSelectGroup').removeClass('d-none');
            if ($('#villageSelect option[value=""]').length > 0) {
                $('#villageSelect').val('').trigger('change.select2');
            }
            $('#customVillageInput').val('');
        });
    });

})(jQuery);
