<?php

use app\models\ActionSap;
use app\models\SapUserData;
use yii\helpers\Url;

$data = ActionSap::getDataUser();

$model = Yii::$app->user->identity;

$datauser = SapUserData::findOne($model->id);
// echo "<pre>";
// print_r($datauser->password);
// exit;
echo $this->render('_modal_dialog_id', [
    'password'  => $datauser->password,
    'id'        => $datauser->id,
]);
?>

<!-- user information -->
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-60 rounded-15">
                    <img src="<?= Url::base() ?>/assets_web/images/unknow-people.png" alt="">
                </figure>
            </div>
            <div class="col px-0 align-self-center">
                <h6 class="mb-0"><?= $data['nama_karyawan'] ?></h6>
                <p class="text-muted" style="font-size: 12px;"><?= $data['departemen'] . '|' . $data['jabatan'] ?></p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">
        </p>
        <div class="row">
            <div class="col d-grid">
                <a href="chat.html" class="btn btn-default btn-lg shadow-sm rounded">Upload Photo</a>
            </div>
            <div class="col d-grid">

                <button type="button" class="btn btn-default btn-lg shadow-sm rounded" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $model->id?>">
                    <i class="bi bi-shield-lock-fill"></i> Update Password
                </button>
            </div>
        </div>
    </div>
</div>