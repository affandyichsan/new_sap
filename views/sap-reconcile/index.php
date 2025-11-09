<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $models */

$this->title = 'SAP Reconcile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sap-reconcile-index container py-3">

    <h5 class="fw-bold text-center mb-4"><?= Html::encode($this->title) ?></h5>

    <p class="text-center mb-4">
        <?= Html::a('<i class="icofont-plus-circle"></i> Create Reconcile', ['create'], [
            'class' => 'btn btn-success rounded-3 shadow-sm px-4 py-2 text-white',
            'style' => 'font-size:13px;'
        ]) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card border-0 shadow-sm rounded-4">
        <ul class="list-group list-group-flush" style="font-size: 13px;">
            <?php foreach ($models as $model): ?>
                <li class="list-group-item border-0 border-bottom py-3 px-2">
                    <div class="d-flex align-items-center justify-content-between">
                        
                        <!-- Avatar Minggu (square rounded) -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-2 d-flex justify-content-center align-items-center bg-primary text-white fw-bold shadow-sm" 
                                 style="width: 50px; height: 50px; font-size: 19px;">
                                <?= Html::encode($model['week']) ?>
                            </div>
                            <div class="ms-3">
                                <div class="fw-semibold text-dark" style="font-size: 13px;">
                                    <?= Html::encode($model['jenis_reconcile']) ?>
                                </div>
                                <div class="text-muted small mb-1">
                                    <?= Html::encode($model['approvment']) ?>
                                </div>
                                <div class="text-muted small">
                                    Pengajuan <?= indonesian_date2($model['created_at']) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Detail -->
                        <div>
                            <a href="<?= Url::to(['/sap-range/detail-perminggu', 'week' => $model['week']]) ?>" 
                               class="btn btn-light border rounded-3 shadow-sm p-2" 
                               style="width: 36px; height: 36px; display:flex; align-items:center; justify-content:center;">
                                <i class="icofont-list text-primary" style="font-size: 16px;"></i>
                            </a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<style>
/* =========================
   MOBILE-FRIENDLY STYLING
========================= */
body {
    background-color: #f8f9fa;
}

.sap-reconcile-index {
    max-width: 600px;
    margin: auto;
}

/* Efek hover tiap item */
.list-group-item:hover {
    background-color: #f1f5ff;
    transition: background-color 0.25s ease;
}

.card {
    border-radius: 16px;
}

/* Avatar minggu (square rounded) */
.rounded-4 {
    transition: transform 0.2s ease;
}
.rounded-4:hover {
    transform: scale(1.05);
}

/* Tombol kanan kecil */
.btn-light:hover {
    background-color: #eef3ff;
}

/* Efek shadow lembut */
.card, .btn, .rounded-4 {
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}
</style>
