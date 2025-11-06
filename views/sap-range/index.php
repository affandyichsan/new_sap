<?php

/** @var yii\web\View $this */

use app\models\ActionSap;
use yii\helpers\Url;

?>

<!-- Search -->
<div class="form-group mb-3">
    <input type="text" class="form-control " id="search" placeholder="Search">
    <button type="button" class="text-color-theme tooltip-btn">
        <i class="bi bi-search"></i>
    </button>
</div>
<div class="row position-relative bg-dark text-white py-4">
    <div class="row">
        <div class="col-3 text-center">
            <div id="myAnimation" style="width:150px; height:150px; margin-top:-40px;"></div>
        </div>
        <div class="col-9 text-center">
            <div class="col-12 col-md-6 col-lg-4 mx-auto align-self-center z-index-1 text-center mt-4">
                <h5 class=" mb-2">SAP ( Safety Accountability Program )</h5>
                <p class="text-center small">Cek SAPmu Per-Week di Tahun <?= date('Y') ?>.</p>
            </div>
        </div>
    </div>
</div>

<!-- User list items  -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm mb-4">
            <ul class="list-group list-group-flush bg-none">
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
                    <li class="list-group-item <?= $bg ?> text-white">
                        <div class="row">
                            <div class="col-auto">
                                <figure class="avatar avatar-50 rounded-15 shadow-sm bg-white text-dark">
                                    <b><?= $data['week'] ?></b>
                                </figure>
                            </div>
                            <div class="col px-0">
                                <p class="text-muted size-12 mt-2" style="margin-bottom: -1px;"><?= $date['start'] ?> to <?= $date['end'] ?></p>
                                <h6> <?= $total_ach ?></h6>
                            </div>
                            <div class="col-auto text-end">
                                <a href="<?= Url::base() ?>/sap-range/detail-perminggu?week=<?= $data['week'] ?>" class="btn btn-default btn-44 shadow-sm rounded">
                                    <i class="icofont-list"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>


<script>
    var animation = lottie.loadAnimation({
        container: document.getElementById('myAnimation'), // elemen DOM
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '<?= Url::base() ?>/images/json/Data Analysis.json' // lokasi file JSON Anda
    });

    // Contoh: event ketika animasi selesai
    animation.addEventListener('complete', function() {
        console.log('Animasi selesai');
    });
</script>