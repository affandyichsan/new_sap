<?php

use yii\helpers\Url;

?>
<div class="card shadow-lg rounded-4 disabled-card" style="max-width: 100%;">
    <div class="card-body p-4 justify-content-between align-items-center " style="font-size: 12px;">
        <div class="row d-flex">
            <div class="col-4 d-flex flex-column align-items-center text-center">
                <img src="<?= Url::base() ?>/assets_web/images/safe-strong.png" class="img-fluid mb-1" style="max-width:100%;" />
                <small class="text-muted d-block">Update</small>
                <small class="text-muted d-block"><?= @$data['updated_at'] ?></small>
                <small class="text-muted d-block" style="font-size: 8px;">Jobsite BIB (Borneo IndoBara)</small>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center text-center">
                <h1 class="display-5 fw-bold text-primary mb-0"><?= @$data['week'] ?></h1>
                <small class="text-muted">WEEK</small>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center text-center">
                <img src="<?= Url::base() ?>/assets_web/images/logo-PPA.png" class="img-fluid mb-1" style="max-width: 60px;" />
                <span class="badge bg-primary"><?= @$periode ?></span>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center mb-2 mt-3">
            <div class="fw-semibold fs-5"><?= @$data['nama_karyawan'] ?></div>
            <small class="text-muted"><?= @$data['departement'] ?> | <?= @$data['jabatan'] ?></small>
        </div>

        <div class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 mb-2">
            <div class="text-center">
                <span class="badge bg-danger">NIK</span><br />
                <div class="fw-bold fs-10"><?= @$data['nrp_bib'] ?></div>
            </div>
            <div class="text-center">
                <span class="badge bg-danger">CUTI</span><br />
                <span class="badge bg-primary"><?= @$cutiStart ?> - <?= @$cutiEnd ?></span>
            </div>
        </div>

        <!-- Bagian CUTI -->
        <div class="cuti-section bg-secondary text-white rounded-3 p-3 mb-2 d-flex justify-content-center align-items-center">
            <h1 class="m-0 fw-bold">CUTI</h1>
        </div>


        <div class="alert alert-warning mt-4" role="alert" style="font-size: 12px;">
            <strong>Target Monitoring dan Pencapaian SAP per Weekly.</strong><br>
            Hanya berlaku per weekly.
        </div>

        <div class="text-center text-muted small border-top pt-3" style="font-size: 12px;">
            Silahkan melakukan rekonsiliasi melalui SIC jika pencapaian tidak sesuai.<br>
            Hubungi SHE Information Center (SIC): <strong>0853-4880-0759</strong> atau
            <a href="https://kirimwa.id/sic" class="link-primary">klik disini</a>
        </div>
    </div>
</div>

<style>
    /* Efek disabled abu-abu seluruh card */
    .disabled-card {
        filter: grayscale(90%) brightness(0.9);
        opacity: 0.7;
        pointer-events: none;
    }

    /* Bagian tulisan CUTI di tengah */
    .cuti-section {
        height: 100px;
        background: linear-gradient(135deg, #6c757d, #adb5bd);
        color: white;
        text-align: center;
        justify-content: center;
        align-items: center;
        display: flex;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .cuti-section h1 {
        font-size: 2rem;
        letter-spacing: 2px;
    }
</style>
