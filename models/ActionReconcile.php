<?php

namespace app\models;

use DateTime;
use InvalidArgumentException;
use Yii;
use yii\base\Model;

class ActionReconcile extends Model
{
    public static function listWeek()
    {
        $data = SapIndicatorPlan::find()
            ->select('week')
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['tahun' => date('Y')])
            ->distinct()
            ->asArray()
            ->orderBy(['week' => SORT_DESC])
            ->all();
        return array_column($data, 'week');
    }

    public static function listMonth()
    {
        $data = SapIndicatorPlanMonthly::find()
            ->select('month')
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['year' => date('Y')])
            ->distinct()
            ->asArray()
            ->orderBy(['month' => SORT_DESC])
            ->all();
        return array_column($data, 'month');
    }
    public static function getNamaBulan($angkaBulan)
    {
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        return $namaBulan[(int)$angkaBulan] ?? '-';
    }

    public static function normalizeFilesArray($filesInput)
    {
        $normalized = [];
        // pastikan ada key 'name' dan berupa array
        if (!isset($filesInput['name']) || !is_array($filesInput['name'])) {
            return $normalized;
        }

        foreach ($filesInput['name'] as $i => $name) {
            $normalized[] = [
                'name'     => $name,
                'type'     => $filesInput['type'][$i] ?? '',
                'tmp_name' => $filesInput['tmp_name'][$i] ?? '',
                'error'    => $filesInput['error'][$i] ?? 0,
                'size'     => $filesInput['size'][$i] ?? 0,
            ];
        }

        return $normalized;
    }


    public static function ReconcileThisWeek($week)
    {
        $reconcile = SapReconcile::find()->where(['week' => $week])->asArray()->all();
        return $reconcile;
    }

    public static function ReconcileThisMonth($month)
    {
        $reconcile = SapReconcile::find()->where(['bulan' => $month])->asArray()->all();
        return $reconcile;
    }

    public static function separateValidInvalidDates(
        array $dates,
        string $start,
        string $end,
        string $nrp,
        string $week,
        string $year
    ): array {

        // Hilangkan duplikat input
        $dates = array_unique($dates);

        $startDate = DateTime::createFromFormat('Y-m-d', $start);
        $endDate   = DateTime::createFromFormat('Y-m-d', $end);

        $valid   = [];
        $invalid = [];

        // ============================================================
        // 1️⃣ Ambil semua tanggal existing dari sap_reconcile (format d/m/Y)
        // ============================================================

        $rows = (new \yii\db\Query())
            ->from('sap_reconcile')
            ->where([
                'nrp'  => $nrp,
                'week' => $week,
                'year' => $year,
            ])
            ->all();

        $existingDates = [];

        foreach ($rows as $row) {
            if (!empty($row['reconcile_json'])) {
                $json = json_decode($row['reconcile_json'], true);

                // CASE A: ["28/10/2025"]
                if (isset($json[0]) && is_string($json[0])) {
                    foreach ($json as $tglStr) {
                        $existingDates[] = $tglStr;
                    }
                }
                // CASE B: [{"tanggal":"28/10/2025"}]
                else if (is_array($json)) {
                    foreach ($json as $item) {
                        if (!empty($item['tanggal'])) {
                            $existingDates[] = $item['tanggal'];
                        }
                    }
                }
            }
        }

        $existingDates = array_unique($existingDates);
        $existingMap = array_flip($existingDates); // fast lookup


        // ============================================================
        // 2️⃣ Ambil semua tanggal dari note_per_date (format Y-m-d → convert ke d/m/Y)
        // ============================================================

        $plans = (new \yii\db\Query())
            ->from('sap_indicator_plan')
            ->where([
                'nrp'  => $nrp,
                'week' => $week,
                'tahun' => $year,
            ])
            ->all();

        $noteDates = [];

        foreach ($plans as $p) {
            if (!empty($p['note_per_date'])) {
                $npd = json_decode(json_decode($p['note_per_date']), true);

                if (is_array($npd)) {
                    foreach ($npd as $item) {
                        if (!empty($item['tanggal'])) {

                            // Convert Y-m-d → d/m/Y
                            $dt = DateTime::createFromFormat('Y-m-d', $item['tanggal']);
                            if ($dt) {
                                $noteDates[] = $dt->format('d/m/Y');
                            }
                        }
                    }
                }
            }
        }

        $noteDates = array_unique($noteDates);
        $noteMap = array_flip($noteDates);


        // ============================================================
        // 3️⃣ Validasi setiap tanggal input (format d/m/Y)
        // ============================================================

        foreach ($dates as $d) {

            $dt = DateTime::createFromFormat('d/m/Y', $d);
            if (!$dt) {
                $invalid[] = $d;
                continue;
            }

            // ❌ Ada di note_per_date
            if (isset($noteMap[$d])) {
                $invalid[] = $d;
                continue;
            }

            // ❌ Ada di reconcile_json
            if (isset($existingMap[$d])) {
                $invalid[] = $d;
                continue;
            }

            // ✔ Cek rentang tanggal
            if ($dt >= $startDate && $dt <= $endDate) {
                $valid[] = $d;
            } else {
                $invalid[] = $d;
            }
        }

        return [
            'valid'   => $valid,
            'invalid' => $invalid,
        ];
    }




    public static function totalReconcile(array $reconcile)
    {
        $roster = 0;
        $sapType = [];

        foreach ($reconcile as $data) {

            // Hitung roster
            if ($data['jenis_reconcile'] == 'roster' && $data['approvment_final'] == 'approved') {
                $jsonRec = json_decode($data['reconcile_json'], true);

                foreach ($jsonRec as $json) {
                    if ($json['status'] == 'approved') {
                        $roster++;
                    }
                }
            }
            // Hitung SAP berdasarkan sub jenis
            if ($data['jenis_reconcile'] == 'sap' && $data['approvment_final'] == 'approved') {

                // Jika belum ada, set default 0
                $sap = $sapType[$data['sub_jenis_reconcile']] ?? 0;

                $jsonRec = json_decode($data['reconcile_json'], true);

                foreach ($jsonRec as $json) {
                    if ($json['status'] == 'approved') {
                        $sap++;
                    }
                }

                // Simpan kembali
                $sapType[$data['sub_jenis_reconcile']] = $sap;
            }
        }

        return [
            'roster' => $roster,
            'sap'    => $sapType,
        ];
    }

    public static function ceilingMath($number, $significance = 1.0)
    {
        if ($significance == 0) {
            return 0;
        }

        $significance = abs($significance); // harus positif
        return ($number >= 0)
            ? ceil($number / $significance) * $significance
            : floor($number / $significance) * $significance;
    }

    public static function akumulasiReconcile($arrayCuti, $roster, $sap_n)
    {
        $cuti       = json_decode($arrayCuti);
        $totalCuti  = count((array)$cuti);
        if ($totalCuti == 0) {
            $sap = ((7 - $roster) / 7) * $sap_n;
        } else {
            $sap = (((7 - $totalCuti) - $roster) / (7 - $totalCuti)) * $sap_n;
        }
        return ActionReconcile::ceilingMath($sap);
    }

    public static function akumulasiReconcileMonth($arrayCuti, $roster, $sap_n, $month, $year)
    {
        // print_r(ActionReconcile::jumlahHariPadaBulan($month, $year));
        // print_r($roster);
        // print_r($sap_n);
        // exit;
        $cuti       = json_decode($arrayCuti);
        $totalCuti  = count($cuti);
        if ($totalCuti == 0) {
            $sap = ((ActionReconcile::jumlahHariPadaBulan($month, $year) - $roster) / ActionReconcile::jumlahHariPadaBulan($month, $year)) * $sap_n;
        } else {
            $sap = (((ActionReconcile::jumlahHariPadaBulan($month, $year) - $totalCuti) - $roster) / (ActionReconcile::jumlahHariPadaBulan($month, $year) - $totalCuti)) * $sap_n;
        }
        return ActionReconcile::ceilingMath($sap);
    }

    public static function jumlahHariPadaBulan($month, $year = null)
    {
        $year = $year ?? date('Y');
        $monthStr = is_numeric($month) ? sprintf('%02d', (int)$month) : $month;
        $dt = new DateTime("$year-$monthStr-01");
        return (int)$dt->format('t');
    }
}
