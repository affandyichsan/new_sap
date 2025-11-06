<?php

namespace app\controllers;

use app\models\ActionSap;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $data       = ActionSap::getDataUser();
        $listWeek   = ActionSap::getPeriodeWeekly();
        // echo "<pre>";
        // print_r($listWeek);exit;
        return $this->render('index',[
            'data' => $data,
            'listWeek' => $listWeek
        ]);
    }

}
