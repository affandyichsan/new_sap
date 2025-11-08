<?php

use app\models\SapReconcile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\SapReconcileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sap Reconciles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sap-reconcile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sap Reconcile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sap_reconcile',
            'id_sap_user',
            'reconcile_json:ntext',
            'jenis_reconcile',
            'week',
            //'bulan',
            //'created_at',
            //'updated_at',
            //'approvment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SapReconcile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_sap_reconcile' => $model->id_sap_reconcile]);
                 }
            ],
        ],
    ]); ?>


</div>
