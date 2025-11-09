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
            <?php $form = ActiveForm::begin(); ?>

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

            <!-- Multiple Input (Roster) -->
            <div id="field-roster-inputs">
                <label class="fw-semibold mb-2">Tanggal Roster</label>
                <div id="roster-container">
                    <div class="row roster-item mb-2">
                        <div class="col-md-10 col-12 mb-2 mb-md-0">
                            <input type="text" name="reconcile_json[]" class="form-control shadow-sm rounded-top roster-date" placeholder="hh / bb / tttt">
                        </div>
                        <div class="col-md-2 col-12">
                            <button type="button" class="btn btn-danger btn-sm rounded-bottom remove-item w-100 text-white" style="margin-top: -15px;">
                                <i class="icofont-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <?= Html::dropDownList("RosterData[][pos_unit]", '', [
                    'cuti'          => 'CUTI',
                    'tugas_luar'    => 'TUGAS LUAR',
                    'traning'       => 'TRANING',
                ], [
                    'class' => 'form-select shadow-sm rounded-2 mt-3',
                    'prompt' => '- Pilih POS Unit -'
                ]) ?>

                <button type="button" class="btn btn-outline-primary btn-sm rounded-2 mt-3 mb-2" id="add-item">+ Tambah Tanggal</button>
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
    } else if (jenis === 'roster') {
        $('#field-roster-inputs').show();
        $('#field-sub-jenis').hide();
    } else {
        $('#field-sub-jenis').hide();
        $('#field-roster-inputs').hide();
    }
}

// Inisialisasi flatpickr untuk elemen awal
function initFlatpickr() {
    flatpickr('.roster-date', {
        dateFormat: "d/m/Y",
        allowInput: true,
        locale: "id"
    });
}

// Tambah baris baru
$('#add-item').on('click', function() {
    var newRow = `
        <div class="row roster-item mb-2">
            <div class="col-md-10 col-12 mb-2 mb-md-0">
                <input type="text" name="reconcile_json[]" class="form-control shadow-sm rounded-top roster-date" placeholder="hh / bb / tttt">
            </div>
            <div class="col-md-2 col-12">
                <button type="button" class="btn btn-danger btn-sm rounded-bottom remove-item w-100 text-white" style="margin-top: -15px;">
                    <i class="icofont-trash"></i> Hapus
                </button>
            </div>
        </div>`;
    $('#roster-container').append(newRow);
    initFlatpickr(); // aktifkan flatpickr untuk input baru
});

// Hapus baris
$(document).on('click', '.remove-item', function() {
    $(this).closest('.roster-item').remove();
});

// Jalankan saat halaman load & setiap perubahan
toggleFields();
$('#jenis-reconcile').on('change', toggleFields);

// Inisialisasi awal flatpickr
initFlatpickr();
JS;

$this->registerJs($js);
?>
