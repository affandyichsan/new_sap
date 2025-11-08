<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SapReconcile $model */

$this->title = 'Create Sap Reconcile';
$this->params['breadcrumbs'][] = ['label' => 'Sap Reconciles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sap-reconcile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
