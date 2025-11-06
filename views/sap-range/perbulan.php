<?php

use yii\helpers\Url;

?>
<div class="card shadow-lg rounded-4" style="max-width: 100%;">
    <div class="card-body p-4 justify-content-between align-items-center " style="font-size: 12px;">
        <div class="row d-flex">
            <div class="col-4 d-flex flex-column align-items-center text-center">
                <img src="<?= Url::base() ?>/assets_web/images/safe-strong.png" class="img-fluid mb-1" style="max-width;100%;" />
                <small class="text-muted d-block">Update</small>
                <small class="text-muted d-block"><?= @$data['updated_at'] ?></small>

                <small class="text-muted d-block" style="font-size: 8px;">Jobsite BIB (Borneo IndoBara)</small>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center text-center">
                <h1 class="display-5 fw-bold text-primary mb-0"><?= @$data['month'] ?></h1>
                <small class="text-muted">WEEK</small>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center text-center">
                <img src="<?= Url::base() ?>/assets_web/images/logo-PPA.png" class="img-fluid mb-1" style="max-width: 60px;" />
                <span class="badge bg-primary"><?= @$periode ?></span>
            </div>
        </div>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
            <div>

            </div>
            <div class="text-center">

            </div>
            <div class="align-items-center">

            </div>
        </div>

        <!-- Profile -->
        <div class="d-flex flex-column align-items-center mb-2">
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

        <!-- Target -->
        <h5 class="fw-bold mb-3">Target Per Week</h5>
        <div class="row text-center fw-semibold border-bottom pb-2">
            <div class="col-4"><b>Kategori</b></div>
            <div class="col-4"><b>Target</b></div>
            <div class="col-4"><b>Actual</b></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col-4"><b>KTA</b></div>
            <div class="col-4"><?= @$data['kta'] ?></div>
            <div class="col-4"><?= @$data['tta'] ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col-4"><b>TTA</b></div>
            <div class="col-4"><?= @$data['tta'] ?></div>
            <div class="col-4"><?= @$data['tta_a'] ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col-4"><b>Observasi</b></div>
            <div class="col-4"><?= @$data['obs'] ?></div>
            <div class="col-4"><?= @$data['obs_a'] ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col-4"><b>Inspeksi</b></div>
            <div class="col-4"><?= @$data['ins'] ?></div>
            <div class="col-4"><?= @$data['ins_a'] ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col-4"><b>Safety Meeting</b></div>
            <div class="col-4"><?= @$data['s_meet'] ?></div>
            <div class="col-4"><?= @$data['s_meet_a'] ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col-4"><b>CC</b></div>
            <div class="col-4"><?= @$data['cc'] ?></div>
            <div class="col-4"><?= @$data['cc_a'] ?></div>
        </div>
        <div class="row text-center py-2">
            <div class="col-4"><b>WUC</b></div>
            <div class="col-4"><?= @$data['wuc'] ?></div>
            <div class="col-4"><?= @$data['wuc_a'] ?></div>
        </div>

        <!-- Progress -->
        <div class="mt-4">
            <label class="form-label fw-semibold">Pencapaian</label>
            <?php
            $total_ach = '';
            if (@$data['total_ach'] === 'CUTI') {
                $total_ach = 'CUTI';
            } else {
                $total_ach = (float)@$data['total_ach'];
            }
            echo $total_ach . '%';
            ?>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success fw-bold" role="progressbar" style="width: <?= @$total_ach ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><?= @$total_ach ?></div>
            </div>
        </div>

        <!-- Notes -->
        <div class="alert alert-warning mt-4" role="alert" style="font-size: 12px;">
            <strong>Target Monitoring dan Pencapaian SAP per monthly.</strong><br>
            Hanya berlaku per monthly.
        </div>

        <!-- Footer -->
        <div class="text-center text-muted small border-top pt-3" style="font-size: 12px;">
            Silahkan melakukan rekonsiliasi melalui SIC jika pencapaian tidak sesuai.<br>
            Hubungi SHE Information Center (SIC): <strong>0853-4880-0759</strong> atau
            <a href="https://kirimwa.id/sic" class="link-primary">klik disini</a>
        </div>

    </div>
</div>