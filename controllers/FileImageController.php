<?php

namespace app\controllers;

use app\models\FileImage;
use app\models\SapUserData;
use Yii;
use yii\web\UploadedFile;

class FileImageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionUploadProfile()
    {
        return $this->render('/file-image/upload');
    }

    public function updateProfileImage()
    {   
        $model = SapUserData::findOne(@Yii::$app->user->identity->id);
        if($model->id_file == null){
            $model2 = new FileImage();
        }else{
            $model2 = FileImage::findOne($model->id_file);
        }
        $UploadImage = $_POST['UploadImage'];
        $model2->image = UploadedFile::getInstance($model2, 'image');
        if ($_FILES['FileImage']['size']['image'] != 0) {
            if ($model->id_file == null) {
                if ($model2->upload('profile')) {
                    Yii::$app->session->setFlash('success', 'Upload Berhasil');
                    return true;
                } else {
                    Yii::$app->session->setFlash('danger', 'Upload Gagal');
                    return false;
                }
            } else {
                if ($model2->updateUpload($model->id_file, 'profile')) {
                    Yii::$app->session->setFlash('success', 'Update upload Berhasil');
                    return true;
                } else {
                    Yii::$app->session->setFlash('danger', 'Update upload Gagal');
                    return false;
                }
            }
        }
        return false;
    }
}
