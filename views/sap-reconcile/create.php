<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SapReconcile $model */

$this->title = 'Reconcile SAP';
$this->params['breadcrumbs'][] = ['label' => 'Sap Reconciles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sap-reconcile-create">

    <h6 class="mb-3"><?= Html::encode($this->title) ?></h6>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
