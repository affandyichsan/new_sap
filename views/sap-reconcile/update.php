<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SapReconcile $model */

$this->title = 'Update Sap Reconcile: ' . $model->id_sap_reconcile;
$this->params['breadcrumbs'][] = ['label' => 'Sap Reconciles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sap_reconcile, 'url' => ['view', 'id_sap_reconcile' => $model->id_sap_reconcile]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sap-reconcile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
