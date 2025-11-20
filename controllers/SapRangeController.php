<?php

namespace app\controllers;

use app\models\ActionSap;

class SapRangeController extends \yii\web\Controller
{
    public function actionPerminggu()
    {

        $listWeek   = ActionSap::getPeriodeWeekly();
        return $this->render('index', [
            'listWeek' => $listWeek
        ]);
    }

    public function actionDetailPerminggu($week)
    {
        $data = @ActionSap::getCountDataSAP($week);
        $cuti = @json_decode($data['note_per_date']);

        // pastikan data cuti valid array
        $cutiArray = is_array($cuti) ? $cuti : (array)$cuti;

        if (!empty($cutiArray)) {
            // ambil semua tanggal
            $tanggalList = array_column($cutiArray, 'tanggal');

            $cutiStart = min($tanggalList);
            $cutiEnd   = max($tanggalList);
        } else {
            $cutiStart = null;
            $cutiEnd   = null;
        }
        if ($data['total_ach'] === 'CUTI') {
            return $this->render('cuti', [
                'data' => $data,
                'cutiStart' => $cutiStart,
                'cutiEnd' => $cutiEnd,
            ]);
        } else {
            return $this->render('perminggu', [
                'data' => $data,
                'cutiStart' => $cutiStart,
                'cutiEnd' => $cutiEnd,
            ]);
        }
    }
    // =========================================================================================================================================
    // =========================================================================================================================================
    // =========================================================================================================================================
    // =========================================================================================================================================
    public function actionPerbulan()
    {
        $listmonth   = ActionSap::getPeriodeMonthly();
        // echo "<pre>";
        // print_r($listmonth);
        // exit;
        return $this->render('index_monthly', [
            'listmonth' => $listmonth
        ]);
    }
    
    public function actionDetailPerbulan($month)
    {
        $data = @ActionSap::getCountDataSAPMonthly($month, date('Y'));
        $cuti = @json_decode($data['note_per_date']);

        // pastikan data cuti valid array
        $cutiArray = is_array($cuti) ? $cuti : (array)$cuti;

        if (!empty($cutiArray)) {
            // ambil semua tanggal
            $tanggalList = array_column($cutiArray, 'tanggal');

            $cutiStart = min($tanggalList);
            $cutiEnd   = max($tanggalList);
        } else {
            $cutiStart = null;
            $cutiEnd   = null;
        }
        if ($data['total_ach'] === 'CUTI') {
            return $this->render('cuti', [
                'data' => $data,
                'cutiStart' => $cutiStart,
                'cutiEnd' => $cutiEnd,
            ]);
        } else {
            return $this->render('perbulan', [
                'data' => $data,
                'cutiStart' => $cutiStart,
                'cutiEnd' => $cutiEnd,
            ]);
        }
    }
}
