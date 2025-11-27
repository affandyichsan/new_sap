<?php

use app\models\ActionSap;
use app\models\FileImageReconcile;
use yii\bootstrap5\Html;

// \yii\web\YiiAsset::register($this);
$data = json_decode($model->reconcile_json);
$timeline = [];


@$getUser = ActionSap::getDataUser();
// echo "<pre>";
// print_r($getUser['departemen']);
// exit;
$fileImage = ActionSap::getIdImage($model->id_sap_reconcile);

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
                    <p class="small text-muted mb-1">Proses Approval <b><?= strtoupper($model->jenis_reconcile) . ' - ' . strtoupper($model->sub_jenis_reconcile) ?></b></p>
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
    <!-- Card Riwayat Reconcile -->
    <div class="card shadow-sm rounded-3 border-0">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="fw-semibold mb-0">
                <i class="bi bi-clock-history me-1"></i> File Upload Reconcile SAP - <?= strtoupper($model->sub_jenis_reconcile) ?>
            </h6>
        </div>

        <div class="card-body bg-light">
            <?php foreach ($fileImage as $img): ?>
                <div class="card mb-1 text-start file-item"
                    data-id="<?= $img['id_file_image_reconcile'] ?>"
                    data-bs-toggle="modal"
                    data-bs-target="#fileModal">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-44 shadow-sm rounded-15 bg-warning text-white">
                                    <?= strtoupper($model->sub_jenis_reconcile) ?>
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p class="mb-0 size-12 text-muted"><?= $img['filename'] ?></p>
                                <p><?= $img['filetype'] ?> - <?= $img['filesize'] ?>kb</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <i class="bi bi-chevron-right text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?= $this->render('_modal_dialog_id_sap'); ?>
        
        <div class="card-footer bg-white border-top py-3">
            <div class="row align-items-center">
                <div class="col">
                    <p class="text-muted small mb-0 ms-1">
                        <i class="bi bi-calendar3 me-1"></i>
                        <?= indonesian_date2($model->created_at) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>