<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SapReconcile $model */

$this->title = $model->id_sap_reconcile;
$this->params['breadcrumbs'][] = ['label' => 'Sap Reconciles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sap-reconcile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_sap_reconcile' => $model->id_sap_reconcile], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_sap_reconcile' => $model->id_sap_reconcile], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_sap_reconcile',
            'id_sap_user',
            'reconcile_json:ntext',
            'jenis_reconcile',
            'week',
            'bulan',
            'created_at',
            'updated_at',
            'approvment',
        ],
    ]) ?>

</div>
