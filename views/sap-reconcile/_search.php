<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\SapReconcileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sap-reconcile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_sap_reconcile') ?>

    <?= $form->field($model, 'id_sap_user') ?>

    <?= $form->field($model, 'reconcile_json') ?>

    <?= $form->field($model, 'jenis_reconcile') ?>

    <?= $form->field($model, 'week') ?>

    <?php // echo $form->field($model, 'bulan') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'approvment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
