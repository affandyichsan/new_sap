<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

?>

<div class="d-flex flex-column min-vh-100">
    <!-- Header / Logo -->

    <div class="text-center mt-5">
        <div class="row justify-content-center text-center w-100 p-4" style="margin-top: -30px;">
            <div class="col-3">
                <img src="<?= Url::base() ?>/assets_web/images/logo & text.png" alt="Logo" style="max-width: 100%;">
            </div>
            <div class="col-3">
                <img src="<?= Url::base() ?>/assets_web/images/Logo-SIC.png" alt="Logo" style="max-width: 60%;">
            </div>
            <div class="col-3">
                <img src="<?= Url::base() ?>/assets_web/images/logo-Asic.png" alt="Logo" style="max-width: 80%;">
            </div>
            <div class="col-3">
                <img src="<?= Url::base() ?>/assets_web/images/bib-1.png" alt="Logo" style="max-width: 80%;">
            </div>
        </div>
    </div>
    <!-- Flash Message -->
    <div class="container">
        <?= $this->render('../layouts/_flash'); ?>
    </div>

    <!-- Login Card -->
    <div class="d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="card shadow-lg rounded-4 p-4" style="width:100%; max-width:100%; height:100%; background-color:#006341;">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-warning">SAP</span></h4>
                <p class="text-white">Safety Accountability Program</p>
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <!-- Perusahaan -->
            <div class="form-floating mb-3">
                <select class="form-select" id="loginform-perusahaan" name="LoginForm[perusahaan]">
                    <option selected disabled>Pilih perusahaan...</option>
                    <option value="PPA">PPA/AMM</option>
                    <option value="SUBKONT">SUBKONT</option>
                </select>
                <label for="loginform-perusahaan">Perusahaan</label>
            </div>

            <!-- Username -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="loginform-username" name="LoginForm[username]" placeholder="NRP" autocomplete="off" style="border-radius:5px;">
                <label for="loginform-username">NRP</label>
            </div>

            <!-- password -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="loginform-password" name="LoginForm[password]" placeholder="Password" autocomplete="off" style="border-radius:5px;">
                <label for="loginform-password">Password</label>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn btn-dark w-100 py-2 shadow-sm text-white">
                Login
            </button>

            <?php ActiveForm::end(); ?>

            <!-- Footer -->
            <div class="text-center mt-4">
                <!-- <img src="<?= Url::base() ?>/assets_web/images/safebras.png" alt="Safebras" style="max-width:120px;"> -->
                <div class="text-white small" style="font-size: 10px; margin-top:10px;">ASIC : 1.0.0</div>
            </div>
        </div>
    </div>
</div>