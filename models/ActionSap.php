<?php

namespace app\models;

use DateTime;
use Yii;
use yii\base\Model;

class ActionSap extends Model
{
    public static function getWeeksSunToSatThisYear()
    {
        $year = date('Y');
        $today = new DateTime();
        $currentWeek = (int)$today->format("W");

        $weeks = [];

        for ($week = 1; $week <= $currentWeek; $week++) {
            // Senin minggu ke-$week
            $monday = new DateTime();
            $monday->setISODate($year, $week);

            // Geser ke hari Minggu (1 hari sebelum Senin)
            $sunday = clone $monday;
            $sunday->modify('-1 day');

            // Sabtu = Minggu + 6 hari
            $saturday = clone $sunday;
            $saturday->modify('+6 days');

            $weeks[] = [
                'week'   => $week,
                'start'  => $sunday->format('Y-m-d'),   // Minggu
                'end'    => $saturday->format('Y-m-d'), // Sabtu
            ];
        }

        return $weeks;
    }

    public static function getCountDataSAP($weekToday = null)
    {
        if ($weekToday === null) {
            $week = ActionSap::getWeeksSunToSatThisYear();
            $weekToday = max($week)['week'];
        }
        $data = SapDataView::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['week' => $weekToday])
            ->andWhere(['tahun' => date('Y')])
            ->asArray()
            ->one();
        $indicator          = SapIndicatorPlan::findOne($data['id_sap_indicator_plan']);
        $data['kta_n']      = $indicator['kta_n'];
        $data['tta_n']      = $indicator['tta_n'];
        $data['obs_n']      = $indicator['obs_n'];
        $data['ins_n']      = $indicator['ins_n'];
        $data['s_meet_n']   = $indicator['s_meet_n'];
        $data['cc_n']       = $indicator['cc_n'];
        $data['wuc_n']      = $indicator['wuc_n'];
        $data['opk_n']      = $indicator['opk_n'];

