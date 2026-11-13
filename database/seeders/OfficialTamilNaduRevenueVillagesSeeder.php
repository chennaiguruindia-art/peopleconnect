<?php

namespace Database\Seeders;

use App\Models\Taluk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficialTamilNaduRevenueVillagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = database_path('data/tn_villages.csv');
        if (!file_exists($csvPath)) {
            $csvPath = 'C:/Users/GURU/.gemini/antigravity/brain/5b59fa74-ba44-4a44-a62b-b1a916b14fd0/scratch/tn_villages.csv';
        }
        if (!file_exists($csvPath)) {
            $this->command->error("CSV file not found at: {$csvPath}");
            return;
        }

        $fh = fopen($csvPath, 'r');
        $header = fgetcsv($fh);

        $colDist = array_search('District', $header);
        $colMandal = array_search('Mandal', $header);
        $colVillageEn = array_search('Village', $header);
        $colVillageTa = array_search('Village (Native)', $header);
        $colVillageCode = array_search('Village Code', $header);

        // Map DB Taluks
        $dbTaluks = Taluk::with('revenueDivision.district')->get();
        $distTalukMap = [];
        foreach ($dbTaluks as $t) {
            $distName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t->revenueDivision?->district?->name_en ?? ''));
            $distTalukMap[$distName][] = $t;
        }

        // Keep Virudhunagar taluk IDs safe so we don't duplicate its 600 gazette villages
        $virudhunagarTalukIds = Taluk::whereHas('revenueDivision.district', function ($q) {
            $q->whereIn('code', ['VNR-3326', 'DT-VNR']);
        })->pluck('id')->toArray();

        // Clear existing non-Virudhunagar placeholder villages
        DB::table('revenue_villages')->whereNotIn('taluk_id', $virudhunagarTalukIds)->delete();

        $mandalCache = [];
        $records = [];
        $batchCount = 0;
        $totalInserted = 0;
        $now = now();

        while (($row = fgetcsv($fh)) !== false) {
            if (empty($row[$colVillageEn])) continue;

            $dRaw = $row[$colDist];
            $mRaw = $row[$colMandal];
            $cacheKey = $dRaw . '||' . $mRaw;

            if (!array_key_exists($cacheKey, $mandalCache)) {
                $dNorm = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $dRaw));
                $mNorm = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $mRaw));

                $foundTaluk = null;
                if (isset($distTalukMap[$dNorm])) {
                    $bestSim = 0;
                    foreach ($distTalukMap[$dNorm] as $t) {
                        $tNorm = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t->name_en));
                        if ($tNorm === $mNorm) {
                            $foundTaluk = $t;
                            break;
                        }
                        similar_text($mNorm, $tNorm, $sim);
                        if ($sim > 65 && $sim > $bestSim) {
                            $bestSim = $sim;
                            $foundTaluk = $t;
                        }
                    }
                }

                if (!$foundTaluk) {
                    $bestSim = 0;
                    foreach ($dbTaluks as $t) {
                        $tNorm = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t->name_en));
                        if ($tNorm === $mNorm) {
                            $foundTaluk = $t;
                            break;
                        }
                        similar_text($mNorm, $tNorm, $sim);
                        if ($sim > 75 && $sim > $bestSim) {
                            $bestSim = $sim;
                            $foundTaluk = $t;
                        }
                    }
                }

                $mandalCache[$cacheKey] = $foundTaluk;
            }

            $taluk = $mandalCache[$cacheKey];
            if (!$taluk || in_array($taluk->id, $virudhunagarTalukIds)) {
                continue; // Skip unmatched or Virudhunagar
            }

            $vilEn = trim($row[$colVillageEn]);
            $vilTa = !empty($row[$colVillageTa]) ? trim($row[$colVillageTa]) : $vilEn;
            $vilCode = !empty($row[$colVillageCode]) ? trim($row[$colVillageCode]) : null;

            $records[] = [
                'taluk_id' => $taluk->id,
                'code' => $vilCode,
                'name_en' => $vilEn,
                'name_ta' => $vilTa,
                'firka' => $taluk->name_en,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($records) >= 500) {
                DB::table('revenue_villages')->insert($records);
                $totalInserted += count($records);
                $records = [];
            }
        }
        fclose($fh);

        if (!empty($records)) {
            DB::table('revenue_villages')->insert($records);
            $totalInserted += count($records);
        }

        $this->command->info("Seeded {$totalInserted} official revenue villages across குரலற்ற மகளின் குரல்.");
    }
}
