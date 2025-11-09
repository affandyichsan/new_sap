<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SapReconcile $model */

$this->title = "Detail Reconcile #" . $model->id_sap_reconcile;
$this->params['breadcrumbs'][] = ['label' => 'SAP Reconcile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
$data = json_decode($model->reconcile_json);
$timeline = [];
foreach ($data->tanggal as $row) {
    $timeline[] = [
        'color' => 'danger',
        'title' => $data->kegiatan,
        'tanggal' => $row
    ];
}

// echo "<pre>";
// print_r($timeline);
// exit;
?>

<div class="sap-reconcile-view">

    <!-- Card Status Approval -->
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="small text-muted mb-1">Proses Approval</p>
                    <h6 class="mb-0 fw-semibold">Admin Departemen</h6>
                </div>
                <span class="badge bg-success px-3 py-2 fs-6 shadow-sm">Pending</span>
            </div>
        </div>
    </div>

    <!-- Card Riwayat Reconcile -->
    <div class="card shadow-sm rounded-3 border-0">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="fw-semibold mb-0">
                <i class="bi bi-clock-history me-1"></i> Riwayat Reconcile
            </h6>
        </div>

        <div class="card-body bg-light">
            <ul class="list-group list-group-flush w-100 log-information">
                <?php
                // $timeline;

                foreach ($timeline as $item): ?>
                    <li class="list-group-item d-flex align-items-start">
                        <div class="me-3 mt-1">
                            <span class="avatar avatar-15 border-<?= $item['color'] ?> rounded-circle d-inline-block" style="width:12px; height:12px;"></span>
                        </div>
                        <div>
                            <span class="fw-medium"><?= Html::encode($item['title']) ?></span><br>
                            <small class="text-muted"><?= Html::encode($item['tanggal']) ?></small>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="card-footer bg-white border-top py-3">
            <div class="row align-items-center">
                <div class="col">
                    <p class="text-muted small mb-0 ms-1">
                        <i class="bi bi-calendar3 me-1"></i>
                        <?= indonesian_date2($model->created_at) ?>
                    </p>
                </div>
                <div class="col-auto text-end">
                    <h6 class="mb-0 fw-semibold text-dark">2:65 min</h6>
                    <p class="text-muted small mb-0">Active hours</p>
                </div>
            </div>
        </div>
    </div>

</div>