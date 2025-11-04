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
            ->andWhere(['tahun'=>date('Y')])
            ->asArray()
            ->one();
        return $data;
    
    }

    public static function getDataUser(){
        $data = DataKaryawan::find()
            ->where(['nrp' => @Yii::$app->user->identity->nrp])
            ->asArray()
            ->one();
        return $data;
    }
}
