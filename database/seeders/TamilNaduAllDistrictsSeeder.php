<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\RevenueDivision;
use App\Models\Taluk;
use Illuminate\Database\Seeder;

class TamilNaduAllDistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districtsData = [
            [
                'code' => 'DT-ARI',
                'name_en' => 'Ariyalur',
                'name_ta' => 'அரியலூர்',
                'divisions' => [
                    [
                        'code' => 'RD-ARI-ARI',
                        'name_en' => 'Ariyalur',
                        'name_ta' => 'அரியலூர்',
                        'taluks' => [
                            ['code' => 'TLK-ARI-ARI', 'en' => 'Ariyalur', 'ta' => 'அரியலூர்'],
                            ['code' => 'TLK-ARI-AND', 'en' => 'Andimadam', 'ta' => 'ஆண்டிமடம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-ARI-UDY',
                        'name_en' => 'Udayarpalayam',
                        'name_ta' => 'உடையார்பாளையம்',
                        'taluks' => [
                            ['code' => 'TLK-ARI-SEN', 'en' => 'Sendurai', 'ta' => 'செந்துறை'],
                            ['code' => 'TLK-ARI-UDY', 'en' => 'Udayarpalayam', 'ta' => 'உடையார்பாளையம்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-CGL',
                'name_en' => 'Chengalpattu',
                'name_ta' => 'செங்கல்பட்டு',
                'divisions' => [
                    [
                        'code' => 'RD-CGL-CGL',
                        'name_en' => 'Chengalpattu',
                        'name_ta' => 'செங்கல்பட்டு',
                        'taluks' => [
                            ['code' => 'TLK-CGL-CGL', 'en' => 'Chengalpattu', 'ta' => 'செங்கல்பட்டு'],
                            ['code' => 'TLK-CGL-THK', 'en' => 'Thirukalukundram', 'ta' => 'திருவக்கழுக்குன்றம்'],
                            ['code' => 'TLK-CGL-TPR', 'en' => 'Tiruporur', 'ta' => 'திருப்போரூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CGL-MDR',
                        'name_en' => 'Madurantakam',
                        'name_ta' => 'மதுராந்தகம்',
                        'taluks' => [
                            ['code' => 'TLK-CGL-CHY', 'en' => 'Cheyyur', 'ta' => 'செய்யூர்'],
                            ['code' => 'TLK-CGL-MDR', 'en' => 'Madurantakam', 'ta' => 'மதுராந்தகம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CGL-TMB',
                        'name_en' => 'Tambaram',
                        'name_ta' => 'தாம்பரம்',
                        'taluks' => [
                            ['code' => 'TLK-CGL-PLV', 'en' => 'Pallavaram', 'ta' => 'பல்லாவரம்'],
                            ['code' => 'TLK-CGL-TMB', 'en' => 'Tambaram', 'ta' => 'தாம்பரம்'],
                            ['code' => 'TLK-CGL-VDL', 'en' => 'Vandalur', 'ta' => 'வண்டலூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-CHN',
                'name_en' => 'Chennai',
                'name_ta' => 'சென்னை',
                'divisions' => [
                    [
                        'code' => 'RD-CHN-NOR',
                        'name_en' => 'Chennai North',
                        'name_ta' => 'வட சென்னை',
                        'taluks' => [
                            ['code' => 'TLK-CHN-TVT', 'en' => 'Thiruvottriyur', 'ta' => 'திருவொற்றியூர்'],
                            ['code' => 'TLK-CHN-TND', 'en' => 'Tondiarpet', 'ta' => 'தண்டையார்பேட்டை'],
                            ['code' => 'TLK-CHN-MDV', 'en' => 'Madhavaram', 'ta' => 'மாதவரம்'],
                            ['code' => 'TLK-CHN-PRB', 'en' => 'Perambur', 'ta' => 'பெரம்பூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CHN-CEN',
                        'name_en' => 'Chennai Central',
                        'name_ta' => 'மத்திய சென்னை',
                        'taluks' => [
                            ['code' => 'TLK-CHN-AMB', 'en' => 'Ambattur', 'ta' => 'அம்பத்தூர்'],
                            ['code' => 'TLK-CHN-AYN', 'en' => 'Ayanavaram', 'ta' => 'அயனாவரம்'],
                            ['code' => 'TLK-CHN-EGM', 'en' => 'Egmore', 'ta' => 'எழும்பூர்'],
                            ['code' => 'TLK-CHN-AMJ', 'en' => 'Aminjikarai', 'ta' => 'அமைந்தகரை'],
                            ['code' => 'TLK-CHN-PRS', 'en' => 'Purasavakkam', 'ta' => 'புரசைவாக்கம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CHN-SOU',
                        'name_en' => 'Chennai South',
                        'name_ta' => 'தென் சென்னை',
                        'taluks' => [
                            ['code' => 'TLK-CHN-GDY', 'en' => 'Guindy', 'ta' => 'கிண்டி'],
                            ['code' => 'TLK-CHN-MBL', 'en' => 'Mambalam', 'ta' => 'மாம்பலம்'],
                            ['code' => 'TLK-CHN-MYL', 'en' => 'Mylapore', 'ta' => 'மயிலாப்பூர்'],
                            ['code' => 'TLK-CHN-ALN', 'en' => 'Alandur', 'ta' => 'ஆலந்தூர்'],
                            ['code' => 'TLK-CHN-SHL', 'en' => 'Sholinganallur', 'ta' => 'சோழிங்கநல்லூர்'],
                            ['code' => 'TLK-CHN-VEL', 'en' => 'Velachery', 'ta' => 'வேளச்சேரி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-CBE',
                'name_en' => 'Coimbatore',
                'name_ta' => 'கோயம்புத்தூர்',
                'divisions' => [
                    [
                        'code' => 'RD-CBE-NOR',
                        'name_en' => 'Coimbatore North',
                        'name_ta' => 'வட கோயம்புத்தூர்',
                        'taluks' => [
                            ['code' => 'TLK-CBE-NOR', 'en' => 'Coimbatore North', 'ta' => 'வட கோயம்புத்தூர்'],
                            ['code' => 'TLK-CBE-ANR', 'en' => 'Annur', 'ta' => 'அன்னூர்'],
                            ['code' => 'TLK-CBE-MTP', 'en' => 'Mettupalayam', 'ta' => 'மேட்டுப்பாளையம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CBE-SOU',
                        'name_en' => 'Coimbatore South',
                        'name_ta' => 'தென் கோயம்புத்தூர்',
                        'taluks' => [
                            ['code' => 'TLK-CBE-SOU', 'en' => 'Coimbatore South', 'ta' => 'தென் கோயம்புத்தூர்'],
                            ['code' => 'TLK-CBE-MDK', 'en' => 'Madukkarai', 'ta' => 'மதுக்கரை'],
                            ['code' => 'TLK-CBE-PRR', 'en' => 'Perur', 'ta' => 'பேரூர்'],
                            ['code' => 'TLK-CBE-SLR', 'en' => 'Sulur', 'ta' => 'சூலூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CBE-POL',
                        'name_en' => 'Pollachi',
                        'name_ta' => 'பொள்ளாச்சி',
                        'taluks' => [
                            ['code' => 'TLK-CBE-POL', 'en' => 'Pollachi', 'ta' => 'பொள்ளாச்சி'],
                            ['code' => 'TLK-CBE-ANM', 'en' => 'Anamalai', 'ta' => 'ஆனைமலை'],
                            ['code' => 'TLK-CBE-KNT', 'en' => 'Kinathukadavu', 'ta' => 'கிணத்துக்கடவு'],
                            ['code' => 'TLK-CBE-VLP', 'en' => 'Valparai', 'ta' => 'வால்பாறை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-CUD',
                'name_en' => 'Cuddalore',
                'name_ta' => 'கடலூர்',
                'divisions' => [
                    [
                        'code' => 'RD-CUD-CUD',
                        'name_en' => 'Cuddalore',
                        'name_ta' => 'கடலூர்',
                        'taluks' => [
                            ['code' => 'TLK-CUD-CUD', 'en' => 'Cuddalore', 'ta' => 'கடலூர்'],
                            ['code' => 'TLK-CUD-KPJ', 'en' => 'Kurinjipadi', 'ta' => 'குறிஞ்சிப்பாடி'],
                            ['code' => 'TLK-CUD-PNR', 'en' => 'Panruti', 'ta' => 'பண்ருட்டி'],
                        ],
                    ],
                    [
                        'code' => 'RD-CUD-CHB',
                        'name_en' => 'Chidambaram',
                        'name_ta' => 'சிதம்பரம்',
                        'taluks' => [
                            ['code' => 'TLK-CUD-CHB', 'en' => 'Chidambaram', 'ta' => 'சிதம்பரம்'],
                            ['code' => 'TLK-CUD-BHV', 'en' => 'Bhuvanagiri', 'ta' => 'புவனகிரி'],
                            ['code' => 'TLK-CUD-KMK', 'en' => 'Kattumannarkoil', 'ta' => 'காட்டுமன்னார்கோவில்'],
                            ['code' => 'TLK-CUD-SRM', 'en' => 'Srimushnam', 'ta' => 'ஸ்ரீமுஷ்ணம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-CUD-VDC',
                        'name_en' => 'Virudhachalam',
                        'name_ta' => 'விருத்தாசலம்',
                        'taluks' => [
                            ['code' => 'TLK-CUD-VDC', 'en' => 'Virudhachalam', 'ta' => 'விருத்தாசலம்'],
                            ['code' => 'TLK-CUD-TTK', 'en' => 'Thittakudi', 'ta' => 'திட்டக்குடி'],
                            ['code' => 'TLK-CUD-VPR', 'en' => 'Veppur', 'ta' => 'வேப்பூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-DPI',
                'name_en' => 'Dharmapuri',
                'name_ta' => 'தருமபுரி',
                'divisions' => [
                    [
                        'code' => 'RD-DPI-DPI',
                        'name_en' => 'Dharmapuri',
                        'name_ta' => 'தருமபுரி',
                        'taluks' => [
                            ['code' => 'TLK-DPI-DPI', 'en' => 'Dharmapuri', 'ta' => 'தருமபுரி'],
                            ['code' => 'TLK-DPI-KRM', 'en' => 'Karimangalam', 'ta' => 'காரிமங்கலம்'],
                            ['code' => 'TLK-DPI-NLP', 'en' => 'Nallampalli', 'ta' => 'நல்லம்பள்ளி'],
                            ['code' => 'TLK-DPI-PLC', 'en' => 'Palacode', 'ta' => 'பாலக்கோடு'],
                            ['code' => 'TLK-DPI-PNG', 'en' => 'Pennagaram', 'ta' => 'பென்னாகரம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-DPI-HAR',
                        'name_en' => 'Harur',
                        'name_ta' => 'அரூர்',
                        'taluks' => [
                            ['code' => 'TLK-DPI-HAR', 'en' => 'Harur', 'ta' => 'அரூர்'],
                            ['code' => 'TLK-DPI-PPR', 'en' => 'Pappireddipatti', 'ta' => 'பாப்பிரெட்டிப்பட்டி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-DGL',
                'name_en' => 'Dindigul',
                'name_ta' => 'திண்டுக்கல்',
                'divisions' => [
                    [
                        'code' => 'RD-DGL-DGL',
                        'name_en' => 'Dindigul',
                        'name_ta' => 'திண்டுக்கல்',
                        'taluks' => [
                            ['code' => 'TLK-DGL-EAS', 'en' => 'Dindigul East', 'ta' => 'திண்டுக்கல் கிழக்கு'],
                            ['code' => 'TLK-DGL-WES', 'en' => 'Dindigul West', 'ta' => 'திண்டுக்கல் மேற்கு'],
                            ['code' => 'TLK-DGL-ATH', 'en' => 'Athoor', 'ta' => 'ஆத்தூர்'],
                            ['code' => 'TLK-DGL-NTM', 'en' => 'Natham', 'ta' => 'நத்தம்'],
                            ['code' => 'TLK-DGL-NLK', 'en' => 'Nilakottai', 'ta' => 'நிலக்கோட்டை'],
                        ],
                    ],
                    [
                        'code' => 'RD-DGL-PLN',
                        'name_en' => 'Palani',
                        'name_ta' => 'பழனி',
                        'taluks' => [
                            ['code' => 'TLK-DGL-PLN', 'en' => 'Palani', 'ta' => 'பழனி'],
                            ['code' => 'TLK-DGL-ODC', 'en' => 'Oddanchatram', 'ta' => 'ஒட்டன்சத்திரம்'],
                            ['code' => 'TLK-DGL-VDS', 'en' => 'Vedasandur', 'ta' => 'வேடசந்தூர்'],
                            ['code' => 'TLK-DGL-GZL', 'en' => 'Guziliyamparai', 'ta' => 'குஜிலியம்பாறை'],
                        ],
                    ],
                    [
                        'code' => 'RD-DGL-KDK',
                        'name_en' => 'Kodaikanal',
                        'name_ta' => 'கொடைக்கானல்',
                        'taluks' => [
                            ['code' => 'TLK-DGL-KDK', 'en' => 'Kodaikanal', 'ta' => 'கொடைக்கானல்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-ERD',
                'name_en' => 'Erode',
                'name_ta' => 'ஈரோடு',
                'divisions' => [
                    [
                        'code' => 'RD-ERD-ERD',
                        'name_en' => 'Erode',
                        'name_ta' => 'ஈரோடு',
                        'taluks' => [
                            ['code' => 'TLK-ERD-ERD', 'en' => 'Erode', 'ta' => 'ஈரோடு'],
                            ['code' => 'TLK-ERD-KDM', 'en' => 'Kodumudi', 'ta' => 'கொடுமுடி'],
                            ['code' => 'TLK-ERD-MDK', 'en' => 'Modakkurichi', 'ta' => 'மொடக்குறிச்சி'],
                            ['code' => 'TLK-ERD-PRD', 'en' => 'Perundurai', 'ta' => 'பெருந்துறை'],
                        ],
                    ],
                    [
                        'code' => 'RD-ERD-GOB',
                        'name_en' => 'Gobichettipalayam',
                        'name_ta' => 'கோபிசெட்டிபாளையம்',
                        'taluks' => [
                            ['code' => 'TLK-ERD-GOB', 'en' => 'Gobichettipalayam', 'ta' => 'கோபிசெட்டிபாளையம்'],
                            ['code' => 'TLK-ERD-ANT', 'en' => 'Anthiyur', 'ta' => 'அந்தியூர்'],
                            ['code' => 'TLK-ERD-BHV', 'en' => 'Bhavani', 'ta' => 'பவானி'],
                            ['code' => 'TLK-ERD-NMB', 'en' => 'Nambiyur', 'ta' => 'நம்பியூர்'],
                            ['code' => 'TLK-ERD-STM', 'en' => 'Sathyamangalam', 'ta' => 'சத்தியமங்கலம்'],
                            ['code' => 'TLK-ERD-THL', 'en' => 'Thalavadi', 'ta' => 'தளவாடி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-KLK',
                'name_en' => 'Kallakurichi',
                'name_ta' => 'கள்ளக்குறிச்சி',
                'divisions' => [
                    [
                        'code' => 'RD-KLK-KLK',
                        'name_en' => 'Kallakurichi',
                        'name_ta' => 'கள்ளக்குறிச்சி',
                        'taluks' => [
                            ['code' => 'TLK-KLK-KLK', 'en' => 'Kallakurichi', 'ta' => 'கள்ளக்குறிச்சி'],
                            ['code' => 'TLK-KLK-CNS', 'en' => 'Chinnasalem', 'ta' => 'சின்னசேலம்'],
                            ['code' => 'TLK-KLK-KVH', 'en' => 'Kalvarayan Hills', 'ta' => 'கல்வராயன் மலை'],
                            ['code' => 'TLK-KLK-SKP', 'en' => 'Sankarapuram', 'ta' => 'சங்கராபுரம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-KLK-TRK',
                        'name_en' => 'Tirukoilur',
                        'name_ta' => 'திருக்கோவிலூர்',
                        'taluks' => [
                            ['code' => 'TLK-KLK-TRK', 'en' => 'Tirukoilur', 'ta' => 'திருக்கோவிலூர்'],
                            ['code' => 'TLK-KLK-ULD', 'en' => 'Ulundurpet', 'ta' => 'உளுந்தூர்பேட்டை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-KCH',
                'name_en' => 'Kancheepuram',
                'name_ta' => 'காஞ்சிபுரம்',
                'divisions' => [
                    [
                        'code' => 'RD-KCH-KCH',
                        'name_en' => 'Kancheepuram',
                        'name_ta' => 'காஞ்சிபுரம்',
                        'taluks' => [
                            ['code' => 'TLK-KCH-KCH', 'en' => 'Kancheepuram', 'ta' => 'காஞ்சிபுரம்'],
                            ['code' => 'TLK-KCH-UTM', 'en' => 'Uthiramerur', 'ta' => 'உத்திரமேரூர்'],
                            ['code' => 'TLK-KCH-WLB', 'en' => 'Walajabad', 'ta' => 'வாலாஜாபாத்'],
                        ],
                    ],
                    [
                        'code' => 'RD-KCH-SPB',
                        'name_en' => 'Sriperumbudur',
                        'name_ta' => 'ஸ்ரீபெரும்புதூர்',
                        'taluks' => [
                            ['code' => 'TLK-KCH-SPB', 'en' => 'Sriperumbudur', 'ta' => 'ஸ்ரீபெரும்புதூர்'],
                            ['code' => 'TLK-KCH-KND', 'en' => 'Kundrathur', 'ta' => 'குன்றத்தூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-KKI',
                'name_en' => 'Kanniyakumari',
                'name_ta' => 'கன்னியாகுமரி',
                'divisions' => [
                    [
                        'code' => 'RD-KKI-NGC',
                        'name_en' => 'Nagercoil',
                        'name_ta' => 'நாகர்கோவில்',
                        'taluks' => [
                            ['code' => 'TLK-KKI-AGT', 'en' => 'Agasteeswaram', 'ta' => 'அகத்தீஸ்வரம்'],
                            ['code' => 'TLK-KKI-THV', 'en' => 'Thovalai', 'ta' => 'தோவாளை'],
                        ],
                    ],
                    [
                        'code' => 'RD-KKI-PMB',
                        'name_en' => 'Padmanabhapuram',
                        'name_ta' => 'பத்மநாபபுரம்',
                        'taluks' => [
                            ['code' => 'TLK-KKI-KLK', 'en' => 'Kalkulam', 'ta' => 'கல்குளம்'],
                            ['code' => 'TLK-KKI-KLY', 'en' => 'Killiyoor', 'ta' => 'கிள்ளியூர்'],
                            ['code' => 'TLK-KKI-VLV', 'en' => 'Vilavancode', 'ta' => 'விளவங்கோடு'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-KRR',
                'name_en' => 'Karur',
                'name_ta' => 'கரூர்',
                'divisions' => [
                    [
                        'code' => 'RD-KRR-KRR',
                        'name_en' => 'Karur',
                        'name_ta' => 'கரூர்',
                        'taluks' => [
                            ['code' => 'TLK-KRR-KRR', 'en' => 'Karur', 'ta' => 'கரூர்'],
                            ['code' => 'TLK-KRR-ARV', 'en' => 'Aravakurichi', 'ta' => 'அரவக்குறிச்சி'],
                            ['code' => 'TLK-KRR-MNM', 'en' => 'Manmangalam', 'ta' => 'மண்மங்கலம்'],
                            ['code' => 'TLK-KRR-PGL', 'en' => 'Pugalur', 'ta' => 'புகழூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-KRR-KLT',
                        'name_en' => 'Kulithalai',
                        'name_ta' => 'குளித்தலை',
                        'taluks' => [
                            ['code' => 'TLK-KRR-KLT', 'en' => 'Kulithalai', 'ta' => 'குளித்தலை'],
                            ['code' => 'TLK-KRR-KRN', 'en' => 'Krishnarayapuram', 'ta' => 'கிருஷ்ணராயபுரம்'],
                            ['code' => 'TLK-KRR-KDV', 'en' => 'Kadavur', 'ta' => 'கடவூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-KRI',
                'name_en' => 'Krishnagiri',
                'name_ta' => 'கிருஷ்ணகிரி',
                'divisions' => [
                    [
                        'code' => 'RD-KRI-KRI',
                        'name_en' => 'Krishnagiri',
                        'name_ta' => 'கிருஷ்ணகிரி',
                        'taluks' => [
                            ['code' => 'TLK-KRI-KRI', 'en' => 'Krishnagiri', 'ta' => 'கிருஷ்ணகிரி'],
                            ['code' => 'TLK-KRI-BGR', 'en' => 'Bargur', 'ta' => 'பர்கூர்'],
                            ['code' => 'TLK-KRI-PCH', 'en' => 'Pochampalli', 'ta' => 'போச்சம்பள்ளி'],
                            ['code' => 'TLK-KRI-UTG', 'en' => 'Uthangarai', 'ta' => 'ஊத்தங்கரை'],
                        ],
                    ],
                    [
                        'code' => 'RD-KRI-HSR',
                        'name_en' => 'Hosur',
                        'name_ta' => 'ஓசூர்',
                        'taluks' => [
                            ['code' => 'TLK-KRI-HSR', 'en' => 'Hosur', 'ta' => 'ஓசூர்'],
                            ['code' => 'TLK-KRI-DNK', 'en' => 'Denkanikottai', 'ta' => 'தேன்கனிக்கோட்டை'],
                            ['code' => 'TLK-KRI-SHL', 'en' => 'Shoolagiri', 'ta' => 'சூளகிரி'],
                            ['code' => 'TLK-KRI-ANC', 'en' => 'Anchetty', 'ta' => 'அஞ்செட்டி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-MDU',
                'name_en' => 'Madurai',
                'name_ta' => 'மதுரை',
                'divisions' => [
                    [
                        'code' => 'RD-MDU-MDU',
                        'name_en' => 'Madurai',
                        'name_ta' => 'மதுரை',
                        'taluks' => [
                            ['code' => 'TLK-MDU-NOR', 'en' => 'Madurai North', 'ta' => 'மதுரை வடக்கு'],
                            ['code' => 'TLK-MDU-SOU', 'en' => 'Madurai South', 'ta' => 'மதுரை தெற்கு'],
                            ['code' => 'TLK-MDU-EAS', 'en' => 'Madurai East', 'ta' => 'மதுரை கிழக்கு'],
                            ['code' => 'TLK-MDU-WES', 'en' => 'Madurai West', 'ta' => 'மதுரை மேற்கு'],
                        ],
                    ],
                    [
                        'code' => 'RD-MDU-MLR',
                        'name_en' => 'Melur',
                        'name_ta' => 'மேலூர்',
                        'taluks' => [
                            ['code' => 'TLK-MDU-MLR', 'en' => 'Melur', 'ta' => 'மேலூர்'],
                            ['code' => 'TLK-MDU-VDP', 'en' => 'Vadipatti', 'ta' => 'வாடிப்பட்டி'],
                        ],
                    ],
                    [
                        'code' => 'RD-MDU-TMG',
                        'name_en' => 'Thirumangalam',
                        'name_ta' => 'திருமங்கலம்',
                        'taluks' => [
                            ['code' => 'TLK-MDU-TMG', 'en' => 'Thirumangalam', 'ta' => 'திருமங்கலம்'],
                            ['code' => 'TLK-MDU-KLG', 'en' => 'Kalligudi', 'ta' => 'கள்ளிக்குடி'],
                            ['code' => 'TLK-MDU-TPR', 'en' => 'Tirupparankundram', 'ta' => 'திருப்பரங்குன்றம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-MDU-USP',
                        'name_en' => 'Usilampatti',
                        'name_ta' => 'உசிலம்பட்டி',
                        'taluks' => [
                            ['code' => 'TLK-MDU-USP', 'en' => 'Usilampatti', 'ta' => 'உசிலம்பட்டி'],
                            ['code' => 'TLK-MDU-PRY', 'en' => 'Peraiyur', 'ta' => 'பேரையூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-MYL',
                'name_en' => 'Mayiladuthurai',
                'name_ta' => 'மயிலாடுதுறை',
                'divisions' => [
                    [
                        'code' => 'RD-MYL-MYL',
                        'name_en' => 'Mayiladuthurai',
                        'name_ta' => 'மயிலாடுதுறை',
                        'taluks' => [
                            ['code' => 'TLK-MYL-MYL', 'en' => 'Mayiladuthurai', 'ta' => 'மயிலாடுதுறை'],
                            ['code' => 'TLK-MYL-KTM', 'en' => 'Kuthalam', 'ta' => 'குத்தாலம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-MYL-SRK',
                        'name_en' => 'Sirkazhi',
                        'name_ta' => 'சீர்காழி',
                        'taluks' => [
                            ['code' => 'TLK-MYL-SRK', 'en' => 'Sirkazhi', 'ta' => 'சீர்காழி'],
                            ['code' => 'TLK-MYL-TRG', 'en' => 'Tharangambadi', 'ta' => 'தரங்கம்பாடி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-NGP',
                'name_en' => 'Nagapattinam',
                'name_ta' => 'நாகப்பட்டினம்',
                'divisions' => [
                    [
                        'code' => 'RD-NGP-NGP',
                        'name_en' => 'Nagapattinam',
                        'name_ta' => 'நாகப்பட்டினம்',
                        'taluks' => [
                            ['code' => 'TLK-NGP-NGP', 'en' => 'Nagapattinam', 'ta' => 'நாகப்பட்டினம்'],
                            ['code' => 'TLK-NGP-KLV', 'en' => 'Kilvelur', 'ta' => 'கீழ்வேளூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-NGP-VDR',
                        'name_en' => 'Vedaranyam',
                        'name_ta' => 'வேதாரண்யம்',
                        'taluks' => [
                            ['code' => 'TLK-NGP-VDR', 'en' => 'Vedaranyam', 'ta' => 'வேதாரண்யம்'],
                            ['code' => 'TLK-NGP-TKV', 'en' => 'Thirukkuvalai', 'ta' => 'திருக்குவளை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-NMK',
                'name_en' => 'Namakkal',
                'name_ta' => 'நாமக்கல்',
                'divisions' => [
                    [
                        'code' => 'RD-NMK-NMK',
                        'name_en' => 'Namakkal',
                        'name_ta' => 'நாமக்கல்',
                        'taluks' => [
                            ['code' => 'TLK-NMK-NMK', 'en' => 'Namakkal', 'ta' => 'நாமக்கல்'],
                            ['code' => 'TLK-NMK-MHN', 'en' => 'Mohanur', 'ta' => 'மோகனூர்'],
                            ['code' => 'TLK-NMK-RSP', 'en' => 'Rasipuram', 'ta' => 'ராசிபுரம்'],
                            ['code' => 'TLK-NMK-SNM', 'en' => 'Sendamangalam', 'ta' => 'சேந்தமங்கலம்'],
                            ['code' => 'TLK-NMK-KLH', 'en' => 'Kolli Hills', 'ta' => 'கொல்லிமலை'],
                        ],
                    ],
                    [
                        'code' => 'RD-NMK-TRC',
                        'name_en' => 'Tiruchengodu',
                        'name_ta' => 'திருச்செங்கோடு',
                        'taluks' => [
                            ['code' => 'TLK-NMK-TRC', 'en' => 'Tiruchengodu', 'ta' => 'திருச்செங்கோடு'],
                            ['code' => 'TLK-NMK-PMV', 'en' => 'Paramathi Velur', 'ta' => 'பரமத்தி வேலூர்'],
                            ['code' => 'TLK-NMK-KMP', 'en' => 'Komarapalayam', 'ta' => 'குமாரபாளையம்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-NIL',
                'name_en' => 'Nilgiris',
                'name_ta' => 'நீலகிரி',
                'divisions' => [
                    [
                        'code' => 'RD-NIL-UDH',
                        'name_en' => 'Udhagamandalam',
                        'name_ta' => 'உதகமண்டலம்',
                        'taluks' => [
                            ['code' => 'TLK-NIL-UDH', 'en' => 'Udhagamandalam', 'ta' => 'உதகமண்டலம்'],
                            ['code' => 'TLK-NIL-KND', 'en' => 'Kundah', 'ta' => 'குந்தா'],
                        ],
                    ],
                    [
                        'code' => 'RD-NIL-CNR',
                        'name_en' => 'Coonoor',
                        'name_ta' => 'குன்னூர்',
                        'taluks' => [
                            ['code' => 'TLK-NIL-CNR', 'en' => 'Coonoor', 'ta' => 'குன்னூர்'],
                            ['code' => 'TLK-NIL-KTG', 'en' => 'Kotagiri', 'ta' => 'கோத்தகிரி'],
                        ],
                    ],
                    [
                        'code' => 'RD-NIL-GDL',
                        'name_en' => 'Gudalur',
                        'name_ta' => 'கூடலூர்',
                        'taluks' => [
                            ['code' => 'TLK-NIL-GDL', 'en' => 'Gudalur', 'ta' => 'கூடலூர்'],
                            ['code' => 'TLK-NIL-PDL', 'en' => 'Pandalur', 'ta' => 'பந்தலூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-PBL',
                'name_en' => 'Perambalur',
                'name_ta' => 'பெரம்பலூர்',
                'divisions' => [
                    [
                        'code' => 'RD-PBL-PBL',
                        'name_en' => 'Perambalur',
                        'name_ta' => 'பெரம்பலூர்',
                        'taluks' => [
                            ['code' => 'TLK-PBL-PBL', 'en' => 'Perambalur', 'ta' => 'பெரம்பலூர்'],
                            ['code' => 'TLK-PBL-ALT', 'en' => 'Alathur', 'ta' => 'ஆலத்தூர்'],
                            ['code' => 'TLK-PBL-KNM', 'en' => 'Kunnam', 'ta' => 'குன்னம்'],
                            ['code' => 'TLK-PBL-VPT', 'en' => 'Veppanthattai', 'ta' => 'வேப்பந்தட்டை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-PDK',
                'name_en' => 'Pudukkottai',
                'name_ta' => 'புதுக்கோட்டை',
                'divisions' => [
                    [
                        'code' => 'RD-PDK-PDK',
                        'name_en' => 'Pudukkottai',
                        'name_ta' => 'புதுக்கோட்டை',
                        'taluks' => [
                            ['code' => 'TLK-PDK-PDK', 'en' => 'Pudukkottai', 'ta' => 'புதுக்கோட்டை'],
                            ['code' => 'TLK-PDK-ALG', 'en' => 'Alangudi', 'ta' => 'ஆலங்குடி'],
                            ['code' => 'TLK-PDK-GDK', 'en' => 'Gandarvakottai', 'ta' => 'கந்தர்வக்கோட்டை'],
                            ['code' => 'TLK-PDK-TVR', 'en' => 'Thiruvarankulam', 'ta' => 'திருவரங்குளம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-PDK-ART',
                        'name_en' => 'Aranthangi',
                        'name_ta' => 'அறந்தாங்கி',
                        'taluks' => [
                            ['code' => 'TLK-PDK-ART', 'en' => 'Aranthangi', 'ta' => 'அறந்தாங்கி'],
                            ['code' => 'TLK-PDK-AVD', 'en' => 'Avadaiyarkoil', 'ta' => 'ஆவுடையார்கோவில்'],
                            ['code' => 'TLK-PDK-MNM', 'en' => 'Manamelkudi', 'ta' => 'மணமேல்குடி'],
                        ],
                    ],
                    [
                        'code' => 'RD-PDK-ILP',
                        'name_en' => 'Illuppur',
                        'name_ta' => 'இலுப்பூர்',
                        'taluks' => [
                            ['code' => 'TLK-PDK-ILP', 'en' => 'Illuppur', 'ta' => 'இலுப்பூர்'],
                            ['code' => 'TLK-PDK-KLT', 'en' => 'Kulathur', 'ta' => 'குளத்தூர்'],
                            ['code' => 'TLK-PDK-PNM', 'en' => 'Ponnamaravathi', 'ta' => 'பொன்னமராவதி'],
                            ['code' => 'TLK-PDK-TRM', 'en' => 'Thirumayam', 'ta' => 'திருமயம்'],
                            ['code' => 'TLK-PDK-VRL', 'en' => 'Viralimalai', 'ta' => 'விராலிமலை'],
                            ['code' => 'TLK-PDK-KRB', 'en' => 'Karambakkudi', 'ta' => 'காரம்பக்குடி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-RMD',
                'name_en' => 'Ramanathapuram',
                'name_ta' => 'இராமநாதபுரம்',
                'divisions' => [
                    [
                        'code' => 'RD-RMD-RMD',
                        'name_en' => 'Ramanathapuram',
                        'name_ta' => 'இராமநாதபுரம்',
                        'taluks' => [
                            ['code' => 'TLK-RMD-RMD', 'en' => 'Ramanathapuram', 'ta' => 'இராமநாதபுரம்'],
                            ['code' => 'TLK-RMD-RMS', 'en' => 'Rameswaram', 'ta' => 'இராமேஸ்வரம்'],
                            ['code' => 'TLK-RMD-TVD', 'en' => 'Tiruvadanai', 'ta' => 'திருவாடானை'],
                            ['code' => 'TLK-RMD-RSM', 'en' => 'R.S. Mangalam', 'ta' => 'ஆர்.எஸ். மங்கலம்'],
                            ['code' => 'TLK-RMD-KLK', 'en' => 'Kilakarai', 'ta' => 'கீழக்கரை'],
                        ],
                    ],
                    [
                        'code' => 'RD-RMD-PMK',
                        'name_en' => 'Paramakudi',
                        'name_ta' => 'பரமக்குடி',
                        'taluks' => [
                            ['code' => 'TLK-RMD-PMK', 'en' => 'Paramakudi', 'ta' => 'பரமக்குடி'],
                            ['code' => 'TLK-RMD-KMT', 'en' => 'Kamuthi', 'ta' => 'கமுதி'],
                            ['code' => 'TLK-RMD-KDL', 'en' => 'Kadaladi', 'ta' => 'கடலாடி'],
                            ['code' => 'TLK-RMD-MDK', 'en' => 'Mudukulathur', 'ta' => 'முதுகுளத்தூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-RPT',
                'name_en' => 'Ranipet',
                'name_ta' => 'ராணிப்பேட்டை',
                'divisions' => [
                    [
                        'code' => 'RD-RPT-RPT',
                        'name_en' => 'Ranipet',
                        'name_ta' => 'ராணிப்பேட்டை',
                        'taluks' => [
                            ['code' => 'TLK-RPT-WLJ', 'en' => 'Walajah', 'ta' => 'வாலாஜா'],
                            ['code' => 'TLK-RPT-ARC', 'en' => 'Arcot', 'ta' => 'ஆற்காடு'],
                            ['code' => 'TLK-RPT-KLV', 'en' => 'Kalavai', 'ta' => 'கலவை'],
                        ],
                    ],
                    [
                        'code' => 'RD-RPT-ARK',
                        'name_en' => 'Arakkonam',
                        'name_ta' => 'அரக்கோணம்',
                        'taluks' => [
                            ['code' => 'TLK-RPT-ARK', 'en' => 'Arakkonam', 'ta' => 'அரக்கோணம்'],
                            ['code' => 'TLK-RPT-NML', 'en' => 'Nemili', 'ta' => 'நெமிலி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-SLM',
                'name_en' => 'Salem',
                'name_ta' => 'சேலம்',
                'divisions' => [
                    [
                        'code' => 'RD-SLM-SLM',
                        'name_en' => 'Salem',
                        'name_ta' => 'சேலம்',
                        'taluks' => [
                            ['code' => 'TLK-SLM-SLM', 'en' => 'Salem', 'ta' => 'சேலம்'],
                            ['code' => 'TLK-SLM-SOU', 'en' => 'Salem South', 'ta' => 'சேலம் தெற்கு'],
                            ['code' => 'TLK-SLM-WES', 'en' => 'Salem West', 'ta' => 'சேலம் மேற்கு'],
                            ['code' => 'TLK-SLM-YRC', 'en' => 'Yercaud', 'ta' => 'ஏற்காடு'],
                            ['code' => 'TLK-SLM-VLP', 'en' => 'Valapady', 'ta' => 'வாழப்பாடி'],
                        ],
                    ],
                    [
                        'code' => 'RD-SLM-ATT',
                        'name_en' => 'Attur',
                        'name_ta' => 'ஆத்தூர்',
                        'taluks' => [
                            ['code' => 'TLK-SLM-ATT', 'en' => 'Attur', 'ta' => 'ஆத்தூர்'],
                            ['code' => 'TLK-SLM-GGV', 'en' => 'Gangavalli', 'ta' => 'கங்கவள்ளி'],
                            ['code' => 'TLK-SLM-PTN', 'en' => 'Pethanaickenpalayam', 'ta' => 'பெத்தநாயக்கன்பாளையம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-SLM-MTR',
                        'name_en' => 'Mettur',
                        'name_ta' => 'மேட்டூர்',
                        'taluks' => [
                            ['code' => 'TLK-SLM-MTR', 'en' => 'Mettur', 'ta' => 'மேட்டூர்'],
                            ['code' => 'TLK-SLM-OML', 'en' => 'Omalur', 'ta' => 'ஓமலூர்'],
                            ['code' => 'TLK-SLM-KDP', 'en' => 'Kadayampatti', 'ta' => 'காடையாம்பட்டி'],
                        ],
                    ],
                    [
                        'code' => 'RD-SLM-SNK',
                        'name_en' => 'Sankari',
                        'name_ta' => 'சங்ககிரி',
                        'taluks' => [
                            ['code' => 'TLK-SLM-SNK', 'en' => 'Sankari', 'ta' => 'சங்ககிரி'],
                            ['code' => 'TLK-SLM-EDP', 'en' => 'Edappadi', 'ta' => 'எடப்பாடி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-SVG',
                'name_en' => 'Sivaganga',
                'name_ta' => 'சிவகங்கை',
                'divisions' => [
                    [
                        'code' => 'RD-SVG-SVG',
                        'name_en' => 'Sivaganga',
                        'name_ta' => 'சிவகங்கை',
                        'taluks' => [
                            ['code' => 'TLK-SVG-SVG', 'en' => 'Sivaganga', 'ta' => 'சிவகங்கை'],
                            ['code' => 'TLK-SVG-MMD', 'en' => 'Manamadurai', 'ta' => 'மானாமதுரை'],
                            ['code' => 'TLK-SVG-ILG', 'en' => 'Ilayangudi', 'ta' => 'இளையான்குடி'],
                            ['code' => 'TLK-SVG-KLK', 'en' => 'Kalaiyarkovil', 'ta' => 'காளையார்கோவில்'],
                        ],
                    ],
                    [
                        'code' => 'RD-SVG-DVK',
                        'name_en' => 'Devakottai',
                        'name_ta' => 'தேவகோட்டை',
                        'taluks' => [
                            ['code' => 'TLK-SVG-DVK', 'en' => 'Devakottai', 'ta' => 'தேவகோட்டை'],
                            ['code' => 'TLK-SVG-KKD', 'en' => 'Karaikudi', 'ta' => 'காரைக்குடி'],
                            ['code' => 'TLK-SVG-TPT', 'en' => 'Tirupathur', 'ta' => 'திருப்பத்தூர்'],
                            ['code' => 'TLK-SVG-SGP', 'en' => 'Singampunari', 'ta' => 'சிங்கம்புணரி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TSI',
                'name_en' => 'Tenkasi',
                'name_ta' => 'தென்காசி',
                'divisions' => [
                    [
                        'code' => 'RD-TSI-TSI',
                        'name_en' => 'Tenkasi',
                        'name_ta' => 'தென்காசி',
                        'taluks' => [
                            ['code' => 'TLK-TSI-TSI', 'en' => 'Tenkasi', 'ta' => 'தென்காசி'],
                            ['code' => 'TLK-TSI-SGT', 'en' => 'Sengottai', 'ta' => 'செங்கோட்டை'],
                            ['code' => 'TLK-TSI-KDN', 'en' => 'Kadayanallur', 'ta' => 'கடையநல்லூர்'],
                            ['code' => 'TLK-TSI-ALN', 'en' => 'Alangulam', 'ta' => 'ஆலங்குளம்'],
                            ['code' => 'TLK-TSI-VKP', 'en' => 'Veerakeralamputhur', 'ta' => 'வீரகேரளம்புதூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TSI-SKV',
                        'name_en' => 'Sankarankovil',
                        'name_ta' => 'சங்கரன்கோவில்',
                        'taluks' => [
                            ['code' => 'TLK-TSI-SKV', 'en' => 'Sankarankovil', 'ta' => 'சங்கரன்கோவில்'],
                            ['code' => 'TLK-TSI-SVG', 'en' => 'Sivagiri', 'ta' => 'சிவSupport/Sivagiri'],
                            ['code' => 'TLK-TSI-TVG', 'en' => 'Thiruvengadam', 'ta' => 'திருவேங்கடம்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TNJ',
                'name_en' => 'Thanjavur',
                'name_ta' => 'தஞ்சாவூர்',
                'divisions' => [
                    [
                        'code' => 'RD-TNJ-TNJ',
                        'name_en' => 'Thanjavur',
                        'name_ta' => 'தஞ்சாவூர்',
                        'taluks' => [
                            ['code' => 'TLK-TNJ-TNJ', 'en' => 'Thanjavur', 'ta' => 'தஞ்சாவூர்'],
                            ['code' => 'TLK-TNJ-TVY', 'en' => 'Thiruvaiyaru', 'ta' => 'திருவையாறு'],
                            ['code' => 'TLK-TNJ-BDL', 'en' => 'Budalur', 'ta' => 'பூதலூர்'],
                            ['code' => 'TLK-TNJ-ORT', 'en' => 'Orathanadu', 'ta' => 'ஒரத்தநாடு'],
                        ],
                    ],
                    [
                        'code' => 'RD-TNJ-KMK',
                        'name_en' => 'Kumbakonam',
                        'name_ta' => 'கும்பகோணம்',
                        'taluks' => [
                            ['code' => 'TLK-TNJ-KMK', 'en' => 'Kumbakonam', 'ta' => 'கும்பகோணம்'],
                            ['code' => 'TLK-TNJ-PPN', 'en' => 'Papanasam', 'ta' => 'பாபநாசம்'],
                            ['code' => 'TLK-TNJ-TVD', 'en' => 'Thiruvidaimarudur', 'ta' => 'திருவிடைமருதூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TNJ-PTK',
                        'name_en' => 'Pattukkottai',
                        'name_ta' => 'பட்டுக்கோட்டை',
                        'taluks' => [
                            ['code' => 'TLK-TNJ-PTK', 'en' => 'Pattukkottai', 'ta' => 'பட்டுக்கோட்டை'],
                            ['code' => 'TLK-TNJ-PRV', 'en' => 'Peravurani', 'ta' => 'பேராவூரணி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-THN',
                'name_en' => 'Theni',
                'name_ta' => 'தேனி',
                'divisions' => [
                    [
                        'code' => 'RD-THN-PRK',
                        'name_en' => 'Periyakulam',
                        'name_ta' => 'பெரியகுளம்',
                        'taluks' => [
                            ['code' => 'TLK-THN-PRK', 'en' => 'Periyakulam', 'ta' => 'பெரியகுளம்'],
                            ['code' => 'TLK-THN-THN', 'en' => 'Theni', 'ta' => 'தேனி'],
                        ],
                    ],
                    [
                        'code' => 'RD-THN-UTM',
                        'name_en' => 'Uthamapalayam',
                        'name_ta' => 'உத்தமபாளையம்',
                        'taluks' => [
                            ['code' => 'TLK-THN-UTM', 'en' => 'Uthamapalayam', 'ta' => 'உத்தமபாளையம்'],
                            ['code' => 'TLK-THN-BDN', 'en' => 'Bodinayakanur', 'ta' => 'போடிநாயக்கனூர்'],
                            ['code' => 'TLK-THN-AND', 'en' => 'Andipatti', 'ta' => 'ஆண்டிபட்டி'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TUT',
                'name_en' => 'Thoothukudi',
                'name_ta' => 'தூத்துக்குடி',
                'divisions' => [
                    [
                        'code' => 'RD-TUT-TUT',
                        'name_en' => 'Thoothukudi',
                        'name_ta' => 'தூத்துக்குடி',
                        'taluks' => [
                            ['code' => 'TLK-TUT-TUT', 'en' => 'Thoothukudi', 'ta' => 'தூத்துக்குடி'],
                            ['code' => 'TLK-TUT-SVK', 'en' => 'Srivaikuntam', 'ta' => 'ஸ்ரீவைகுண்டம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TUT-KVP',
                        'name_en' => 'Kovilpatti',
                        'name_ta' => 'கோவில்பட்டி',
                        'taluks' => [
                            ['code' => 'TLK-TUT-KVP', 'en' => 'Kovilpatti', 'ta' => 'கோவில்பட்டி'],
                            ['code' => 'TLK-TUT-ETP', 'en' => 'Ettayapuram', 'ta' => 'எட்டயபுரம்'],
                            ['code' => 'TLK-TUT-VTK', 'en' => 'Vilathikulam', 'ta' => 'விளாத்திகுளம்'],
                            ['code' => 'TLK-TUT-OTP', 'en' => 'Ottapidaram', 'ta' => 'ஒட்டப்பிடாரம்'],
                            ['code' => 'TLK-TUT-KYT', 'en' => 'Kayathar', 'ta' => 'கயத்தாறு'],
                        ],
                    ],
                    [
                        'code' => 'RD-TUT-TCD',
                        'name_en' => 'Tiruchendur',
                        'name_ta' => 'திருச்செந்தூர்',
                        'taluks' => [
                            ['code' => 'TLK-TUT-TCD', 'en' => 'Tiruchendur', 'ta' => 'திருச்செந்தூர்'],
                            ['code' => 'TLK-TUT-STK', 'en' => 'Sathankulam', 'ta' => 'சாத்தான்குளம்'],
                            ['code' => 'TLK-TUT-ERL', 'en' => 'Eral', 'ta' => 'ஏரல்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TRY',
                'name_en' => 'Tiruchirappalli',
                'name_ta' => 'திருச்சிராப்பள்ளி',
                'divisions' => [
                    [
                        'code' => 'RD-TRY-TRY',
                        'name_en' => 'Tiruchirappalli',
                        'name_ta' => 'திருச்சிராப்பள்ளி',
                        'taluks' => [
                            ['code' => 'TLK-TRY-EAS', 'en' => 'Tiruchirappalli East', 'ta' => 'திருச்சிராப்பள்ளி கிழக்கு'],
                            ['code' => 'TLK-TRY-WES', 'en' => 'Tiruchirappalli West', 'ta' => 'திருச்சிராப்பள்ளி மேற்கு'],
                            ['code' => 'TLK-TRY-SRG', 'en' => 'Srirangam', 'ta' => 'ஸ்ரீரங்கம்'],
                            ['code' => 'TLK-TRY-TVR', 'en' => 'Thiruverumbur', 'ta' => 'திருவெறும்பூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TRY-LGD',
                        'name_en' => 'Lalgudi',
                        'name_ta' => 'லால்குடி',
                        'taluks' => [
                            ['code' => 'TLK-TRY-LGD', 'en' => 'Lalgudi', 'ta' => 'லால்குடி'],
                            ['code' => 'TLK-TRY-MNL', 'en' => 'Manachanallur', 'ta' => 'மண்ணச்சநல்லூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TRY-MNP',
                        'name_en' => 'Manapparai',
                        'name_ta' => 'மணப்பாறை',
                        'taluks' => [
                            ['code' => 'TLK-TRY-MNP', 'en' => 'Manapparai', 'ta' => 'மணப்பாறை'],
                            ['code' => 'TLK-TRY-MRG', 'en' => 'Marungapuri', 'ta' => 'மருங்காபுரி'],
                        ],
                    ],
                    [
                        'code' => 'RD-TRY-MSR',
                        'name_en' => 'Musiri',
                        'name_ta' => 'முசிறி',
                        'taluks' => [
                            ['code' => 'TLK-TRY-MSR', 'en' => 'Musiri', 'ta' => 'முசிறி'],
                            ['code' => 'TLK-TRY-TRY2', 'en' => 'Thuraiyur', 'ta' => 'துரையூர்'],
                            ['code' => 'TLK-TRY-TTY', 'en' => 'Thottiyam', 'ta' => 'தொட்டியம்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TIN',
                'name_en' => 'Tirunelveli',
                'name_ta' => 'திருநெல்வேலி',
                'divisions' => [
                    [
                        'code' => 'RD-TIN-TIN',
                        'name_en' => 'Tirunelveli',
                        'name_ta' => 'திருநெல்வேலி',
                        'taluks' => [
                            ['code' => 'TLK-TIN-TIN', 'en' => 'Tirunelveli', 'ta' => 'திருநெல்வேலி'],
                            ['code' => 'TLK-TIN-PLM', 'en' => 'Palayamkottai', 'ta' => 'பாளையங்கோட்டை'],
                            ['code' => 'TLK-TIN-MNR', 'en' => 'Manur', 'ta' => 'மானூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TIN-CRM',
                        'name_en' => 'Cheranmahadevi',
                        'name_ta' => 'சேரன்மகாதேவி',
                        'taluks' => [
                            ['code' => 'TLK-TIN-CRM', 'en' => 'Cheranmahadevi', 'ta' => 'சேரன்மகாதேவி'],
                            ['code' => 'TLK-TIN-AMB', 'en' => 'Ambasamudram', 'ta' => 'அம்பாசமுத்திரம்'],
                            ['code' => 'TLK-TIN-NGN', 'en' => 'Nanguneri', 'ta' => 'நாங்குநேரி'],
                            ['code' => 'TLK-TIN-RDP', 'en' => 'Radhapuram', 'ta' => 'ராதாபுரம்'],
                            ['code' => 'TLK-TIN-TSV', 'en' => 'Tisaiyanvilai', 'ta' => 'திசையன்விளை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TPR',
                'name_en' => 'Tirupattur',
                'name_ta' => 'திருப்பத்தூர்',
                'divisions' => [
                    [
                        'code' => 'RD-TPR-TPR',
                        'name_en' => 'Tirupattur',
                        'name_ta' => 'திருப்பத்தூர்',
                        'taluks' => [
                            ['code' => 'TLK-TPR-TPR', 'en' => 'Tirupattur', 'ta' => 'திருப்பத்தூர்'],
                            ['code' => 'TLK-TPR-NTR', 'en' => 'Natrampalli', 'ta' => 'நாட்ராம்பள்ளி'],
                        ],
                    ],
                    [
                        'code' => 'RD-TPR-VNY',
                        'name_en' => 'Vaniyambadi',
                        'name_ta' => 'வாணியம்பாடி',
                        'taluks' => [
                            ['code' => 'TLK-TPR-VNY', 'en' => 'Vaniyambadi', 'ta' => 'வாணியம்பாடி'],
                            ['code' => 'TLK-TPR-AMB', 'en' => 'Ambur', 'ta' => 'ஆம்பூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TPU',
                'name_en' => 'Tiruppur',
                'name_ta' => 'திருப்பூர்',
                'divisions' => [
                    [
                        'code' => 'RD-TPU-TPU',
                        'name_en' => 'Tiruppur',
                        'name_ta' => 'திருப்பூர்',
                        'taluks' => [
                            ['code' => 'TLK-TPU-NOR', 'en' => 'Tiruppur North', 'ta' => 'திருப்பூர் வடக்கு'],
                            ['code' => 'TLK-TPU-SOU', 'en' => 'Tiruppur South', 'ta' => 'திருப்பூர் தெற்கு'],
                            ['code' => 'TLK-TPU-AVN', 'en' => 'Avinashi', 'ta' => 'அவிநாசி'],
                            ['code' => 'TLK-TPU-PLD', 'en' => 'Palladam', 'ta' => 'பல்லடம்'],
                            ['code' => 'TLK-TPU-UTK', 'en' => 'Uthukuli', 'ta' => 'ஊத்துக்குளி'],
                        ],
                    ],
                    [
                        'code' => 'RD-TPU-DRP',
                        'name_en' => 'Dharapuram',
                        'name_ta' => 'தாராபுரம்',
                        'taluks' => [
                            ['code' => 'TLK-TPU-DRP', 'en' => 'Dharapuram', 'ta' => 'தாராபுரம்'],
                            ['code' => 'TLK-TPU-KNG', 'en' => 'Kangeyam', 'ta' => 'காங்கேயம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TPU-UDM',
                        'name_en' => 'Udumalaipettai',
                        'name_ta' => 'உடுமலைப்பேட்டை',
                        'taluks' => [
                            ['code' => 'TLK-TPU-UDM', 'en' => 'Udumalaipettai', 'ta' => 'உடுமலைப்பேட்டை'],
                            ['code' => 'TLK-TPU-MDT', 'en' => 'Madathukulam', 'ta' => 'மடத்துக்குளம்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TLR',
                'name_en' => 'Tiruvallur',
                'name_ta' => 'திருவள்ளூர்',
                'divisions' => [
                    [
                        'code' => 'RD-TLR-TLR',
                        'name_en' => 'Tiruvallur',
                        'name_ta' => 'திருவள்ளூர்',
                        'taluks' => [
                            ['code' => 'TLK-TLR-TLR', 'en' => 'Tiruvallur', 'ta' => 'திருவள்ளூர்'],
                            ['code' => 'TLK-TLR-PNM', 'en' => 'Poonamallee', 'ta' => 'பூந்தமல்லி'],
                            ['code' => 'TLK-TLR-AVD', 'en' => 'Avadi', 'ta' => 'ஆவடி'],
                        ],
                    ],
                    [
                        'code' => 'RD-TLR-PNR',
                        'name_en' => 'Ponneri',
                        'name_ta' => 'பொன்னேரி',
                        'taluks' => [
                            ['code' => 'TLK-TLR-PNR', 'en' => 'Ponneri', 'ta' => 'பொன்னேரி'],
                            ['code' => 'TLK-TLR-GMP', 'en' => 'Gummidipoondi', 'ta' => 'கும்மிடிப்பூண்டி'],
                        ],
                    ],
                    [
                        'code' => 'RD-TLR-TRT',
                        'name_en' => 'Tiruttani',
                        'name_ta' => 'திருத்தணி',
                        'taluks' => [
                            ['code' => 'TLK-TLR-TRT', 'en' => 'Tiruttani', 'ta' => 'திருத்தணி'],
                            ['code' => 'TLK-TLR-PLP', 'en' => 'Pallipattu', 'ta' => 'பள்ளிப்பட்டு'],
                            ['code' => 'TLK-TLR-RKP', 'en' => 'R.K. Pet', 'ta' => 'ஆர்.கே. பேட்டை'],
                            ['code' => 'TLK-TLR-UTK', 'en' => 'Uthukottai', 'ta' => 'ஊத்துக்கோட்டை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TVM',
                'name_en' => 'Tiruvannamalai',
                'name_ta' => 'திருவண்ணாமலை',
                'divisions' => [
                    [
                        'code' => 'RD-TVM-TVM',
                        'name_en' => 'Tiruvannamalai',
                        'name_ta' => 'திருவண்ணாமலை',
                        'taluks' => [
                            ['code' => 'TLK-TVM-TVM', 'en' => 'Tiruvannamalai', 'ta' => 'திருவண்ணாமலை'],
                            ['code' => 'TLK-TVM-CGM', 'en' => 'Chengam', 'ta' => 'செங்கம்'],
                            ['code' => 'TLK-TVM-KLP', 'en' => 'Kilpennathur', 'ta' => 'கீழ்பென்னாத்தூர்'],
                            ['code' => 'TLK-TVM-TDP', 'en' => 'Thandarampattu', 'ta' => 'தண்டராம்பட்டு'],
                        ],
                    ],
                    [
                        'code' => 'RD-TVM-ARN',
                        'name_en' => 'Arani',
                        'name_ta' => 'ஆரணி',
                        'taluks' => [
                            ['code' => 'TLK-TVM-ARN', 'en' => 'Arani', 'ta' => 'ஆரணி'],
                            ['code' => 'TLK-TVM-PLR', 'en' => 'Polur', 'ta' => 'போளூர்'],
                            ['code' => 'TLK-TVM-JMN', 'en' => 'Jamunamarathur', 'ta' => 'ஜமுனாமரத்தூர்'],
                            ['code' => 'TLK-TVM-CHT', 'en' => 'Chetpet', 'ta' => 'சேத்துப்பட்டு'],
                            ['code' => 'TLK-TVM-KLS', 'en' => 'Kalasapakkam', 'ta' => 'கலசப்பாக்கம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TVM-CHY',
                        'name_en' => 'Cheyyar',
                        'name_ta' => 'செய்யாறு',
                        'taluks' => [
                            ['code' => 'TLK-TVM-CHY', 'en' => 'Cheyyar', 'ta' => 'செய்யாறு'],
                            ['code' => 'TLK-TVM-VDV', 'en' => 'Vandavasi', 'ta' => 'வந்தவாசி'],
                            ['code' => 'TLK-TVM-VBK', 'en' => 'Vembakkam', 'ta' => 'வெம்பாக்கம்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-TVR',
                'name_en' => 'Tiruvarur',
                'name_ta' => 'திருவாரூர்',
                'divisions' => [
                    [
                        'code' => 'RD-TVR-TVR',
                        'name_en' => 'Tiruvarur',
                        'name_ta' => 'திருவாரூர்',
                        'taluks' => [
                            ['code' => 'TLK-TVR-TVR', 'en' => 'Tiruvarur', 'ta' => 'திருவாரூர்'],
                            ['code' => 'TLK-TVR-NNL', 'en' => 'Nannilam', 'ta' => 'நன்னிலம்'],
                            ['code' => 'TLK-TVR-KDV', 'en' => 'Kudavasal', 'ta' => 'குடவாசல்'],
                            ['code' => 'TLK-TVR-VLG', 'en' => 'Valangaiman', 'ta' => 'வலங்கைமான்'],
                        ],
                    ],
                    [
                        'code' => 'RD-TVR-MNG',
                        'name_en' => 'Mannargudi',
                        'name_ta' => 'மன்னார்குடி',
                        'taluks' => [
                            ['code' => 'TLK-TVR-MNG', 'en' => 'Mannargudi', 'ta' => 'மன்னார்குடி'],
                            ['code' => 'TLK-TVR-TTP', 'en' => 'Thiruthuraipoondi', 'ta' => 'திருத்துறைப்பூண்டி'],
                            ['code' => 'TLK-TVR-NDM', 'en' => 'Needamangalam', 'ta' => 'நீடாமங்கலம்'],
                            ['code' => 'TLK-TVR-MTP', 'en' => 'Muthupettai', 'ta' => 'முத்துப்பேட்டை'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-VEL',
                'name_en' => 'Vellore',
                'name_ta' => 'வேலூர்',
                'divisions' => [
                    [
                        'code' => 'RD-VEL-VEL',
                        'name_en' => 'Vellore',
                        'name_ta' => 'வேலூர்',
                        'taluks' => [
                            ['code' => 'TLK-VEL-VEL', 'en' => 'Vellore', 'ta' => 'வேலூர்'],
                            ['code' => 'TLK-VEL-KTP', 'en' => 'Katpadi', 'ta' => 'காட்பாடி'],
                            ['code' => 'TLK-VEL-ANC', 'en' => 'Anaicut', 'ta' => 'அணைக்கட்டு'],
                            ['code' => 'TLK-VEL-KVK', 'en' => 'K.V. Kuppam', 'ta' => 'கே.வி. குப்பம்'],
                        ],
                    ],
                    [
                        'code' => 'RD-VEL-GDY',
                        'name_en' => 'Gudiyatham',
                        'name_ta' => 'குடியாத்தம்',
                        'taluks' => [
                            ['code' => 'TLK-VEL-GDY', 'en' => 'Gudiyatham', 'ta' => 'குடியாத்தம்'],
                            ['code' => 'TLK-VEL-PRN', 'en' => 'Pernambut', 'ta' => 'பேரணாம்பட்டு'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DT-VLP',
                'name_en' => 'Viluppuram',
                'name_ta' => 'விழுப்புரம்',
                'divisions' => [
                    [
                        'code' => 'RD-VLP-VLP',
                        'name_en' => 'Viluppuram',
                        'name_ta' => 'விழுப்புரம்',
                        'taluks' => [
                            ['code' => 'TLK-VLP-VLP', 'en' => 'Viluppuram', 'ta' => 'விழுப்புரம்'],
                            ['code' => 'TLK-VLP-VKR', 'en' => 'Vikravandi', 'ta' => 'விக்ரவாண்டி'],
                            ['code' => 'TLK-VLP-KDC', 'en' => 'Kandachipuram', 'ta' => 'கண்டாச்சிபுரம்'],
                            ['code' => 'TLK-VLP-TVN', 'en' => 'Thiruvennainallur', 'ta' => 'திருவெண்ணெய்நல்லூர்'],
                        ],
                    ],
                    [
                        'code' => 'RD-VLP-TDV',
                        'name_en' => 'Tindivanam',
                        'name_ta' => 'திண்டிவனம்',
                        'taluks' => [
                            ['code' => 'TLK-VLP-TDV', 'en' => 'Tindivanam', 'ta' => 'திண்டிவனம்'],
                            ['code' => 'TLK-VLP-GNG', 'en' => 'Gingee', 'ta' => 'செஞ்சி'],
                            ['code' => 'TLK-VLP-MRK', 'en' => 'Marakkanam', 'ta' => 'மரக்காணம்'],
                            ['code' => 'TLK-VLP-MLM', 'en' => 'Melmalayanur', 'ta' => 'மேல்மலையனூர்'],
                            ['code' => 'TLK-VLP-VNR', 'en' => 'Vanur', 'ta' => 'வானூர்'],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'VNR-3326',
                'name_en' => 'Virudhunagar',
                'name_ta' => 'விருதுநகர்',
                'divisions' => [
                    [
                        'code' => 'RD-SVI',
                        'name_en' => 'Sivakasi',
                        'name_ta' => 'சிவகாசி',
                        'taluks' => [
                            ['code' => 'TLK-SVI', 'en' => 'Sivakasi', 'ta' => 'சிவகாசி'],
                            ['code' => 'TLK-SVL', 'en' => 'Srivilliputtur', 'ta' => 'ஸ்ரீவில்லிபுத்தூர்'],
                            ['code' => 'TLK-WTR', 'en' => 'Watrap', 'ta' => 'வத்திராயிருப்பு'],
                        ],
                    ],
                    [
                        'code' => 'RD-APK',
                        'name_en' => 'Aruppukottai',
                        'name_ta' => 'அருப்புக்கோட்டை',
                        'taluks' => [
                            ['code' => 'TLK-VNR', 'en' => 'Virudhunagar', 'ta' => 'விருதுநகர்'],
                            ['code' => 'TLK-APK', 'en' => 'Aruppukottai', 'ta' => 'அருப்புக்கோட்டை'],
                            ['code' => 'TLK-TCL', 'en' => 'Tiruchuli', 'ta' => 'திருச்சுழி'],
                            ['code' => 'TLK-KRP', 'en' => 'Kariapatti', 'ta' => 'காரியாபட்டி'],
                        ],
                    ],
                    [
                        'code' => 'RD-STR',
                        'name_en' => 'Sattur',
                        'name_ta' => 'சாத்தூர்',
                        'taluks' => [
                            ['code' => 'TLK-RJP', 'en' => 'Rajapalayam', 'ta' => 'ராஜபாளையம்'],
                            ['code' => 'TLK-STR', 'en' => 'Sattur', 'ta' => 'சாத்தூர்'],
                            ['code' => 'TLK-VBK', 'en' => 'Vembakkottai', 'ta' => 'வெம்பக்கோட்டை'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($districtsData as $dData) {
            $district = District::updateOrCreate(
                ['code' => $dData['code']],
                [
                    'name_en' => $dData['name_en'],
                    'name_ta' => $dData['name_ta'],
                    'state' => 'குரலற்ற மகளின் குரல்',
                    'is_active' => true,
                ]
            );

            foreach ($dData['divisions'] as $divData) {
                $division = RevenueDivision::updateOrCreate(
                    ['code' => $divData['code']],
                    [
                        'district_id' => $district->id,
                        'name_en' => $divData['name_en'],
                        'name_ta' => $divData['name_ta'],
                        'is_active' => true,
                    ]
                );

                foreach ($divData['taluks'] as $talukData) {
                    Taluk::updateOrCreate(
                        ['code' => $talukData['code']],
                        [
                            'revenue_division_id' => $division->id,
                            'name_en' => $talukData['en'],
                            'name_ta' => $talukData['ta'],
                            'is_active' => true,
                        ]
                    );
                }
            }
        }
    }
}