        return $data;
    }

    public static function getCountDataSAPMonthly($monthlyDay = null, $year = null)
    {
        if ($monthlyDay === null) {
            $month = SapDataViewMonthly::find()->select('month')->where(['nrp' => @Yii::$app->user->identity->nrp])->andWhere(['year' => date('Y')])->asArray()->all();
            $monthlyDay = max($month)['month'];
        }
        $data = SapDataViewMonthly::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['month' => @$monthlyDay])
            ->andWhere(['year' => @$year])
            ->asArray()
            ->one();

        $indicator          = SapIndicatorPlanMonthly::findOne($data['id_sap_indicator_plan']);
        $data['kta_n']      = $indicator['kta_n'];
        $data['tta_n']      = $indicator['tta_n'];
        $data['obs_n']      = $indicator['obs_n'];
        $data['ins_n']      = $indicator['ins_n'];
        $data['s_meet_n']   = $indicator['s_meet_n'];
        $data['cc_n']       = $indicator['cc_n'];
        $data['wuc_n']      = $indicator['wuc_n'];
        $data['opk_n']      = $indicator['opk_n'];
        return $data;
    }

    public static function getDataUser()
    {
        $user = Yii::$app->user->identity ?? null;
        if (!$user || empty($user->nrp)) {
            // User belum login atau nrp kosong
            return null;
        }

        $data = DataKaryawan::find()
            ->where(['nrp' => $user->nrp])
            ->asArray()
            ->one();

        // Jika data karyawan tidak ditemukan
        if (!$data || empty($data['jabatan'])) {
            return $data; // Kembalikan apa adanya (bisa null)
        }

        $settingPlan = SapSettingPlan::find()
            ->where(['jabatan' => $data['jabatan']])
            ->asArray()
            ->one();

        // Tambahkan field hanya jika $settingPlan ada
        $data['golongan_jabatan'] = $settingPlan['golongan_jabatan'] ?? null;

        return $data;
    }



    public static function getPeriodeWeekly()
    {

        $datas = SapDataView::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['tahun' => date('Y')])
            ->orderBy(['week' => SORT_DESC])
            ->asArray()
            ->all();
        foreach ($datas as $key => $data) {

            $reconcile                 = ActionReconcile::ReconcileThisWeek(@$data['week']);
            $total                     = ActionReconcile::totalReconcile($reconcile);
            $indicator                 = SapIndicatorPlan::findOne($data['id_sap_indicator_plan']);
            $datas[$key]['kta_n']      = $indicator['kta_n'];
            $datas[$key]['tta_n']      = $indicator['tta_n'];
            $datas[$key]['obs_n']      = $indicator['obs_n'];
            $datas[$key]['ins_n']      = $indicator['ins_n'];
            $datas[$key]['s_meet_n']   = $indicator['s_meet_n'];
            $datas[$key]['cc_n']       = $indicator['cc_n'];
            $datas[$key]['wuc_n']      = $indicator['wuc_n'];
            $datas[$key]['opk_n']      = $indicator['opk_n'];
            $datas[$key]['reconcile']  = false;
            if (count($reconcile) > 0) {

                $datas[$key]['reconcile']      = true;
                $ktaAc      = (isset($total['sap']['kta'])) ? ($data['kta_a'] + $total['sap']['kta']) : $data['kta_a'];
                $ttaAc      = (isset($total['sap']['tta'])) ? ($data['tta_a'] + $total['sap']['tta']) : $data['tta_a'];
                $insAc      = (isset($total['sap']['ins'])) ? ($data['ins_a'] + $total['sap']['ins']) : $data['ins_a'];
                $smeetAc    = (isset($total['sap']['s_meet'])) ? ($data['s_meet_a'] + $total['sap']['s_meet']) : $data['s_meet_a'];
                $ccAc       = (isset($total['sap']['cc'])) ? ($data['cc_a'] + $total['sap']['cc']) : $data['cc_a'];
                $wucAc      = (isset($total['sap']['wuc'])) ? ($data['wuc_a'] + $total['sap']['wuc']) : $data['wuc_a'];

                $recKta     = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['kta_n']);
                $recTta     = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['tta_n']);
                $recIns     = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['ins_n']);
                $recCC      = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['cc_n']);
                $recWcu     = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['wuc_n']);
                $recSmeet   = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['s_meet_n']);

                if (count(json_decode($data['opk_detail'])) != 0) {
                    $opkAc = (isset($total['sap']['opk'])) ? ($data['opk_a'] + $total['sap']['opk']) : $data['opk_a'];
                    @$recOpkobsA = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['opk_n']);
                    // Cegah pembagian 0
                    $opkobsAch = ($recOpkobsA > 0)
                        ? min(($opkAc / $recOpkobsA) * 100, 100)
                        : 0;

                    $datas[$key]['opk_a']    = $opkAc;
                    $datas[$key]['rec_obs']  = 0;
                    $datas[$key]['rec_opk']  = $recOpkobsA;
                    $datas[$key]['obs_ach']  = 0;
                    $datas[$key]['opk_ach']  = $opkobsAch;
                } else {
                    $obsAc = (isset($total['sap']['obs'])) ? ($data['obs_a'] + $total['sap']['obs']) : $data['obs_a'];
                    @$recOpkobsA = ActionReconcile::akumulasiReconcile($data['note_per_date'], $total['roster'], $indicator['obs_n']);
                    // Cegah pembagian 0
                    $opkobsAch = ($recOpkobsA > 0)
                        ? min(($obsAc / $recOpkobsA) * 100, 100)
                        : 0;

                    $datas[$key]['obs_a']    = $obsAc;
                    $datas[$key]['rec_obs']  = $recOpkobsA;
                    $datas[$key]['rec_opk']  = 0;
                    $datas[$key]['obs_ach']  = $opkobsAch;
                    $datas[$key]['opk_ach']  = 0;
                }

                $datas[$key]['rec_kta']     = $recKta;
                $datas[$key]['rec_tta']     = $recTta;
                $datas[$key]['rec_ins']     = $recIns;
                $datas[$key]['rec_cc']      = $recCC;
                $datas[$key]['rec_wcu']     = $recWcu;
                $datas[$key]['rec_s_meet']  = $recSmeet;


                $wucAch = min(($wucAc / $recWcu) * 100, 100);
                $ccAch  = min(($ccAc / $recCC) * 100, 100);
                $insAch = min(($insAc / $recIns) * 100, 100);
                $ktaAch = min(($ktaAc / $recKta) * 100, 100);
                $ttaAch = min(($ttaAc / $recTta) * 100, 100);
                $smeetAch = min(($smeetAc / $recSmeet) * 100, 100);

                $datas[$key]['kta_ach']     = $ktaAch;
                $datas[$key]['tta_ach']     = $ttaAch;
                $datas[$key]['ins_ach']     = $insAch;
                $datas[$key]['cc_ach']      = $ccAch;
                $datas[$key]['wuc_ach']     = $wucAch;
                $datas[$key]['smeet_ach']   = $smeetAch;
                $datas[$key]['total_ach'] = round(($wucAch + $ccAch + $insAch + $ktaAch + $ttaAch + $smeetAch + $opkobsAch) / 7, 2);
            }
        }
        return $datas;
    }

    public static function getPeriodeMonthly()
    {
        $datas = SapDataViewMonthly::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['year' => date('Y')])
            ->orderBy(['month' => SORT_DESC])
            ->asArray()
            ->all();

        foreach ($datas as $key => $data) {

            $reconcile                 = ActionReconcile::ReconcileThisMonth(@$data['month']);
            $total                     = ActionReconcile::totalReconcile($reconcile);
            $indicator                 = SapIndicatorPlanMonthly::findOne($data['id_sap_indicator_plan']);;
            $datas[$key]['kta_n']      = $indicator['kta_n'];
            $datas[$key]['tta_n']      = $indicator['tta_n'];
            $datas[$key]['obs_n']      = $indicator['obs_n'];
            $datas[$key]['ins_n']      = $indicator['ins_n'];
            $datas[$key]['s_meet_n']   = $indicator['s_meet_n'];
            $datas[$key]['cc_n']       = $indicator['cc_n'];
            $datas[$key]['wuc_n']      = $indicator['wuc_n'];
            $datas[$key]['opk_n']      = $indicator['opk_n'];
            $datas[$key]['reconcile']  = false;

            if (count($reconcile) > 0) {
                $datas[$key]['reconcile']      = true;
                $ktaAc      = (isset($total['sap']['kta'])) ? ($data['kta_a'] + $total['sap']['kta']) : $data['kta_a'];
                $ttaAc      = (isset($total['sap']['tta'])) ? ($data['tta_a'] + $total['sap']['tta']) : $data['tta_a'];
                $insAc      = (isset($total['sap']['ins'])) ? ($data['ins_a'] + $total['sap']['ins']) : $data['ins_a'];
                $smeetAc    = (isset($total['sap']['s_meet'])) ? ($data['s_meet_a'] + $total['sap']['s_meet']) : $data['s_meet_a'];
                $ccAc       = (isset($total['sap']['cc'])) ? ($data['cc_a'] + $total['sap']['cc']) : $data['cc_a'];
                $wucAc      = (isset($total['sap']['wuc'])) ? ($data['wuc_a'] + $total['sap']['wuc']) : $data['wuc_a'];

                $recKta     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['kta_n'], $data['month'], $data['year']);
                $recTta     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['tta_n'], $data['month'], $data['year']);
                $recIns     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['ins_n'], $data['month'], $data['year']);
                $recCC      = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['cc_n'], $data['month'], $data['year']);
                $recWcu     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['wuc_n'], $data['month'], $data['year']);
                $recSmeet   = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['s_meet_n'], $data['month'], $data['year']);

                if (count(json_decode($data['opk_detail'])) != 0) {
                    $opkAc = (isset($total['sap']['opk'])) ? ($data['opk_a'] + $total['sap']['opk']) : $data['opk_a'];
                    @$recOpkobsA = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['opk_n'], $data['month'], $data['year']);
                    // Cegah pembagian 0
                    $opkobsAch = ($recOpkobsA > 0)
                        ? min(($opkAc / $recOpkobsA) * 100, 100)
                        : 0;

                    $datas[$key]['opk_a']    = $opkAc;
                    $datas[$key]['rec_obs']  = 0;
                    $datas[$key]['rec_opk']  = $recOpkobsA;
                    $datas[$key]['obs_ach']  = 0;
                    $datas[$key]['opk_ach']  = $opkobsAch;
                } else {
                    $obsAc = (isset($total['sap']['obs'])) ? ($data['obs_a'] + $total['sap']['obs']) : $data['obs_a'];
                    @$recOpkobsA = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $indicator['obs_n'], $data['month'], $data['year']);
                    // Cegah pembagian 0
                    $opkobsAch = ($recOpkobsA > 0)
                        ? min(($obsAc / $recOpkobsA) * 100, 100)
                        : 0;

                    $datas[$key]['obs_a']    = $obsAc;
                    $datas[$key]['rec_obs']  = $recOpkobsA;
                    $datas[$key]['rec_opk']  = 0;
                    $datas[$key]['obs_ach']  = $opkobsAch;
                    $datas[$key]['opk_ach']  = 0;
                }

                $datas[$key]['rec_kta']     = $recKta;
                $datas[$key]['rec_tta']     = $recTta;
                $datas[$key]['rec_ins']     = $recIns;
                $datas[$key]['rec_cc']      = $recCC;
                $datas[$key]['rec_wcu']     = $recWcu;
                $datas[$key]['rec_s_meet']  = $recSmeet;


                $wucAch = min(($wucAc / $recWcu) * 100, 100);
                $ccAch  = min(($ccAc / $recCC) * 100, 100);
                $insAch = min(($insAc / $recIns) * 100, 100);
                $ktaAch = min(($ktaAc / $recKta) * 100, 100);
                $ttaAch = min(($ttaAc / $recTta) * 100, 100);
                $smeetAch = min(($smeetAc / $recSmeet) * 100, 100);

                $datas[$key]['kta_ach']     = $ktaAch;
                $datas[$key]['tta_ach']     = $ttaAch;
                $datas[$key]['ins_ach']     = $insAch;
                $datas[$key]['cc_ach']      = $ccAch;
                $datas[$key]['wuc_ach']     = $wucAch;
                $datas[$key]['smeet_ach']   = $smeetAch;
                $datas[$key]['total_ach'] = round(($wucAch + $ccAch + $insAch + $ktaAch + $ttaAch + $smeetAch + $opkobsAch) / 7, 2);
            }
        }
        return $datas;
    }


    public static function getWeekRange($week, $year)
    {
        // Buat tanggal berdasarkan ISO week (Senin sebagai default)
        $dto = new DateTime();
        $dto->setISODate($year, $week);

        // Geser satu hari ke belakang agar minggu dimulai dari Minggu
        $dto->modify('-1 day');
        $startOfWeek = $dto->format('Y-m-d');

        // Akhir minggu = Sabtu (6 hari setelah Minggu)
        $dto->modify('+6 days');
        $endOfWeek = $dto->format('Y-m-d');

        return [
            'start' => $startOfWeek,
            'end'   => $endOfWeek,
        ];
    }

    public static function getStartEndOfMonth($month)
    {
        for ($i = 1; $i <= 12; $i++) {
            $start = date("Y-$month-01");
            $end   = date("Y-$month-t", strtotime($start));
            $months[] = [
                'month' => $month,
                'start' => $start,
                'end'   => $end
            ];
        }
        return $months;
    }

    public static function getColorBadge($status)
    {
        switch ($status) {
            case 'pending':
                return 'warning';
                break;
            case 'rejected':
                return 'danger';
                break;
            case 'approved':
                return 'success';
                break;
            case 'revised':
                return 'indigo';
                break;
        }
    }

    public static function getIdImage($id_sap_reconcile)
    {
        $data = FileImageReconcile::find()->where(['id_sap_reconcile' => $id_sap_reconcile])->asArray()->all();
        $id_data = [];
        foreach ($data as $row) {
            $id_data[] = [
                'id_file_image_reconcile' => $row['id_file_image_reconcile'],
                'filename' => $row['filename'],
                'filetype' => $row['filetype'],
                'filesize' => $row['filesize'],
            ];
        }
        return $id_data;
    }

    public static function cekOPKorOBS($nrp)
    {
        $mpopk = SapMpOpk::find()->where(['nrp' => $nrp])->exists();
        return $mpopk;
    }
}
