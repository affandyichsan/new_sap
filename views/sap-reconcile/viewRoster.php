<?php

use app\models\ActionSap;
use yii\bootstrap5\Html;

// \yii\web\YiiAsset::register($this);
$data = json_decode($model->reconcile_json);

$timeline = [];
foreach ($data as $row) {
    $timeline[] = [
        'color'     => 'warning',
        'title'     => $row->kegiatan,
        'tanggal'   => $row->tanggal,
        'status'    => $row->status
    ];
}

$getUser = ActionSap::getDataUser();

echo $this->render('_modal_dialog_id', [
    'id'        => @$datauser->id_sap_reconcile,
    'model'     => $model
]);


$status1 = ActionSap::getColorBadge($model->approvment_departement);
$status2 = ActionSap::getColorBadge($model->approvment_she);
$status3 = ActionSap::getColorBadge($model->approvment_final);
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
                <span class="badge bg-<?= $status3 ?> px-3 py-2 fs-10 shadow-sm"><?= $model->approvment_final ?></span>
            </div>
            <div class="row mt-4">
                <div class="col-4">

                    <span class="badge bg-<?= $status1 ?> px-3 py-2 fs-9 shadow-sm"><?= @$getUser['departemen'] ?> - <?= $model->approvment_departement ?></span>
                </div>
                <div class="col-4">
                    <span class="badge bg-<?= $status2 ?> px-3 py-2 fs-9 shadow-sm">SHE - <?= $model->approvment_she ?></span>
                </div>
                <div class="col-4">
                    <span class="badge bg-<?= $status3 ?> px-3 py-2 fs-9 shadow-sm">Final - <?= $model->approvment_final ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col d-grid mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $model->id_sap_reconcile  ?>">
            View Dokumen Pendukung
        </button>

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
                        <div style="width:100%;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 80%;">
                                        <span class="fw-medium"><?= Html::encode($item['title']) ?></span><br>
                                        <small class="text-muted"><?= Html::encode($item['tanggal']) ?></small>
                                    </td>
                                    <td style="width: 80%;">
                                        <span class="badge bg-<?= ActionSap::getColorBadge($item['status']) ?> px-3 py-2 fs-10 shadow-sm"><?= $item['status'] ?></span>
                                    </td>
                                </tr>
                            </table>


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
                <!-- <div class="col-auto text-end">
                    <h6 class="mb-0 fw-semibold text-dark">2:65 min</h6>
                    <p class="text-muted small mb-0">Active hours</p>
                </div> -->
            </div>
        </div>
    </div>

</div>