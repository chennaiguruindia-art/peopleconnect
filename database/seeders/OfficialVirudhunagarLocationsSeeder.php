<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\District;
use App\Models\RevenueDivision;
use App\Models\RevenueVillage;
use App\Models\Taluk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficialVirudhunagarLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure District Virudhunagar
        $district = District::firstOrCreate(
            ['code' => 'VNR-3326'],
            ['name_en' => 'Virudhunagar', 'name_ta' => 'விருதுநகர்', 'state' => 'குரலற்ற மகளின் குரல்', 'is_active' => true]
        );

        // 2. Exact 3 Revenue Divisions from PDF Page 1
        $divSivakasi = RevenueDivision::updateOrCreate(
            ['code' => 'RD-SVI'],
            ['district_id' => $district->id, 'name_en' => 'Sivakasi', 'name_ta' => 'சிவகாசி', 'is_active' => true]
        );

        $divAruppukottai = RevenueDivision::updateOrCreate(
            ['code' => 'RD-APK'],
            ['district_id' => $district->id, 'name_en' => 'Aruppukottai', 'name_ta' => 'அருப்புக்கோட்டை', 'is_active' => true]
        );

        $divSattur = RevenueDivision::updateOrCreate(
            ['code' => 'RD-STR'],
            ['district_id' => $district->id, 'name_en' => 'Sattur', 'name_ta' => 'சாத்தூர்', 'is_active' => true]
        );

        // 3. Exact 10 Taluks mapped to their respective Revenue Division from PDF Page 1
        $talukDefinitions = [
            // 1. Sivakasi Division (3 Taluks)
            'Sivakasi' => ['division' => $divSivakasi, 'code' => 'TLK-SVI', 'ta' => 'சிவகாசி'],
            'Srivilliputtur' => ['division' => $divSivakasi, 'code' => 'TLK-SVL', 'ta' => 'ஸ்ரீவில்லிபுத்தூர்'],
            'Watrap' => ['division' => $divSivakasi, 'code' => 'TLK-WTR', 'ta' => 'வத்திராயிருப்பு'],

            // 2. Aruppukottai Division (4 Taluks)
            'Virudhunagar' => ['division' => $divAruppukottai, 'code' => 'TLK-VNR', 'ta' => 'விருதுநகர்'],
            'Aruppukottai' => ['division' => $divAruppukottai, 'code' => 'TLK-APK', 'ta' => 'அருப்புக்கோட்டை'],
            'Tiruchuli' => ['division' => $divAruppukottai, 'code' => 'TLK-TCL', 'ta' => 'திருச்சுழி'],
            'Kariapatti' => ['division' => $divAruppukottai, 'code' => 'TLK-KRP', 'ta' => 'காரியாபட்டி'],

            // 3. Sattur Division (3 Taluks)
            'Rajapalayam' => ['division' => $divSattur, 'code' => 'TLK-RJP', 'ta' => 'ராஜபாளையம்'],
            'Sattur' => ['division' => $divSattur, 'code' => 'TLK-STR', 'ta' => 'சாத்தூர்'],
            'Vembakkottai' => ['division' => $divSattur, 'code' => 'TLK-VBK', 'ta' => 'வெம்பக்கோட்டை'],
        ];

        $taluks = [];
        foreach ($talukDefinitions as $nameEn => $meta) {
            $taluk = Taluk::where('name_en', $nameEn)
                ->orWhere('code', $meta['code'])
                ->first();

            if ($taluk) {
                $taluk->update([
                    'revenue_division_id' => $meta['division']->id,
                    'code' => $meta['code'],
                    'name_en' => $nameEn,
                    'name_ta' => $meta['ta'],
                    'is_active' => true,
                ]);
            } else {
                $taluk = Taluk::create([
                    'revenue_division_id' => $meta['division']->id,
                    'code' => $meta['code'],
                    'name_en' => $nameEn,
                    'name_ta' => $meta['ta'],
                    'is_active' => true,
                ]);
            }
            $taluks[$nameEn] = $taluk;
        }

        // 4. All 600 Revenue Villages categorized by Taluk and Firka as per Pages 4-33 of PDF
        $villagesData = [

            // ==========================================
            // ARUPPUKOTTAI TALUK (83 Villages)
            // ==========================================
            'Aruppukottai' => [
                'Aruppukottai' => [
                    'Ampalathevanatham', 'Aruppukottai', 'Chinnapuliampatti',
                    'Periyapuliyampatti (East)', 'Periyapuliyampatti (West)', 'Valavandhapuram'
                ],
                'Mandapasalai' => [
                    'Aladipatti', 'Eraichinnampatti', 'Kalaiyarkarisalkulam', 'Kallurani',
                    'Kalyanasundarapuram', 'Karuppukattiyenthal', 'Konganakkurichi', 'Kulasekaranallur',
                    'Kullampatti', 'Kurunaikkulam', 'Mandapasalai', 'Mangulam',
                    'Maravar Perungudi', 'Melakandamangalam', 'Muthuramalingapuram', 'Narthampatti',
                    'Parattanatham', 'Pommakkottai', 'R. Kallumadam', 'Salukkuvarpatti',
                    'Savvaspuram', 'Silukkapatti', 'Sundakkottai', 'Suthamadam',
                    'Thammanayakkanpatti', 'Thirumalaipuram', 'Thummuchiinnampatti', 'Vedanatham',
                    'Veppilaicheri'
                ],
                'Palayampatti' => [
                    'Athipatti', 'Gopalapuram', 'Kallumarpatti', 'Kanjanayakkanpatti',
                    'Kattakanjampatti', 'Kattangudi', 'Kovilankulam', 'Kullursanthai',
                    'Kurinjan Kulam', 'Mettuthottian Kulam', 'Palavanatham', 'Palayampatti',
                    'Poyyankulam', 'Puliyuran', 'Sempatti', 'Soolakkarai', 'Villipathiri'
                ],
                'Panthalgudi' => [
                    'Amanakkunatham', 'Chettikurichi', 'Chettipatti', 'Koothiparai',
                    'Kurunthamadam', 'P.Andipatti', 'Panthalgudi', 'Podampatti',
                    'Ramapuram', 'Sukkilanatham', 'T. Meenatchipuram', 'T.Koppuchithampatti',
                    'Thiruvirunthalpuram', 'Thummakkundu', 'V.Koppuchithampatti', 'Vathuvarpatti',
                    'Velayuthapuram'
                ],
                'Paralachi' => [
                    'K. Chettikulam', 'Kallakkari', 'Kanakki', 'Keelgudi',
                    'Melaiyur', 'Paralachi', 'Poolangal', 'Pullanayakkanpatti',
                    'Purasalur', 'Rajagopalapuram', 'Sengulam', 'Therkunatham',
                    'Thoppalakkarai', 'Vadakkunatham'
                ]
            ],

            // ==========================================
            // KARIAPATTI TALUK (107 Villages)
            // ==========================================
            'Kariapatti' => [
                'Kalkuruchi' => [
                    'A.Nedunkulam', 'Allalaperi', 'Amaiperaki', 'Arasakulam',
                    'Arianendal', 'Aviyur', 'Chathirampuliyankulam', 'Kambikudi',
                    'Kariapatti', 'Kurandi', 'Mangulam', 'Melakallangulam',
                    'Mustakurichi', 'Pappanam', 'S.Kalluppatti', 'T.Kadambankulam',
                    'Thimmapuram', 'V.Nangoor', 'Vettrilaimuriyanpatti'
                ],
                'Kariapatti' => [
                    'Achampatti', 'Allikkulam', 'Athikulam', 'Chandrankulam',
                    'Johilpatti', 'Kalkuruchi', 'Kaluvanatcheri', 'Kanakkanendal',
                    'Kariyanendal', 'Kattukuthagai Karisalkulam', 'Melpudhupatti', 'Minniranjanpatti',
                    'Pampatti', 'Pandanendal', 'Panjar', 'Pulavanakkundu',
                    'Sithumoondradaippu', 'Thonugal', 'Thoppur', 'Vadakkupuliyampatti',
                    'Vakkanankundu', 'Valiyapatti'
                ],
                'Mallankinar' => [
                    'Achankulam', 'Alagianallur', 'Ayan Reddiyapatti', 'Mallankinar',
                    'Manthoppu', 'Nandhikkundu', 'Pisindi', 'Vadakarai',
                    'Vaiyampatti', 'Valukkalotti', 'Varalotti'
                ],
                'Mudukkankulam' => [
                    'A.Thottiyankulam', 'Alankulam', 'Allikulam', 'Ambaikulam',
                    'Anuppanendal', 'Athikulam', 'Ayyanar Kulam', 'Chandanendal',
                    'Chinna Alankulam', 'Chokkanendhal', 'Esalimadai', 'K.Nedunkulam',
                    'Kampali', 'Karaikulam', 'Keel Puduppatti', 'Keelidaiyankulam',
                    'Keelkallikulam', 'Keelkanjirangulam', 'Keeludaikkulam', 'Kilavaneri',
                    'Koovarkulam', 'Kovilankulam', 'Kudumbankulam', 'Kundukulam',
                    'Kurinchakkulam', 'Kurinchakulam', 'M.Iluppaikulam', 'Manangathan',
                    'Manaviyenthal', 'Melakallikulam', 'Melakanchirankulam', 'Melidaiyankulam',
                    'Mudukkankulam', 'N.Nedunkulam', 'Panaikulam', 'Panikkurippu',
                    'Paraiyanakuthi', 'Periya Alankulam', 'Pottalkulam', 'Puthukulam',
                    'S.Maraikulam', 'S.Thondarendal', 'Singanathapuram', 'Sirukulam',
                    'Siruveppankulam', 'Sithanendal', 'Sooranoor', 'T. Chettikulam',
                    'T.Veppankulam', 'Tamaraikulam', 'Thenoor', 'Thulukankulam',
                    'Uthakulam', 'Vellankulam', 'Vilakulam'
                ]
            ],

            // ==========================================
            // RAJAPALAYAM TALUK (32 Villages)
            // ==========================================
            'Rajapalayam' => [
                'Ayankollankondan' => [
                    'Ayankollankondan', 'Kollankondan', 'Melpattamkarisalkulam',
                    'Sammandapuram', 'Thruchchalur', 'Vadakku Venganallur'
                ],
                'Cholapuram' => [
                    'Chettiyarpatti', 'Cholapuram', 'Ilandirakondan', 'Nallamangalam',
                    'Nattampatti', 'Puttur', 'Ramalingapuram', 'Therku Venganallur'
                ],
                'Rajapalayam' => [
                    'Appaneri', 'Arasiyarpatti', 'Kadambankulam', 'Kottankulam',
                    'Melrajakularaman', 'Mettuppatti', 'Puduppalaiyam', 'Raghunathapuram',
                    'Rajapalayam', 'Samsikapuram'
                ],
                'Settur' => [
                    'Chokkanathanputtur', 'Kovilur', 'Muthuswamipuram', 'Settur',
                    'Solaichcheri', 'Sundararajapuram', 'Therku Devadanam', 'Vadakku Devadanam'
                ]
            ],

            // ==========================================
            // SATTUR TALUK (53 Villages)
            // ==========================================
            'Sattur' => [
                'Nalli' => [
                    'Ayyampatti', 'Chinnathambiyapuram', 'Dharmasanam Chinnaodaipatti', 'Kanjampatti',
                    'Karisalpatti', 'M.Chokkalingapuram', 'Madam Chinnaodaipatti', 'Mulliseval',
                    'Nallamuthanpatti', 'Nalli', 'Ovanaickanpatti', 'Peraiyampatti',
                    'Pethureddipatti', 'Pothireddipatti', 'Ravuthanpatti', 'Subramaniyapuram',
                    'Umathampatti', 'Uppathur'
                ],
                'Nenmeni' => [
                    'Athipatti', 'Kosukundu', 'Kundalakuthur', 'M.Nagalapuram',
                    'Melamadai', 'N.Mettupatti', 'Nallamanaickanpatti', 'Nenmeni',
                    'Pappakudi', 'Sindhuvampatti', 'Sirukulam'
                ],
                'Padanthal' => [
                    'Chinnakamanpatti', 'E.Kumaralingapuram', 'E.Muthulingapuram', 'Golwarpatti',
                    'Madathukadu', 'Mettamalai', 'Padanthal', 'Sandaiyoor',
                    'Sankaranatham', 'Sinthapalli', 'Vadamalapuram', 'Veppilaipatti'
                ],
                'Sattur' => [
                    'Alampatti', 'Ammapatti', 'Bandhuvarpatti', 'Chathirapatti',
                    'Chinnakollapatti', 'Kathalampatti', 'Kottapacheri', 'O.Mettupatti',
                    'Othaiyal', 'Periyakollapatti', 'Sattur', 'Soorangudi'
                ]
            ],

            // ==========================================
            // SIVAKASI TALUK (36 Villages)
            // ==========================================
            'Sivakasi' => [
                'Mangalam' => [
                    'Enjar', 'Erichanatham', 'Kalayarkurichi', 'Krishnaperi',
                    'Mangalam', 'Namaskarithanpatti', 'Nedungulam', 'Poornachandrapuram',
                    'Pudukkottai', 'Sevalur', 'Tachakkudi', 'Vadapatti'
                ],
                'Salvarpatti' => [
                    'Anuppankulam', 'Pernaickenpatti', 'Salvarpatti', 'Subramaniyapuram',
                    'Thailpatti', 'Vetrilaiyurani'
                ],
                'Sivakasi' => [
                    'Anaiyur', 'Duraisamypuram', 'Kongalapuram', 'Maraneri',
                    'Naranapuram', 'Sivakasi', 'V.Chokkalingapuram', 'Vadi',
                    'Vendurayapuram', 'Viswanatham'
                ],
                'Thiruthangal' => [
                    'A.Meenakshipuram', 'Anaikuttam', 'Kariseri', 'Keelathiruthangal',
                    'Koundampatti', 'Melamathur', 'Thiruthangal', 'Vellur'
                ]
            ],

            // ==========================================
            // SRIVILLIPUTHUR TALUK (26 Villages)
            // ==========================================
            'Srivilliputtur' => [
                'Malli' => [
                    'S. Ammapatti', 'Malli', 'Mullkulam', 'Muthuvenkatarayapuram',
                    'Pattakulam Sallipatti', 'Pillaiyarnatham', 'Puvani', 'T. Managaseri',
                    'Venkateswarapuram', 'Viluppanur'
                ],
                'Pilliyarnatham' => [
                    'Achchandavilthan', 'Ayan Nachiarkoil', 'Mamsapuram', 'Nallingaperi',
                    'Padikkasuvaithanpatti', 'Pillaiyarkulam', 'Sivandipatti', 'Valaikulam'
                ],
                'Srivilliputhur' => [
                    'Athikulam Sengulam', 'Deyvendri', 'Kurukkalkulam', 'Ponnangani',
                    'Singammalpuram', 'Srivilliputhur', 'Thailakulam', 'Vadakku Srivilliputhur'
                ]
            ],

            // ==========================================
            // TIRUCHULI TALUK (150 Villages)
            // ==========================================
            'Tiruchuli' => [
                'A.Mukkalam' => [
                    'Agathakulam', 'Anaikulam', 'Andipatti', 'Atchankulam',
                    'Chempounnerunchi', 'Dhamotharapuram', 'Gonkalagudi', 'Gurunthankulam',
                    'Ilupaiyoor', 'Kadambankulam', 'Kamalipuliyankulam', 'Kathanpatti',
                    'Keelapuliyandarkottai', 'Koigaipithan', 'Koothanarkottai', 'Kuraiyaravasithan',
                    'Manakulam', 'Melachemboor', 'Melaparuthiyoor', 'Mullikulam',
                    'Muthaneri', 'Naduvapatcheri', 'Nathakulam(V)', 'Nellikulam',
                    'Ottankulam', 'Panaiyoor', 'Pillaiyarenthal', 'Pitchankudi',
                    'Poomalaipatti', 'Pulichikulam', 'Seelampatti', 'Sethupuram',
                    'Silanthikulam', 'Sullankudi', 'Sundrathan', 'Suraikulam',
                    'T.Karisalkulam', 'Therkariyankulam', 'Thiduvoor', 'Usilankulam',
                    'Vadakariyankulam', 'Veeraalankulam', 'Veeracholan', 'Velanoorani'
                ],
                'Narikudi' => [
                    'Andiyenthal', 'Athithanenthal', 'Chorikulam', 'Chottamuri',
                    'Irunchirai', 'Isali', 'Kaladipappankulam', 'Kandukondanmanickam',
                    'Keelachemboor', 'Manoor', 'Mayaleri', 'Melakumilankulam',
                    'Minakulam', 'Nambiyenthal', 'Pappankulam', 'Salaiiluppaikulam',
                    'Sathicheri', 'T.Velankudi', 'Theli', 'Ulakudi',
                    'Varisaiyoor', 'Veerakudi', 'Velaneri'
                ],
                'Tiruchuli' => [
                    'Ambaneri', 'Anchanaikuthi', 'Anikalakkiyenthal', 'Chennilaikudi',
                    'Chinnavannankulam', 'Chithalakundu', 'Chokkampatti', 'Choochaneri',
                    'Ilupaikulam', 'Kadalpachi', 'Kadambankulam', 'Kadayanenthal',
                    'Kallathikulam', 'Karenthal', 'Keelakandamankalam', 'Kokkulam',
                    'Kollanenthal', 'Konappanenthal', 'Kurinchakulam', 'Kutchampatti',
                    'M.Puliyankulam', 'Maili', 'Manavarayanenthal', 'Melenthal',
                    'Meludaikulam', 'Mithilaikulam', 'Muthanenthal', 'Muthuramalingapuram',
                    'Nadakulam', 'Nallatharai', 'Notchikulam', 'Ooranipatti',
                    'P.Pudupatti', 'Pallimadam', 'Pannaimoondradaippu', 'Paraikulam',
                    'Paraiyankulam', 'Pathanakuruchi', 'Perumanenthal', 'Pillayarthottiyankulam',
                    'Pullikuruchi', 'Puthiyanenthal', 'Sammanenthal', 'Sappaniyenthal',
                    'Seeniyenthal', 'Sirumithilaikulam', 'Sriramanenthal', 'Thippampatti',
                    'Thondaimankulam', 'Tiruchuli', 'Udaichiyenthal', 'Udaiyanampatti',
                    'Udaiyarenthal', 'Vadapalai', 'Valayanenthal', 'Valillaperi',
                    'Velayuthapuram', 'Vidathakulam'
                ],
                'Veeracholan' => [
                    'Athikulam', 'Boombidagai', 'Eluvani', 'Erumaikulam',
                    'Idaiyankulam', 'K.Nedunkulam', 'Kalathoor', 'Kattanoor',
                    'Kundukulam', 'M.Pudhukulam', 'Meenatchipuram', 'Nallukuruchi',
                    'Naloor', 'Nathakulam', 'P.Vagaikulam', 'Panaikudi',
                    'Pillaiyarkulam', 'Pillaiyarnatham', 'Pulvaikarai', 'Reghunathamadai',
                    'S.Kallumadai', 'T.Nedungulam', 'Thiruvidanallur', 'Undurumikidakulam',
                    'V.Karisalkulam'
                ]
            ],

            // ==========================================
            // VEMBAKKOTTAI TALUK (37 Villages)
            // ==========================================
            'Vembakkottai' => [
                'Alangulam' => [
                    'A. Lakshmipuram', 'Alangulam', 'Appanayakkanpatti', 'Edirkottai',
                    'Keelanmarainadu', 'Kongankulam', 'Kundayiruppu', 'Nathikudi'
                ],
                'Elayirampannai' => [
                    'E.Ramanathapuram', 'E.Reddiyapatti', 'Elayirampannai', 'Guganparai',
                    'Kangarakottai', 'Muthandiyapuram', 'O.Muthusamipuram', 'Sanankulam',
                    'Sangarapandiyapuram', 'Servaikaranpatti', 'Sevalpatti', 'Sippiparai',
                    'Thulukkankurichi', 'Uthupatti'
                ],
                'Keelarajakularaman' => [
                    'Gopalapuram', 'Keelarajakularaman', 'Korukkampatti', 'Kuruchiyarpatti',
                    'Thenkarai', 'Vadakarai', 'Varagunaramapuram'
                ],
                'Vembakkottai' => [
                    'Achangulam', 'Kananjampatti', 'Kangaraseval', 'Panaiyadipatti',
                    'Surarpatti', 'Vembakottai', 'Vijayakarisalkulam', 'Vijayarengapuram'
                ]
            ],

            // ==========================================
            // VIRUDHUNAGAR TALUK (53 Villages)
            // ==========================================
            'Virudhunagar' => [
                'Amathur' => [
                    'Amathur', 'Ellinganaickanpatti', 'Moolipatti', 'Nattarmangalam',
                    'P.Kumaralingapuram', 'Pavali', 'Pullalakottai', 'Seeniyapuram',
                    'Sengundrapuram', 'Senkottai', 'Sivaganapuram', 'Vadamalikurichi'
                ],
                'Ondipulinaickanoor' => [
                    'Alagapuri', 'Chinnavadi', 'K.Pudur', 'Kasireddiapatti',
                    'Kooraikundu', 'Meesalur', 'Ondipulinaickanoor', 'Patchakulam',
                    'Puliyankulam', 'Tammanaickanpatti', 'Thathampatti', 'V.Muthulingapuram'
                ],
                'Vatchakarapatti' => [
                    'A.Pudupatti', 'Appayanaickanpatti', 'Avudayapuram', 'Chettipatti',
                    'Endapuli', 'Kadambankulam', 'Kalangaperi', 'Kottaiyur',
                    'Kottanatham', 'Kovilveerarpatti', 'Mannarkottai', 'Maruluthu',
                    'Mettukundu', 'Pattampudur', 'Sennalkudi', 'Thulukapatti',
                    'V.Sundaralingapuram', 'Vaipootanpatti', 'Valayapatti', 'Vatchakarapatti'
                ],
                'Virudhunagar' => [
                    'Allampatti', 'Chatrareddiapatti', 'Chinnamupanpatti', 'Kottaipatti',
                    'Muthuramanpatti', 'Pelampatti', 'Periyaperali', 'Rosalpatti',
                    'Virudhunagar'
                ]
            ],

            // ==========================================
            // WATRAP TALUK (23 Villages)
            // ==========================================
            'Watrap' => [
                'Kottaiyur' => [
                    'Ayaidharmam', 'Ayankarisalkulam', 'Govindanallur', 'Ilandaikulam',
                    'Kottaiyur', 'Maharajapuram', 'Marakalamkathan', 'Thambipatti',
                    'Vellaipottal'
                ],
                'Nathampatti' => [
                    'Kalathur', 'Kunnur', 'Muvaraivenran', 'Nathampatti',
                    'Rudrappanaickenpatti', 'Ammapatti', 'Semmanandikarisalkulam', 'Sundarapandiam',
                    'Thulukkapatti', 'Vadugapatti'
                ],
                'Watrap' => [
                    'Khansabpuram', 'S.Kodikulam', 'W Pudupatti', 'Watrap'
                ]
            ]
        ];

        // 5. Populate All 600 Villages
        $totalInserted = 0;
        foreach ($villagesData as $talukName => $firkas) {
            $talukModel = $taluks[$talukName] ?? null;
            if (!$talukModel) {
                continue;
            }

            $vIndex = 1;
            foreach ($firkas as $firkaName => $villageList) {
                foreach ($villageList as $villageName) {
                    $code = sprintf('RV-%s-%03d', strtoupper(substr(str_replace([' ', '.'], '', $talukName), 0, 3)), $vIndex);

                    RevenueVillage::updateOrCreate(
                        [
                            'taluk_id' => $talukModel->id,
                            'firka' => $firkaName,
                            'name_en' => $villageName,
                        ],
                        [
                            'code' => $code,
                            'name_ta' => $villageName,
                            'is_active' => true,
                        ]
                    );

                    $vIndex++;
                    $totalInserted++;
                }
            }
        }

        // 6. Synchronize any existing complaints with the updated taluk divisions
        $existingComplaints = Complaint::all();
        foreach ($existingComplaints as $c) {
            $currentTaluk = Taluk::find($c->taluk_id);
            if ($currentTaluk) {
                $validVillage = RevenueVillage::where('taluk_id', $currentTaluk->id)
                    ->whereNotNull('firka')
                    ->first();

                $c->update([
                    'revenue_division_id' => $currentTaluk->revenue_division_id,
                    'revenue_village_id' => $validVillage ? $validVillage->id : $c->revenue_village_id,
                ]);
            }
        }

        // Remove old sample villages without firka
        RevenueVillage::whereNull('firka')->delete();

        $finalVillageCount = RevenueVillage::count();
        $this->command->info("Successfully configured 3 Divisions, 10 Taluks, 39 Firkas, and {$finalVillageCount} Revenue Villages!");
    }
}
