<?php

namespace app\controllers\rest;

use app\models\Action;
use app\models\ActionChart;
use app\models\ActionSap;
use app\models\DataKaryawan;
use app\models\SapDataView;
use app\models\SapDataViewMonthly;
use app\models\SapIndicatorPlan;
use app\models\SapIndicatorPlanMonthly;
use app\models\UserData;
use app\models\UserSettings;
use Yii;

class GrafikController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\ActionSap';

    public function actionGetDataGrafik()
    {
        $nrp = Yii::$app->user->identity->nrp;
        $data = SapDataViewMonthly::find()
            ->select(['month', 'year', 'total_ach'])
            ->where(['nrp' => $nrp])
            ->andWhere(['year' => date('Y')])
            ->asArray()
            ->all();
        $month = [];
        $total_ach = [];
        foreach ($data as $item) {
            $month[] = $item['month'];
            $total_ach[] = $item['total_ach'];
        }
        $datas = [
            'month' => $month,
            'total_ach' => $total_ach,
        ];
        return $datas;
    }

    public function actionGetDataGrafikWeekly()
    {
        $nrp = Yii::$app->user->identity->nrp;
        $data = SapDataView::find()
            ->select(['week', 'tahun', 'total_ach'])
            ->where(['nrp' => $nrp])
            ->andWhere(['tahun' => date('Y')])
            ->orderBy(['week'=>SORT_ASC])
            ->asArray()
            ->all();
        $month = [];
        $total_ach = [];
        foreach ($data as $item) {
            $month[] = $item['week'];
            $total_ach[] = $item['total_ach'];
        }
        $datas = [
            'month' => $month,
            'total_ach' => $total_ach,
        ];
        return $datas;
    }
}
