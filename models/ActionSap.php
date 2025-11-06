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
    public static function getCountDataSAP()
    {
        $week = ActionSap::getWeeksSunToSatThisYear();
        $weekToday = max($week)['week'];
        $data = SapDataView::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['week' => $weekToday])
            ->andWhere(['tahun' => date('Y')])
            ->asArray()
            ->one();
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
        $data = SapDataView::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->andWhere(['tahun' => date('Y')])
            ->asArray()
            ->all();
        return $data;
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
}
