<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ActionReconcile;

$data = ActionReconcile::listWeek();
$weekList = array_combine($data, array_map(fn($w) => 'Week ' . $w, $data));

$month = ActionReconcile::listMonth();
$monthList = array_combine($month, array_map(fn($m) => ActionReconcile::getNamaBulan($m), $month));

?>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="card border-0 shadow-sm rounded-2">
    <div class="card-body">
        <div class="sap-reconcile-form">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <!-- Jenis Reconcile -->
            <?= $form->field($model, 'jenis_reconcile')->dropDownList([
                ''          => '- Jenis Reconcile -',
                'roster'    => 'Roster',
                'sap'       => 'SAP',
            ], [
                'class' => 'form-select shadow-sm rounded-2',
                'id'    => 'jenis-reconcile'
            ])->label(false) ?>

            <!-- Sub Jenis (SAP) -->
            <div id="field-sub-jenis">
                <?= $form->field($model, 'sub_jenis_reconcile')->dropDownList([
                    ''       => 'Jenis SAP',
                    'kta'    => 'KTA',
                    'tta'    => 'TTA',
                    'ins'    => 'Inspeksi',
                    'obs'    => 'Observasi',
                    's_meet' => 'Safety Meeting',
                    'wuc'    => 'Wake Up Call',
                    'cc'     => 'Coaching',
                    'opk'    => 'Observasi Khusus',
                ], [
                    'class' => 'form-select shadow-sm rounded-2',
                ])->label(false) ?>
            </div>

            <!-- Upload Gambar (SAP) -->
            <div id="field-sap-images">
                <label class="fw-semibold mb-2">Upload Gambar SAP</label>
                <div id="sap-image-container">
                    <div class="row sap-image-item mb-2">
                        <div class="col-md-10 col-12 mb-2 mb-md-0">
                            <input type="file" name="sap_images[]" accept="image/*" class="form-control shadow-sm rounded-top">
                            <button type="button" class="btn btn-danger btn-sm rounded-bottom remove-image w-100 text-white">
                                <i class="icofont-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-2 mt-2 mb-3" id="add-image">+ Tambah Gambar</button>
            </div>

            <!-- Multiple Input (Roster) -->
            <div id="field-roster-inputs">
                <label class="fw-semibold mb-2">Tanggal Roster</label>
                <div id="roster-container">
                    <div class="row roster-item mb-2">
                        <div class="col-md-10 col-12 mb-2 mb-md-0">
                            <input type="date" name="reconcile_json[]" class="form-control shadow-sm rounded-top roster-date" placeholder="hh / bb / tttt">
                            <button type="button" class="btn btn-danger btn-sm rounded-bottom remove-item w-100 text-white">
                                <i class="icofont-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary btn-sm rounded-2 mt-3" id="add-item">+ Tambah Tanggal</button>
                <?= Html::dropDownList("RosterData[kegiatan]", '', [
                    'cuti'          => 'CUTI',
                    'tugas_luar'    => 'TUGAS LUAR',
                    'traning'       => 'TRANING',
                ], [
                    'class' => 'form-select shadow-sm rounded-2 mt-3',
                    'prompt' => '- Pilih Kegiatan -'
                ]) ?>
                <label class="mt-2 mb-0 text-muted">Dokumen Pendukung</label> 
                <input type="file" class="form-control mb-3" name="FileImages" placeholder="dokumen pendukung" accept=".jpg, .jpeg, .png, .pdf">
            </div>

            <!-- Week -->
            <?= $form->field($model, 'week')->dropDownList($weekList, [
                'prompt' => '- Pilih Week -',
                'class' => 'form-select shadow-sm rounded-2',
            ])->label(false) ?>

            <!-- Bulan -->
            <?= $form->field($model, 'bulan')->dropDownList($monthList, [
                'prompt' => '- Pilih Bulan -',
                'class' => 'form-select shadow-sm rounded-2',
            ])->label(false) ?>

            <div class="form-group mt-3">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success rounded-2 text-white']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
function toggleFields() {
    var jenis = $('#jenis-reconcile').val();
    if (jenis === 'sap') {
        $('#field-sub-jenis').show();
        $('#field-roster-inputs').hide();
        $('#field-sap-images').show();
    } else if (jenis === 'roster') {
        $('#field-roster-inputs').show();
        $('#field-sub-jenis').hide();
        $('#field-sap-images').hide();
    } else {
        $('#field-sub-jenis').hide();
        $('#field-roster-inputs').hide();
        $('#field-sap-images').hide();
    }
}

// Inisialisasi flatpickr untuk elemen awal
function initFlatpickr() {
    $('.roster-date:not(.flatpickr-input)').each(function() {
        flatpickr(this, {
            dateFormat: "d/m/Y",
            allowInput: true,
            locale: "id"
        });
    });
}

// Tambah baris baru roster
$('#add-item').on('click', function() {
    var newRow = `
        <div class="row roster-item mb-2">
            <div class="col-md-10 col-12 mb-2 mb-md-0">
                <input type="date" name="reconcile_json[]" class="form-control shadow-sm rounded-top roster-date" placeholder="hh / bb / tttt">
                <button type="button" class="btn btn-danger btn-sm rounded-bottom remove-item w-100 text-white">
                    <i class="icofont-trash"></i> Hapus
                </button>
            </div>
        </div>`;
    $('#roster-container').append(newRow);
    initFlatpickr();
});

// Tambah baris baru gambar SAP
$('#add-image').on('click', function() {
    var newImage = `
        <div class="row sap-image-item mb-2">
            <div class="col-md-10 col-12 mb-2 mb-md-0">
                <input type="file" name="sap_images[]" accept="image/*" class="form-control shadow-sm rounded-top">
                <button type="button" class="btn btn-danger btn-sm rounded-bottom remove-image w-100 text-white">
                    <i class="icofont-trash"></i> Hapus
                </button>
            </div>
        </div>`;
    $('#sap-image-container').append(newImage);
});

// Hapus baris roster
$(document).on('click', '.remove-item', function() {
    $(this).closest('.roster-item').remove();
});

// Hapus baris gambar SAP
$(document).on('click', '.remove-image', function() {
    $(this).closest('.sap-image-item').remove();
});

// Jalankan saat halaman load & setiap perubahan
toggleFields();
$('#jenis-reconcile').on('change', toggleFields);

// Inisialisasi awal flatpickr
initFlatpickr();
JS;

$this->registerJs($js);
?>