<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SapReconcile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sap-reconcile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sap_user')->textInput() ?>

    <?= $form->field($model, 'reconcile_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis_reconcile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'week')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'approvment')->dropDownList([ 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'revised' => 'Revised', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
