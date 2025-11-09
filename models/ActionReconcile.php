<?php

namespace app\models;

use DateTime;
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
}
