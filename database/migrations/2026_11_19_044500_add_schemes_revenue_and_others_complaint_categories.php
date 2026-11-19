<?php

use App\Models\ComplaintCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            [
                'code' => 'CAT-REV',
                'name_en' => 'Revenue Department (Land, Patta & Certificates)',
                'name_ta' => 'வருவாய்த் துறை (பட்டா, நிலம் & சான்றிதழ்கள்)',
                'description_en' => 'Patta transfer delays, land survey, legal heir/income/caste certificates and revenue assistance issues.',
                'description_ta' => 'பட்டா மாறுதல் தாமதம், நில அளவீடு, வாரிசு/வருமானம்/சாதி சான்றிதழ்கள் மற்றும் வருவாய்த்துறை உதவிகள்.',
                'icon' => 'bi-file-earmark-text',
                'department_name_en' => 'Revenue Department',
                'department_name_ta' => 'வருவாய்த் துறை',
                'sla_days' => 14,
                'is_active' => true,
            ],
            [
                'code' => 'CAT-SCH',
                'name_en' => 'Government Schemes & Welfare Assistance',
                'name_ta' => 'அரசுத் திட்டங்கள் & நலத்திட்ட உதவிகள்',
                'description_en' => 'Central & State government welfare schemes, pensions, financial assistance, housing schemes and citizen subsidies.',
                'description_ta' => 'மத்திய மற்றும் மாநில அரசு நலத்திட்டங்கள், முதியோர்/விதவை உதவித்தொகை, மகளிர் உரிமைத்தொகை மற்றும் அரசு மானியங்கள் தொடர்பான கோரிக்கைகள்.',
                'icon' => 'bi-award',
                'department_name_en' => 'Social Welfare & Government Schemes Department',
                'department_name_ta' => 'சமூக நலத்துறை & அரசு திட்டங்கள் பிரிவு',
                'sla_days' => 15,
                'is_active' => true,
            ],
            [
                'code' => 'CAT-OTH',
                'name_en' => 'Others / Miscellaneous',
                'name_ta' => 'இதர புகார்கள் / பிற கோரிக்கைகள்',
                'description_en' => 'General public grievances, community requests and civic issues not covered under specific departments.',
                'description_ta' => 'பிற துறைகளில் வகைப்படுத்தப்படாத இதர பொது மக்கள் குறைதீர்ப்பு மற்றும் பொதுக் கோரிக்கைகள்.',
                'icon' => 'bi-three-dots',
                'department_name_en' => 'Public Grievance Redressal Cell',
                'department_name_ta' => 'பொது குறைதீர்ப்பு மற்றும் மக்கள் தொடர்பு பிரிவு',
                'sla_days' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            ComplaintCategory::updateOrCreate(
                ['code' => $cat['code']],
                $cat
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ComplaintCategory::whereIn('code', ['CAT-SCH', 'CAT-OTH'])->delete();
    }
};
