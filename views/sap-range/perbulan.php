<?php

use app\models\ActionReconcile;
use app\models\ActionSap;
use yii\helpers\Html;
use yii\helpers\Url;

$reconcile  = ActionReconcile::ReconcileThisMonth(@$data['month']);
$total      = ActionReconcile::totalReconcile($reconcile);
$akumulasi  = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['opk_n'], $data['month'], $data['year']);

if ($total['roster'] > 0) {
    @$header    = '<div class="col"><b>Rec-Target</b></div>';
    @$kta       = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['kta_n'], $data['month'], $data['year']) . "</div>";
    @$tta       = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['tta_n'], $data['month'], $data['year']) . "</div>";
    @$ins       = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['ins_n'], $data['month'], $data['year']) . "</div>";
    @$s_meet    = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['s_meet_n'], $data['month'], $data['year']) . "</div>";
    @$cc        = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['cc_n'], $data['month'], $data['year']) . "</div>";
    @$wuc       = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['wuc_n'], $data['month'], $data['year']) . "</div>";
    if (count(json_decode($data['opk_detail'])) != 0) {
        @$opkobsA = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['opk_n'], $data['month'], $data['year']) . "</div>";
    } else {
        @$opkobsA = '<div class="col">' . ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['obs_n'], $data['month'], $data['year']) . "</div>";
    }
}

