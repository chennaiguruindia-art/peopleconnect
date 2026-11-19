<?php

use App\Models\Admin;
use App\Models\DevelopmentBlock;
use App\Models\District;
use App\Models\Municipality;
use App\Models\PublicUpdate;
use App\Models\SystemSetting;
use App\Models\TownPanchayat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Set Tirunelveli as primary active district and hide (deactivate) others without deleting
        District::where('name_en', 'not like', '%Tirunelveli%')->update(['is_active' => false]);
        District::where('name_en', 'like', '%Tirunelveli%')->update(['is_active' => true]);

        $tirunelveli = District::where('name_en', 'like', '%Tirunelveli%')->first();

        if ($tirunelveli) {
            // 2. Tirunelveli Municipal Corporation & Municipalities
            $municipalities = [
                ['code' => 'MUN-TNV-CORP', 'en' => 'Tirunelveli Municipal Corporation', 'ta' => 'திருநெல்வேலி மாநகராட்சி', 'type' => 'Corporation'],
                ['code' => 'MUN-TNV-AMB', 'en' => 'Ambasamudram Municipality', 'ta' => 'அம்பாசமுத்திரம் நகராட்சி', 'type' => 'Selection Grade'],
                ['code' => 'MUN-TNV-VKP', 'en' => 'Vikramasingapuram Municipality', 'ta' => 'விக்கிரமசிங்கபுரம் நகராட்சி', 'type' => 'First Grade'],
                ['code' => 'MUN-TNV-KLK', 'en' => 'Kalakkad Municipality', 'ta' => 'களக்காடு நகராட்சி', 'type' => 'Second Grade'],
            ];

            foreach ($municipalities as $m) {
                Municipality::updateOrCreate(
                    ['code' => $m['code']],
                    [
                        'district_id' => $tirunelveli->id,
                        'name_en' => $m['en'],
                        'name_ta' => $m['ta'],
                        'type' => $m['type'],
                        'is_active' => true,
                    ]
                );
            }

            // 3. Tirunelveli Town Panchayats
            $townPanchayats = [
                ['code' => 'TP-TNV-CMD', 'en' => 'Cheranmahadevi Town Panchayat', 'ta' => 'சேரன்மகாதேவி பேரூராட்சி'],
                ['code' => 'TP-TNV-MNR', 'en' => 'Manur Town Panchayat', 'ta' => 'மானூர் பேரூராட்சி'],
                ['code' => 'TP-TNV-MKD', 'en' => 'Mukkudal Town Panchayat', 'ta' => 'முக்கூடலூர் பேரூராட்சி'],
                ['code' => 'TP-TNV-NGN', 'en' => 'Nanguneri Town Panchayat', 'ta' => 'நாங்குநேரி பேரூராட்சி'],
                ['code' => 'TP-TNV-PNG', 'en' => 'Panagudi Town Panchayat', 'ta' => 'பனகுடி பேரூராட்சி'],
                ['code' => 'TP-TNV-RDP', 'en' => 'Radhapuram Town Panchayat', 'ta' => 'ராதாபுரம் பேரூராட்சி'],
                ['code' => 'TP-TNV-SKN', 'en' => 'Sankarnagar Town Panchayat', 'ta' => 'சங்கர் நகர் பேரூராட்சி'],
                ['code' => 'TP-TNV-TSV', 'en' => 'Tisaiyanvilai Town Panchayat', 'ta' => 'திசையன்விளை பேரூராட்சி'],
                ['code' => 'TP-TNV-VVR', 'en' => 'Vadakkuvalliyur Town Panchayat', 'ta' => 'வடக்குவள்ளியூர் பேரூராட்சி'],
                ['code' => 'TP-TNV-VVN', 'en' => 'Veeravanallur Town Panchayat', 'ta' => 'வீரவநல்லூர் பேரூராட்சி'],
                ['code' => 'TP-TNV-GPS', 'en' => 'Gopalasamudram Town Panchayat', 'ta' => 'கோபாலசமுத்திரம் பேரூராட்சி'],
                ['code' => 'TP-TNV-MLC', 'en' => 'Melacheval Town Panchayat', 'ta' => 'மேலச்செவல் பேரூராட்சி'],
                ['code' => 'TP-TNV-MKP', 'en' => 'Moolakaraipatti Town Panchayat', 'ta' => 'மூலக்கரைப்பட்டி பேரூராட்சி'],
                ['code' => 'TP-TNV-NNP', 'en' => 'Naranammalpuram Town Panchayat', 'ta' => 'நாரணம்மாள்புரம் பேரூராட்சி'],
                ['code' => 'TP-TNV-PTM', 'en' => 'Pathamadai Town Panchayat', 'ta' => 'பத்தமடை பேரூராட்சி'],
            ];

            foreach ($townPanchayats as $tp) {
                TownPanchayat::updateOrCreate(
                    ['code' => $tp['code']],
                    [
                        'district_id' => $tirunelveli->id,
                        'name_en' => $tp['en'],
                        'name_ta' => $tp['ta'],
                        'is_active' => true,
                    ]
                );
            }

            // 4. Tirunelveli Development Blocks (Panchayat Unions)
            $blocks = [
                ['code' => 'BLK-TNV-AMB', 'en' => 'Ambasamudram Block', 'ta' => 'அம்பாசமுத்திரம் ஒன்றியம்'],
                ['code' => 'BLK-TNV-CMD', 'en' => 'Cheranmahadevi Block', 'ta' => 'சேரன்மகாதேவி ஒன்றியம்'],
                ['code' => 'BLK-TNV-KLK', 'en' => 'Kalakkad Block', 'ta' => 'களக்காடு ஒன்றியம்'],
                ['code' => 'BLK-TNV-MNR', 'en' => 'Manur Block', 'ta' => 'மானூர் ஒன்றியம்'],
                ['code' => 'BLK-TNV-NGN', 'en' => 'Nanguneri Block', 'ta' => 'நாங்குநேரி ஒன்றியம்'],
                ['code' => 'BLK-TNV-PLK', 'en' => 'Palayamkottai Block', 'ta' => 'பாளையங்கோட்டை ஒன்றியம்'],
                ['code' => 'BLK-TNV-PPK', 'en' => 'Pappakudi Block', 'ta' => 'பாப்பாகுடி ஒன்றியம்'],
                ['code' => 'BLK-TNV-RDP', 'en' => 'Radhapuram Block', 'ta' => 'ராதாபுரம் ஒன்றியம்'],
                ['code' => 'BLK-TNV-VLR', 'en' => 'Valliyoor Block', 'ta' => 'வள்ளியூர் ஒன்றியம்'],
            ];

            foreach ($blocks as $b) {
                DevelopmentBlock::updateOrCreate(
                    ['code' => $b['code']],
                    [
                        'district_id' => $tirunelveli->id,
                        'name_en' => $b['en'],
                        'name_ta' => $b['ta'],
                        'is_active' => true,
                    ]
                );
            }
        }

        // 5. System Settings Update for Tirunelveli
        SystemSetting::updateOrCreate(
            ['key' => 'site_name_ta'],
            [
                'value' => 'திருநெல்வேலி மக்கள் குரல்',
                'group' => 'general',
                'description' => 'Portal Name in Tamil',
            ]
        );

        SystemSetting::updateOrCreate(
            ['key' => 'office_address'],
            [
                'value' => 'Civic Grievance Facilitation Center, Tirunelveli - 627001',
                'group' => 'contact',
                'description' => 'Office Address',
            ]
        );

        SystemSetting::updateOrCreate(
            ['key' => 'disclaimer_ta'],
            [
                'value' => 'திருநெல்வேலி மக்கள் குரல் என்பது ஒரு மக்கள் குறைதீர் தளம். இது எந்த ஒரு அரசுத் துறையின் நேரடி அதிகாரப்பூர்வ தளம் அல்ல; மக்கள் நலன் மற்றும் சமூக ஒருங்கிணைப்பிற்காக இயங்குகிறது.',
                'group' => 'legal',
                'description' => 'Tamil disclaimer',
            ]
        );

        // 6. Administrator Display Name Update
        User::where('email', 'thepeopleconnectofficial@gmail.com')->update(['name' => 'Tirunelveli Admin']);
        Admin::where('email', 'thepeopleconnectofficial@gmail.com')->update(['name' => 'Tirunelveli Admin']);

        // 7. Initial News & Public Updates for Tirunelveli
        PublicUpdate::updateOrCreate(
            ['title_en' => 'Summer Drinking Water Pipeline Overhaul in Tirunelveli and Cheranmahadevi'],
            [
                'title_ta' => 'திருநெல்வேலி மற்றும் சேரன்மகாதேவியில் கோடை கால குடிநீர் குழாய் சீரமைப்பு பணிகள் தீவிரம்',
                'content_en' => 'The TWAD Board has commenced comprehensive desilting and pipeline enhancement works along the Thamirabarani water scheme to guarantee uninterrupted supply across Tirunelveli and Palayamkottai municipalities during the approaching summer season.',
                'content_ta' => 'வருகின்ற கோடைகாலத்தில் திருநெல்வேலி மற்றும் பாளையங்கோட்டை பகுதிகளில் தடையின்றி குடிநீர் வழங்குவதை உறுதி செய்யும் வகையில் தாமிரபரணி குடிநீர் திட்ட பிரதான குழாய்களில் தூர்வாருதல் மற்றும் பராமரிப்பு பணிகள் முடுக்கிவிடப்பட்டுள்ளன.',
                'category' => 'Water Supply',
                'published_at' => Carbon::now()->subDays(2),
                'is_active' => true,
            ]
        );

        PublicUpdate::updateOrCreate(
            ['title_en' => 'Palayamkottai & Tirunelveli Town Ring Road Drainage Decongestion Drive Underway'],
            [
                'title_ta' => 'பாளையங்கோட்டை மற்றும் திருநெல்வேலி மாநகர வெளிவட்டச் சாலை மழைநீர் வடிகால் சீரமைப்பு பணிகள் தொடக்கம்',
                'content_en' => 'Tirunelveli City Corporation engineers have initiated major clearing of blocked arterial drains alongside the main corridor to avert seasonal waterlogging.',
                'content_ta' => 'திருநெல்வேலி மாநகராட்சி சார்பில் இணைப்பு சாலைகள் மற்றும் பிரதான மழைநீர் வடிகால்களில் தூர்வாரும் பணிகள் முழுவீச்சில் நடைபெற்று வருகின்றன.',
                'category' => 'Infrastructure',
                'published_at' => Carbon::now()->subDays(5),
                'is_active' => true,
            ]
        );

        PublicUpdate::updateOrCreate(
            ['title_en' => 'Special Dengue Prevention and Health Camps in Ambasamudram and Nanguneri'],
            [
                'title_ta' => 'அம்பாசமுத்திரம் மற்றும் நாங்குநேரியில் சிறப்பு டெங்கு தடுப்பு மற்றும் சுகாதார முகாம்கள்',
                'content_en' => 'Mobile medical teams and sanitary squads are conducting source reduction and intensive door-to-door fogging operations in high-risk taluks.',
                'content_ta' => 'அம்பாசமுத்திரம் மற்றும் நாங்குநேரி வட்டாரங்களில் சுகாதாரத் துறை மூலம் கொசுப்புழு ஒழிப்பு மற்றும் வீடு வீடாக நிலவேம்பு குடிநீர் வழங்கும் சிறப்பு முகாம்கள் தொடங்கப்பட்டுள்ளன.',
                'category' => 'Public Health',
                'published_at' => Carbon::now()->subDays(7),
                'is_active' => true,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        District::query()->update(['is_active' => true]);
    }
};
