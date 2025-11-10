<?php

namespace app\controllers\rest;

use app\models\FileImage;
use app\models\FileImageReconcile;
use app\models\SapUserData;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class FileImageController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\ActionSap';

    public function actionUpdateProfileImage()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->identity->id;

        // Nonaktifkan validasi CSRF kalau kamu kirim via AJAX tanpa token
        $this->enableCsrfValidation = false;

        // Ambil model user
        $model = SapUserData::findOne($userId);
        if (!$model) {
            return ['success' => false, 'message' => 'User tidak ditemukan'];
        }

        // Ambil file yang dikirim
        $uploadedFile = \yii\web\UploadedFile::getInstanceByName('file');

        if (!$uploadedFile) {
            return ['success' => false, 'message' => 'File tidak terdeteksi di $_FILES'];
        }

        // Tentukan model FileImage (baru atau update)
        $model2 = $model->id_file ? FileImage::findOne($model->id_file) : new FileImage();
        $model2->image = $uploadedFile;

        // Proses upload baru atau update
        if ($model->id_file == null) {
            if ($model2->upload('profile')) {
                $model->id_file = $model2->id;
                $model->save(false);
                return ['success' => true, 'message' => 'Upload Berhasil'];
            } else {
                return ['success' => false, 'message' => 'Upload Gagal'];
            }
        } else {
            if ($model2->updateUpload($model->id_file, 'profile')) {
                return ['success' => true, 'message' => 'Update Upload Berhasil'];
            } else {
                return ['success' => false, 'message' => 'Update Upload Gagal'];
            }
        }
    }

    public function actionViewReconcile($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $file = FileImageReconcile::findOne($id);

        if (!$file) {
            return ['status' => 'error', 'message' => 'File tidak ditemukan'];
        }

        $base64 = base64_encode($file->filecontent);
        return [
            'status' => 'success',
            'filename' => $file->filename,
            'filetype' => $file->filetype,
            'filesize' => $file->filesize,
            'dataUrl' => "data:{$file->filetype};base64,{$base64}"
        ];
    }
}
