<?php

/** @var yii\web\View $this */

use app\models\ActionSap;
use yii\helpers\Url;

?>
<!-- welcome user -->
<div class="row mb-4">
    <div class="col-auto">
        <div class="avatar avatar-50 shadow rounded-15">
            <img src="<?= Url::base() ?>/assets_web/images/unknow-people.png" alt="">
        </div>
    </div>
    <div class="col align-self-center ps-0">
        <h6 class="text-color-theme"><span class="fw-normal">Hi</span>, <?= @$data['nama_karyawan'] ?></h6>
        <p class="text-muted" style="font-size: 12px;"><?= @$data['departemen'] . ' | ' . @$data['jabatan'] . ' | ' . @$data['golongan_jabatan'] ?></p>
    </div>
</div>

<!-- swiper credit cards -->

<div class="row mb-3">
    <div class="col">
        <h6 class="title">Pencapaian Per-Weekly</h6>
    </div>
    <div class="col-auto">
        <a href="<?= Url::base() ?>/sap-range/perminggu" class="small">View all</a>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12 px-0">
        <div class="swiper-container cardswiper">
            <div class="swiper-wrapper">
                <?php foreach ($listWeek as $data) {
                    $date = ActionSap::getWeekRange($data['week'], date('Y'));
                    $bg = '';
                    $total_ach = '';
                    if ($data['total_ach'] == 'CUTI') {
                        $total_ach = 'CUTI';
                        $bg = 'bg-dark';
                    } else {
                        if ($data['total_ach'] > 95) {
                            $bg = 'bg-success';
                        } elseif ($data['total_ach'] > 60) {
                            $bg = 'bg-primary';
                        } elseif ($data['total_ach'] > 50) {
                            $bg = 'bg-warning';
                        } else {
                            $bg = 'bg-danger';
                        }

                        $total_ach = $data['total_ach'] . '%';
                    }
                ?>
                    <div class="swiper-slide">
                        <div class="card <?= @$bg ?>">
                            <div class="card-body ">
                                <div class="row mb-3">
                                    <div class="col-auto align-self-center">
                                        <img src="assets/img/masterocard.png" alt="">
                                    </div>
                                    <div class="col align-self-center text-end">
                                        <p class="small">
                                            <span class="text-uppercase size-10">WEEK <?= $data['week'] ?></span><br>
                                            <span class="text-muted" style="font-size: 10px;"><?= $date['start'] . ' - ' . $date['end'] ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="fw-normal mb-2">
                                            <?= $total_ach ?>
                                        </h4>
                                        <p class="mb-0 text-muted" style="font-size: 9px;">KTA : <?= $data['kta_ach'] ?>% | TTA : <?= $data['tta_ach'] ?>% | OBS : <?= $data['obs_ach'] ?>% | INS : <?= $data['ins_ach'] ?>%</p>
                                        <p class="mb-0 text-muted" style="font-size: 9px;">WUC : <?= $data['wuc_ach'] ?>% | CC : <?= $data['cc_ach'] ?>% | S MEET : <?= $data['smeet_ach'] ?>% | OPK : <?= $data['opk_ach'] ?>%</p>
                                        <!-- <p class="text-muted size-12">Debit Card</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>