if ($total['sap'] > 0) {
    $opka   = (isset($total['sap']['opk'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['opk_a'] + $total['sap']['opk']) . '</span>' : $data['opk_a'];
    $obsa   = (isset($total['sap']['obs'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['obs_a'] + $total['sap']['obs']) . '</span>' : $data['obs_a'];
    $ktaa   = (isset($total['sap']['kta'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['kta_a'] + $total['sap']['kta']) . '</span>' : $data['kta_a'];
    $ttaa   = (isset($total['sap']['tta'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['tta_a'] + $total['sap']['tta']) . '</span>' : $data['tta_a'];
    $insa   = (isset($total['sap']['ins'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['ins_a'] + $total['sap']['ins']) . '</span>' : $data['ins_a'];
    $smeeta   = (isset($total['sap']['s_meet'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['s_meet_a'] + $total['sap']['s_meet']) . '</span>' : $data['s_meet_a'];
    $cca   = (isset($total['sap']['cc'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['cc_a'] + $total['sap']['cc']) . '</span>' : $data['cc_a'];
    $wuca   = (isset($total['sap']['wuc'])) ? '<span class="badge bg-info" style="font-size: 12px;">' . ($data['wuc_a'] + $total['sap']['wuc']) . '</span>' : $data['wuc_a'];
}

if (count($reconcile) > 0) {
    $ktaAc      = (isset($total['sap']['kta'])) ? ($data['kta_a'] + $total['sap']['kta']) : $data['kta_a'];
    $ttaAc      = (isset($total['sap']['tta'])) ? ($data['tta_a'] + $total['sap']['tta']) : $data['tta_a'];
    $insAc      = (isset($total['sap']['ins'])) ? ($data['ins_a'] + $total['sap']['ins']) : $data['ins_a'];
    $smeetAc    = (isset($total['sap']['s_meet'])) ? ($data['s_meet_a'] + $total['sap']['s_meet']) : $data['s_meet_a'];
    $ccAc       = (isset($total['sap']['cc'])) ? ($data['cc_a'] + $total['sap']['cc']) : $data['cc_a'];
    $wucAc      = (isset($total['sap']['wuc'])) ? ($data['wuc_a'] + $total['sap']['wuc']) : $data['wuc_a'];

    $recKta     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['kta_n'], $data['month'], $data['year']);
    $recTta     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['tta_n'], $data['month'], $data['year']);
    $recIns     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['ins_n'], $data['month'], $data['year']);
    $recCC      = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['cc_n'], $data['month'], $data['year']);
    $recWcu     = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['wuc_n'], $data['month'], $data['year']);
    $recSmeet   = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['s_meet_n'], $data['month'], $data['year']);
    if (count(json_decode($data['opk_detail'])) != 0) {
        $opkAc          = (isset($total['sap']['opk'])) ? ($data['opk_a'] + $total['sap']['opk']) : $data['opk_a'];
        @$recOpkobsA    = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['opk_n'], $data['month'], $data['year']);
        $opkobsAch      = min(($opkAc / $recOpkobsA) * 100, 100);
    } else {
        $obsAc          = (isset($total['sap']['obs'])) ? ($data['obs_a'] + $total['sap']['obs']) : $data['obs_a'];
        @$recOpkobsA    = ActionReconcile::akumulasiReconcileMonth($data['note_per_date'], $total['roster'], $data['obs_n'], $data['month'], $data['year']);
        $opkobsAch      = min(($obsAc / $recOpkobsA) * 100, 100);
    }
    $wucAch = min(($wucAc / $recWcu) * 100, 100);
    $ccAch  = min(($ccAc / $recCC) * 100, 100);
    $insAch = min(($insAc / $recIns) * 100, 100);
    $ktaAch = min(($ktaAc / $recKta) * 100, 100);
    $ttaAch = min(($ttaAc / $recTta) * 100, 100);
    $smeetAch = min(($smeetAc / $recSmeet) * 100, 100);
    $data['total_ach'] = round(($wucAch + $ccAch + $insAch + $ktaAch + $ttaAch + $smeetAch + $opkobsAch) / 7, 2);
}

// echo "<pre>";
// print_r($data);
// print_r($data['ins_a'].' ');
// print_r($insAc.' ');
// print_r($recIns.' ');
// print_r($insAch.' ');
// print_r($data);
// exit;
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
                <small class="text-muted">MONTH</small>
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
                <?php if (count($reconcile) > 0) { ?>
                    <span class="badge bg-info">RECONCILE</span>
                <?php } ?>
            </div>
            <div class="text-center">
                <span class="badge bg-danger">CUTI</span><br />
                <span class="badge bg-primary"><?= @$cutiStart ?> - <?= @$cutiEnd ?></span>
            </div>
        </div>

        <!-- Target -->
        <h5 class="fw-bold mb-3">Target Per Month</h5>
        <div class="row text-center fw-semibold border-bottom pb-2">
            <div class="col"><b>Kategori</b></div>
            <div class="col"><b>Target</b></div>
            <?= @$header ?>
            <div class="col"><b>Actual</b></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col"><b>KTA</b></div>
            <div class="col"><?= @$data['kta'] ?></div>
            <?= @$kta ?>
            <div class="col"><?= @$ktaa ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col"><b>TTA</b></div>
            <div class="col"><?= @$data['tta'] ?></div>
            <?= @$tta ?>
            <div class="col"><?= @$ttaa ?></div>
        </div>
        <?php if (@$data['opk_detail'] == null) { ?>
            <div class="row text-center py-2 border-bottom">
                <div class="col"><b>Observasi</b></div>
                <div class="col"><?= @$data['obs'] ?></div>
                <?= @$opkobsA ?>
                <div class="col"><?= @$obsa ?></div>
            </div>
        <?php } else { ?>
            <div class="row text-center py-2 border-bottom">
                <div class="col"><b>OPK</b></div>
                <div class="col"><?= @$data['opk'] ?></div>
                <?= @$opkobsA ?>
                <div class="col"><?= @$opka ?></div>
            </div>
        <?php } ?>
        <div class="row text-center py-2 border-bottom">
            <div class="col"><b>Inspeksi</b></div>
            <div class="col"><?= @$data['ins'] ?></div>
            <?= @$ins ?>
            <div class="col"><?= @$insa ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col"><b>Safety Meeting</b></div>
            <div class="col"><?= @$data['s_meet'] ?></div>
            <?= @$s_meet ?>
            <div class="col"><?= @$smeeta ?></div>
        </div>
        <div class="row text-center py-2 border-bottom">
            <div class="col"><b>CC</b></div>
            <div class="col"><?= @$data['cc'] ?></div>
            <?= @$cc ?>
            <div class="col"><?= @$cca ?></div>
        </div>
        <div class="row text-center py-2">
            <div class="col"><b>WUC</b></div>
            <div class="col"><?= @$data['wuc'] ?></div>
            <?= @$wuc ?>
            <div class="col">
                <?= @$wuca ?>
            </div>
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
        <ul class="list-group list-group-flush" style="font-size: 13px;">
            <?php
            foreach ($reconcile as $model):
                $status = ActionSap::getColorBadge(@$model['approvment_final']);
            ?>
                <li class="list-group-item border-0 border-bottom py-3 px-2">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Avatar Minggu (square rounded) -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-2 d-flex justify-content-center align-items-center bg-<?= $status ?> text-white fw-bold shadow-sm"
                                style="width: 50px; height: 50px; font-size: 19px;">
                                <table>
                                    <tr>
                                        <td style="align-content: center;font-size: 8px; margin-bottom:-10px;">Month</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?= Html::encode($model['bulan']) ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="ms-3">
                                <div class="fw-semibold text-dark" style="font-size: 13px;">
                                    Reconcile <?= strtoupper(Html::encode($model['jenis_reconcile'])) ?>
                                </div>
                                <div class="small mb-1">
                                    <?php
                                    if ($model['jenis_reconcile'] == 'sap') {
                                        $count = 0;
                                        foreach (json_decode($model['reconcile_json']) as $row) {
                                            if ($row->status == 'approved') {
                                                $count += 1;
                                            }
                                        }
                                        $infoJumlah = $count . ' ' . $model['sub_jenis_reconcile'];
                                    } else {

                                        $count = 0;
                                        $infos = '';
                                        foreach (json_decode($model['reconcile_json']) as $row) {
                                            if ($row->status  == 'approved') {
                                                $count += 1;
                                                $infos = $row->kegiatan;
                                            }
                                        }
                                        $infoJumlah = $count . ' hari ' . $infos;
                                    }
                                    ?>
                                    <span class="badge bg-<?= $status ?>"> <?= Html::encode($model['approvment_final']) ?> </span> - <?= $infoJumlah ?>
                                </div>
                                <div class="text-muted small">
                                    Pengajuan <?= indonesian_date2($model['created_at']) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Detail -->
                        <div>
                            <a href="<?= Url::to(['/sap-reconcile/view?id_sap_reconcile=' . $model['id_sap_reconcile'] . '']) ?>"
                                class="btn btn-light border rounded-3 shadow-sm p-2"
                                style="width: 36px; height: 36px; display:flex; align-items:center; justify-content:center;">
                                <i class="icofont-list text-<?= $status ?>" style="font-size: 16px;"></i>
                            </a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- Notes -->
        <div class="alert alert-warning mt-4" role="alert" style="font-size: 12px;">
            <strong>Target Monitoring dan Pencapaian SAP per Monthly.</strong><br>
            Reconcile Hanya berlaku per weekly.
        </div>

        <!-- Footer -->
        <div class="text-center small border-top pt-3" style="font-size: 12px;">
            Silahkan melakukan rekonsiliasi melalui ASIC jika pencapaian tidak sesuai.
        </div>

        <p class="text-center mt-2">
            <?= Html::a('<i class="icofont-plus-circle"></i> Reconcile', ['/sap-reconcile/create'], [
                'class' => 'btn btn-success rounded-3 px-4 py-2 text-white',
                'style' => 'font-size:13px; width:100%;'
            ]) ?>
        </p>
    </div>
</div>