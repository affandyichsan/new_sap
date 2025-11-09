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
            ->distinct()
            ->asArray()
            ->orderBy(['week' => SORT_DESC])
            ->all();
        return array_column($data, 'week');
    }
}