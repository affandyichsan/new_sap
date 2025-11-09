<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\ActionReconcile;

/** @var yii\web\View $this */
/** @var app\models\search\SapReconcileSearch $model */
/** @var yii\widgets\ActiveForm $form */
$data = ActionReconcile::listWeek();
$weekList = array_combine($data, array_map(fn($w) => 'week ' . $w, $data));

// echo '<pre>';
// print_r($data);
// exit;
?>

<div class="sap-reconcile-search mb-3">

    <div class="accordion shadow-sm rounded-4" id="accordionSearch">
        <div class="accordion-item border-0 rounded-4">
            <h2 class="accordion-header" id="headingSearch">
                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch" style="font-size:14px;">
                    🔍 Filter Pencarian
                </button>
            </h2>

            <div id="collapseSearch" class="accordion-collapse collapse" aria-labelledby="headingSearch" data-bs-parent="#accordionSearch">
                <div class="accordion-body">

                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                        'options' => ['class' => 'p-2'],
                    ]); ?>

                    <?= $form->field($model, 'jenis_reconcile')->dropDownList([
                        ''          => 'Jenis Reconcile...',
                        'roster'    => 'Roster',
                        'sap'       => 'SAP',
                    ], [
                        'class' => 'form-select shadow-sm rounded-2',
                    ])->label(false) ?>

                    <?= $form->field($model, 'week')->dropDownList(
                        $weekList, // ini array dari ActionReconcile::listWeek()
                        [
                            'prompt'    => 'Pilih Week',
                            'class'     => 'form-select shadow-sm rounded-2',
                        ]
                    )->label(false) ?>

                    <?= $form->field($model, 'approvment_final')->dropDownList([
                        '' => 'Pilih Status Approval...',
                        'Pending'   => 'Pending',
                        'Approved'  => 'Approved',
                        'Rejected'  => 'Rejected',
                    ], [
                        'class' => 'form-select shadow-sm rounded-2',
                    ])->label(false) ?>

                    <div class="d-flex justify-content-between mt-3">
                        <?= Html::submitButton('<i class="icofont-search"></i> Search', [
                            'class' => 'btn btn-primary rounded-2 shadow-sm px-4 py-2'
                        ]) ?>

                        <?= Html::a('<i class="icofont-close"></i> Reset', ['index'], ['class' => 'btn btn-outline-secondary rounded-2 shadow-sm px-4 py-2']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===============================
   STYLE KHUSUS SEARCH ACCORDION
=============================== */
    .accordion-button {
        background-color: #f8f9fa;
        border-radius: 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e9f0ff;
        color: #0d6efd;
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.1);
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .accordion-body {
        background-color: #fff;
        border-radius: 0 0 16px 16px;
    }

    .form-control {
        font-size: 13px;
        border-radius: 10px;
        box-shadow: none !important;
    }

    .select2-container--krajee-bs5 .select2-selection {
        border-radius: 10px !important;
        min-height: 38px;
        font-size: 13px;
        box-shadow: none !important;
    }

    .select2-container--krajee-bs5 .select2-selection__arrow {
        top: 7px;
    }

    .btn {
        font-size: 13px;
    }

    /* Hover efek halus */
    .btn:hover {
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
</style>