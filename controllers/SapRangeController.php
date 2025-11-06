<?php

namespace app\controllers;

use app\models\ActionSap;

class SapRangeController extends \yii\web\Controller
{
    public function actionPerminggu()
    {
        
        $listWeek   = ActionSap::getPeriodeWeekly();
        return $this->render('index',[
            'listWeek' => $listWeek
        ]);
    }

}
