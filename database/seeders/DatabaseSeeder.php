<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintCategory;
use App\Models\ComplaintHistory;
use App\Models\DepartmentReferral;
use App\Models\DevelopmentBlock;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Permission;
use App\Models\PublicUpdate;
use App\Models\RevenueDivision;
use App\Models\RevenueVillage;
use App\Models\Role;
use App\Models\SystemSetting;
use App\Models\Taluk;
use App\Models\TownPanchayat;
use App\Models\User;
use App\Models\VillagePanchayat;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Roles & Permissions
        $superAdminRole = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Administrator',
            'display_name_ta' => 'முதன்மை நிர்வாகி',
            'description' => 'Full administrative access to the entire portal',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Portal Administrator',
            'display_name_ta' => 'தள நிர்வாகி',
            'description' => 'General portal administration and grievance oversight',
        ]);

        $staffRole = Role::create([
            'name' => 'staff',
            'display_name' => 'Grievance Officer',
            'display_name_ta' => 'கோரிக்கை அதிகாரி',
            'description' => 'Handles, reviews and acts on assigned complaints',
        ]);

        $citizenRole = Role::create([
            'name' => 'citizen',
            'display_name' => 'Citizen',
            'display_name_ta' => 'பொதுமக்கள்',
            'description' => 'Public portal citizen user',
        ]);

        $permissions = [
            ['name' => 'manage_complaints', 'display_name' => 'Manage Grievances'],
            ['name' => 'assign_complaints', 'display_name' => 'Assign Staff'],
            ['name' => 'refer_departments', 'display_name' => 'Department Referrals'],
            ['name' => 'manage_locations', 'display_name' => 'Manage Locations'],
            ['name' => 'manage_categories', 'display_name' => 'Manage Categories'],
            ['name' => 'manage_staff', 'display_name' => 'Manage Staff'],
            ['name' => 'view_reports', 'display_name' => 'View Reports & Analytics'],
            ['name' => 'manage_settings', 'display_name' => 'Manage Portal Settings'],
            ['name' => 'manage_updates', 'display_name' => 'Publish News & Updates'],
        ];

        foreach ($permissions as $perm) {
            $createdPerm = Permission::create($perm);
            $superAdminRole->permissions()->attach($createdPerm->id);
            $adminRole->permissions()->attach($createdPerm->id);
        }

        // 2. Single Common Administrator
        $adminUser = User::create([
            'name' => 'Virudhunagar Admin',
            'email' => 'admin@virudhunagar.org',
            'mobile' => '9443012345',
            'password' => Hash::make('password123'),
            'role_id' => $superAdminRole->id,
            'designation' => 'District Grievance Coordinator',
            'department' => 'Citizen Facilitation Cell',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'name' => 'Virudhunagar Admin',
            'email' => 'admin@virudhunagar.org',
            'mobile' => '9443012345',
            'password' => Hash::make('password123'),
            'role_id' => $superAdminRole->id,
            'department' => 'Citizen Facilitation Cell',
            'designation' => 'District Grievance Coordinator',
            'is_active' => true,
        ]);

        // 3. All 38 Districts, Revenue Divisions & Taluks of குரலற்ற மகளின் குரல்
        $this->call(TamilNaduAllDistrictsSeeder::class);
        $this->call(OfficialVirudhunagarLocationsSeeder::class);
        $this->call(OfficialTamilNaduRevenueVillagesSeeder::class);

        $district = District::where('code', 'VNR-3326')->first();

        // Development Blocks (Panchayat Unions)
        $blocksData = [
            ['code' => 'BLK-VNR', 'en' => 'Virudhunagar Block', 'ta' => 'விருதுநகர் ஒன்றியம்'],
            ['code' => 'BLK-SVI', 'en' => 'Sivakasi Block', 'ta' => 'சிவகாசி ஒன்றியம்'],
            ['code' => 'BLK-RJP', 'en' => 'Rajapalayam Block', 'ta' => 'ராஜபாளையம் ஒன்றியம்'],
            ['code' => 'BLK-SVL', 'en' => 'Srivilliputhur Block', 'ta' => 'ஸ்ரீவில்லிபுத்தூர் ஒன்றியம்'],
            ['code' => 'BLK-WTR', 'en' => 'Watrap Block', 'ta' => 'வத்திராயிருப்பு ஒன்றியம்'],
            ['code' => 'BLK-APK', 'en' => 'Aruppukkottai Block', 'ta' => 'அருப்புக்கோட்டை ஒன்றியம்'],
            ['code' => 'BLK-STR', 'en' => 'Sattur Block', 'ta' => 'சாத்தூர் ஒன்றியம்'],
            ['code' => 'BLK-KRP', 'en' => 'Kariapatti Block', 'ta' => 'காரியாபட்டி ஒன்றியம்'],
            ['code' => 'BLK-TCL', 'en' => 'Tiruchuli Block', 'ta' => 'திருச்சுழி ஒன்றியம்'],
            ['code' => 'BLK-VBK', 'en' => 'Vembakottai Block', 'ta' => 'வெம்பக்கோட்டை ஒன்றியம்'],
            ['code' => 'BLK-NRK', 'en' => 'Narikudi Block', 'ta' => 'நரிக்குடி ஒன்றியம்'],
        ];

        $createdBlocks = [];
        foreach ($blocksData as $b) {
            $createdBlocks[$b['en']] = DevelopmentBlock::create([
                'district_id' => $district->id,
                'code' => $b['code'],
                'name_en' => $b['en'],
                'name_ta' => $b['ta'],
                'is_active' => true,
            ]);
        }

        // Sample Village Panchayats for Virudhunagar & Sivakasi Blocks
        $panchayatsData = [
            'Virudhunagar Block' => [
                ['code' => 'VP-VNR-01', 'en' => 'Kooraikundu Panchayat', 'ta' => 'கூரைக்குண்டு ஊராட்சி'],
                ['code' => 'VP-VNR-02', 'en' => 'Rosalpatti Panchayat', 'ta' => 'ரோசல்பட்டி ஊராட்சி'],
                ['code' => 'VP-VNR-03', 'en' => 'Pavali Panchayat', 'ta' => 'பாவாலி ஊராட்சி'],
            ],
            'Sivakasi Block' => [
                ['code' => 'VP-SVI-01', 'en' => 'Viswanatham Panchayat', 'ta' => 'விஸ்வநத்தம் ஊராட்சி'],
                ['code' => 'VP-SVI-02', 'en' => 'Sithurajapuram Panchayat', 'ta' => 'சித்துராஜபுரம் ஊராட்சி'],
                ['code' => 'VP-SVI-03', 'en' => 'Vilampatti Panchayat', 'ta' => 'விளம்பட்டி ஊராட்சி'],
            ]
        ];

        foreach ($panchayatsData as $blockName => $panchayats) {
            $blockModel = $createdBlocks[$blockName] ?? null;
            if ($blockModel) {
                foreach ($panchayats as $p) {
                    VillagePanchayat::create([
                        'development_block_id' => $blockModel->id,
                        'code' => $p['code'],
                        'name_en' => $p['en'],
                        'name_ta' => $p['ta'],
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Municipalities & Corporations
        $municipalitiesData = [
            ['code' => 'MUN-SVI', 'en' => 'Sivakasi Municipal Corporation', 'ta' => 'சிவகாசி மாநகராட்சி', 'type' => 'Corporation'],
            ['code' => 'MUN-RJP', 'en' => 'Rajapalayam Municipality', 'ta' => 'ராஜபாளையம் நகராட்சி', 'type' => 'Selection Grade'],
            ['code' => 'MUN-VNR', 'en' => 'Virudhunagar Municipality', 'ta' => 'விருதுநகர் நகராட்சி', 'type' => 'Selection Grade'],
            ['code' => 'MUN-APK', 'en' => 'Aruppukkottai Municipality', 'ta' => 'அருப்புக்கோட்டை நகராட்சி', 'type' => 'First Grade'],
            ['code' => 'MUN-SVL', 'en' => 'Srivilliputhur Municipality', 'ta' => 'ஸ்ரீவில்லிபுத்தூர் நகராட்சி', 'type' => 'First Grade'],
            ['code' => 'MUN-STR', 'en' => 'Sattur Municipality', 'ta' => 'சாத்தூர் நகராட்சி', 'type' => 'Second Grade'],
        ];

        foreach ($municipalitiesData as $m) {
            $mun = Municipality::create([
                'district_id' => $district->id,
                'code' => $m['code'],
                'name_en' => $m['en'],
                'name_ta' => $m['ta'],
                'type' => $m['type'],
                'is_active' => true,
            ]);

            // Add sample wards for Virudhunagar & Sivakasi
            if (in_array($m['code'], ['MUN-VNR', 'MUN-SVI'])) {
                for ($w = 1; $w <= 10; $w++) {
                    Ward::create([
                        'municipality_id' => $mun->id,
                        'ward_number' => (string)$w,
                        'name_en' => "Ward No. {$w}",
                        'name_ta' => "வார்டு எண் {$w}",
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Town Panchayats
        $townPanchayatsData = [
            ['code' => 'TP-KRP', 'en' => 'Kariapatti Town Panchayat', 'ta' => 'காரியாபட்டி பேரூராட்சி'],
            ['code' => 'TP-CHP', 'en' => 'Chettiarpatti Town Panchayat', 'ta' => 'செட்டியார்பட்டி பேரூராட்சி'],
            ['code' => 'TP-DLP', 'en' => 'Dhalavoipuram Town Panchayat', 'ta' => 'தளவாய்புரம் பேரூராட்சி'],
            ['code' => 'TP-MLK', 'en' => 'Mallankinaru Town Panchayat', 'ta' => 'மல்லாங்கிணறு பேரூராட்சி'],
            ['code' => 'TP-MSP', 'en' => 'Mamsapuram Town Panchayat', 'ta' => 'மம்சாபுரம் பேரூராட்சி'],
            ['code' => 'TP-STR', 'en' => 'Seithur Town Panchayat', 'ta' => 'சேத்தூர் பேரூராட்சி'],
            ['code' => 'TP-SDP', 'en' => 'Sundarapandiam Town Panchayat', 'ta' => 'சுந்தரபாண்டியம் பேரூராட்சி'],
            ['code' => 'TP-VPD', 'en' => 'V.Pudur Town Panchayat', 'ta' => 'வ.புதுார் பேரூராட்சி'],
            ['code' => 'TP-WPD', 'en' => 'W.Pudupatti Town Panchayat', 'ta' => 'மே.புதுப்பட்டி பேரூராட்சி'],
        ];

        foreach ($townPanchayatsData as $tp) {
            TownPanchayat::create([
                'district_id' => $district->id,
                'code' => $tp['code'],
                'name_en' => $tp['en'],
                'name_ta' => $tp['ta'],
                'is_active' => true,
            ]);
        }

        // 4. Complaint Categories
        $categoriesData = [
            [
                'code' => 'CAT-WAT',
                'name_en' => 'Drinking Water Supply',
                'name_ta' => 'குடிநீர் விநியோகம்',
                'description_en' => 'Irregular drinking water supply, pipeline leakages, contamination, borewell repair and overhead tank cleaning.',
                'description_ta' => 'குடிநீர் சீரற்ற விநியோகம், குழாய் உடைப்பு, அசுத்த நீர், ஆழ்துளை கிணறு பழுது மற்றும் மேல்நிலை நீர்த்தேக்க தொட்டி பராமரிப்பு.',
                'icon' => 'bi-droplet-half',
                'department_name_en' => 'TWAD Board & Municipal Water Works',
                'department_name_ta' => 'தமிழ்நாடு குடிநீர் வடிகால் வாரியம் மற்றும் நகராட்சி குடிநீர் பிரிவு',
                'sla_days' => 5,
            ],
            [
                'code' => 'CAT-SAN',
                'name_en' => 'Drainage and Sanitation',
                'name_ta' => 'சாக்கடை மற்றும் சுகாதாரம்',
                'description_en' => 'Clogged open drains, sewage overflow, stagnant waste water and drain maintenance.',
                'description_ta' => 'சாக்கடை அடைப்பு, கழிவுநீர் வெளியேறுதல், தேங்கிய அசுத்த நீர் மற்றும் வடிகால் பராமரிப்பு.',
                'icon' => 'bi-water',
                'department_name_en' => 'Public Health & Local Body Sanitation',
                'department_name_ta' => 'பொது சுகாதாரம் மற்றும் உள்ளாட்சி சுகாதார பிரிவு',
                'sla_days' => 3,
            ],
            [
                'code' => 'CAT-ROD',
                'name_en' => 'Roads and Street Maintenance',
                'name_ta' => 'சாலை மற்றும் தெரு பராமரிப்பு',
                'description_en' => 'Potholes, damaged tar/concrete roads, speed breakers and pavement repair.',
                'description_ta' => 'குண்டும் குழியுமான சாலைகள், சேதமடைந்த தார்/சிமெண்ட் சாலைகள் மற்றும் நடைபாதை சீரமைப்பு.',
                'icon' => 'bi-signpost-split',
                'department_name_en' => 'Highways & Rural Roads Department',
                'department_name_ta' => 'நெடுஞ்சாலை மற்றும் ஊரக சாலைகள் துறை',
                'sla_days' => 14,
            ],
            [
                'code' => 'CAT-LGT',
                'name_en' => 'Street Lighting',
                'name_ta' => 'தெருவிளக்கு பராமரிப்பு',
                'description_en' => 'Non-functioning street lights, faulty LED lights, broken poles and dark stretches.',
                'description_ta' => 'எரியாத தெருவிளக்குகள், பழுதான எல்.இ.டி விளக்குகள், உடைந்த கம்பங்கள் மற்றும் இருண்ட பகுதிகள்.',
                'icon' => 'bi-lightbulb',
                'department_name_en' => 'Local Body Electrical Wing',
                'department_name_ta' => 'உள்ளாட்சி மின்சாரப் பிரிவு',
                'sla_days' => 2,
            ],
            [
                'code' => 'CAT-ELE',
                'name_en' => 'Electricity & Power Supply',
                'name_ta' => 'மின்சாரம் மற்றும் மின்கட்டமைப்பு',
                'description_en' => 'Transformer sparks, hanging low-tension wires, power fluctuations and frequent power cuts.',
                'description_ta' => 'மின்மாற்றி தீப்பொறி, தாழ்வாக தொங்கும் மின்கம்பிகள், மின்னழுத்த குறைபாடு மற்றும் தொடர் மின்வெட்டு.',
                'icon' => 'bi-lightning-charge',
                'department_name_en' => 'TANGEDCO (Electricity Board)',
                'department_name_ta' => 'தமிழ்நாடு மின் உற்பத்தி மற்றும் பகிர்மானக் கழகம் (டான்ஜெட்கோ)',
                'sla_days' => 3,
            ],
            [
                'code' => 'CAT-WST',
                'name_en' => 'Solid Waste & Garbage Clearance',
                'name_ta' => 'குப்பை மேலாண்மை மற்றும் அகற்றுதல்',
                'description_en' => 'Uncleaned public dustbins, illegal garbage dumping and delayed doorstep collection.',
                'description_ta' => 'நிரம்பி வழியும் குப்பைத்தொட்டி, பொது இடங்களில் குப்பைக் குவிப்பு மற்றும் தினசரி குப்பை சேகரிப்பு தாமதம்.',
                'icon' => 'bi-trash3',
                'department_name_en' => 'Solid Waste Management Cell',
                'department_name_ta' => 'திடக்கழிவு மேலாண்மைப் பிரிவு',
                'sla_days' => 2,
            ],
            [
                'code' => 'CAT-HLT',
                'name_en' => 'Public Health & Mosquito Control',
                'name_ta' => 'பொது சுகாதாரம் மற்றும் கொசு ஒழிப்பு',
                'description_en' => 'Mosquito breeding spots, fogging requests, stray dog menace and public health hazards.',
                'description_ta' => 'கொசு பெருக்கம், புகைமருந்து தெளித்தல் கோரிக்கை, தெருநாய்கள் தொல்லை மற்றும் சுகாதார அபாயம்.',
                'icon' => 'bi-shield-plus',
                'department_name_en' => 'Deputy Director of Health Services',
                'department_name_ta' => 'சுகாதார பணிகள் துணை இயக்குனர் அலுவலகம்',
                'sla_days' => 4,
            ],
            [
                'code' => 'CAT-REV',
                'name_en' => 'Revenue & Land Matters',
                'name_ta' => 'வருவாய் மற்றும் நில நிர்வாகம்',
                'description_en' => 'Patta transfer delays, land survey, certificates and revenue assistance issues.',
                'description_ta' => 'பட்டா மாறுதல் தாமதம், நில அளவீடு, சான்றிதழ்கள் மற்றும் வருவாய்த்துறை உதவிகள்.',
                'icon' => 'bi-file-earmark-text',
                'department_name_en' => 'Revenue & Disaster Management',
                'department_name_ta' => 'வருவாய் மற்றும் பேரிடர் மேலாண்மைத் துறை',
                'sla_days' => 21,
            ],
            [
                'code' => 'CAT-PDS',
                'name_en' => 'Fair Price Shops / Ration (PDS)',
                'name_ta' => 'ரேஷன் கடை மற்றும் உணவுப்பொருள்',
                'description_en' => 'Ration shop functioning hours, stock irregularities, weighing anomalies and smart card issues.',
                'description_ta' => 'ரேஷன் கடை திறப்பு நேரம், பொருட்கள் தட்டுப்பாடு, எடை குறைவு மற்றும் ஸ்மார்ட் கார்டு சிக்கல்கள்.',
                'icon' => 'bi-basket2',
                'department_name_en' => 'Civil Supplies and Consumer Protection',
                'department_name_ta' => 'உணவுப்பொருள் வழங்கல் மற்றும் நுகர்வோர் பாதுகாப்புத் துறை',
                'sla_days' => 7,
            ],
            [
                'code' => 'CAT-ENC',
                'name_en' => 'Encroachment Removal',
                'name_ta' => 'ஆக்கிரமிப்பு அகற்றுதல்',
                'description_en' => 'Encroachment on public streets, water bodies, irrigation channels and government lands.',
                'description_ta' => 'பொதுத் தெரு, நீர்நிலைகள், பாசன வாய்க்கால்கள் மற்றும் அரசு புறம்போக்கு நில ஆக்கிரமிப்பு.',
                'icon' => 'bi-sign-stop',
                'department_name_en' => 'Revenue & Local Administration',
                'department_name_ta' => 'வருவாய்த்துறை மற்றும் உள்ளாட்சி நிர்வாகம்',
                'sla_days' => 30,
            ],
        ];

        $createdCategories = [];
        foreach ($categoriesData as $cat) {
            $createdCategories[] = ComplaintCategory::create($cat);
        }

        // 5. System Settings
        $settings = [
            ['key' => 'site_name_en', 'value' => 'குரலற்ற மகளின் குரல்', 'group' => 'general', 'description' => 'Portal Name in English'],
            ['key' => 'site_name_ta', 'value' => 'விருதுநகர் மக்கள் குரல்', 'group' => 'general', 'description' => 'Portal Name in Tamil'],
            ['key' => 'tagline_en', 'value' => 'Your Voice, Your Community, Your Development.', 'group' => 'general', 'description' => 'English Tagline'],
            ['key' => 'tagline_ta', 'value' => 'மக்களின் குரல், மக்களின் கோரிக்கை.', 'group' => 'general', 'description' => 'Tamil Tagline'],
            ['key' => 'contact_phone', 'value' => '+91 4562 252500', 'group' => 'contact', 'description' => 'Helpline Phone Number'],
            ['key' => 'contact_email', 'value' => 'kural@virudhunagar.org', 'group' => 'contact', 'description' => 'Portal Contact Email'],
            ['key' => 'office_address', 'value' => 'Civic Grievance Facilitation Center, Madurai Main Road, Virudhunagar - 626001', 'group' => 'contact', 'description' => 'Office Address'],
            ['key' => 'disclaimer_en', 'value' => 'குரலற்ற மகளின் குரல் is an independent civic-service grievance facilitation platform. It is not an official government agency and is dedicated to public welfare and civic coordination.', 'group' => 'legal', 'description' => 'Independent disclaimer'],
            ['key' => 'disclaimer_ta', 'value' => 'விருதுநகர் மக்கள் குரல் என்பது ஒரு சுயாதீன பொது சேவை குறைதீர்க்கும் தளம். இது எந்த ஒரு அரசுத் துறையின் நேரடி அதிகாரப்பூர்வ தளம் அல்ல; மக்கள் நலன் மற்றும் சமூக ஒருங்கிணைப்பிற்காக இயங்குகிறது.', 'group' => 'legal', 'description' => 'Tamil disclaimer'],
            ['key' => 'otp_enabled', 'value' => '1', 'group' => 'security', 'description' => 'OTP verification mode (1 = test/live OTP enabled)'],
        ];

        foreach ($settings as $s) {
            SystemSetting::create($s);
        }

        // 6. Public Updates / News
        PublicUpdate::create([
            'title_en' => 'Summer Drinking Water Pipeline Overhaul in Virudhunagar and Sattur',
            'title_ta' => 'விருதுநகர் மற்றும் சாத்தூரில் கோடை கால குடிநீர் குழாய் சீரமைப்பு பணிகள் தீவிரம்',
            'content_en' => 'The TWAD Board has commenced comprehensive desilting and pipeline enhancement works along the Vaigai water scheme to guarantee uninterrupted supply across Virudhunagar and Sattur municipalities during the approaching summer season.',
            'content_ta' => 'வருகின்ற கோடைகாலத்தில் விருதுநகர் மற்றும் சாத்தூர் நகராட்சி பகுதிகளில் தடையின்றி குடிநீர் வழங்குவதை உறுதி செய்யும் வகையில் வைகை குடிநீர் திட்ட பிரதான குழாய்களில் தூர்வாருதல் மற்றும் பராமரிப்பு பணிகள் முடுக்கிவிடப்பட்டுள்ளன.',
            'category' => 'Water Supply',
            'published_at' => Carbon::now()->subDays(2),
            'is_active' => true,
        ]);

        PublicUpdate::create([
            'title_en' => 'Sivakasi Ring Road & Drainage Decongestion Drive Underway',
            'title_ta' => 'சிவகாசி வெளிவட்டச் சாலை மற்றும் மழைநீர் வடிகால் சீரமைப்பு பணிகள் தொடக்கம்',
            'content_en' => 'Sivakasi City Corporation engineers have initiated major clearing of blocked arterial drains alongside the industrial corridor to avert seasonal waterlogging.',
            'content_ta' => 'சிவகாசி மாநகராட்சி சார்பில் தொழிற்பேட்டை இணைப்பு சாலைகள் மற்றும் பிரதான மழைநீர் வடிகால்களில் தூர்வாரும் பணிகள் முழுவீச்சில் நடைபெற்று வருகின்றன.',
            'category' => 'Infrastructure',
            'published_at' => Carbon::now()->subDays(5),
            'is_active' => true,
        ]);

        PublicUpdate::create([
            'title_en' => 'Special Dengue Prevention and Health Camps in Rajapalayam and Watrap',
            'title_ta' => 'ராஜபாளையம் மற்றும் வத்திராயிருப்பில் சிறப்பு டெங்கு தடுப்பு மற்றும் சுகாதார முகாம்கள்',
            'content_en' => 'Mobile medical teams and sanitary squads are conducting source reduction and intensive door-to-door fogging operations in high-risk taluks.',
            'content_ta' => 'ராஜபாளையம் மற்றும் வத்திராயிருப்பு வட்டாரங்களில் சுகாதாரத் துறை மூலம் கொசுப்புழு ஒழிப்பு மற்றும் வீடு வீடாக நிலவேம்பு குடிநீர் வழங்கும் சிறப்பு முகாம்கள் தொடங்கப்பட்டுள்ளன.',
            'category' => 'Public Health',
            'published_at' => Carbon::now()->subDays(7),
            'is_active' => true,
        ]);
    }
}
