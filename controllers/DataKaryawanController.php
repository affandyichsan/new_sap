<?php

namespace app\controllers;

use app\models\SapUserData;
use app\models\User;
use Yii;

class DataKaryawanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdatepassworduser($id)
    {
        $model              = User::findOne($id);
        $request            = Yii::$app->request;
        $oldpassword        = SapUserData::findOne($id)->password;
        $newpassword        = Yii::$app->request->post()['User']['newPassword'];
        $confrimpassword    = Yii::$app->request->post()['User']['confrimPassword'];

        if ($model->validatePasswordChangeUser($oldpassword)) {
            if ($newpassword != $confrimpassword) {
                Yii::$app->session->setFlash('success', 'password tidak terkonfirmasi');
                return false;
            }
            $model->setPassword($newpassword);
            $model->generateAuthKey();
            $model->generateEmailVerificationToken();
            $model->updated_at      = date('Y-m-d H:i:s');
            $model->username        = $model->username;
            $model->password        = $newpassword;
            $model->oldPassword     = $oldpassword;
            $model->newPassword     = $newpassword;
            $model->confirmPassword = $confrimpassword;

            if ($model->save(false)) {
                $models                     = SapUserData::findOne($id);
                $models->password_hash      = $model->password_hash;
                $models->authKey            = $model->authKey;
                $models->verification_token = $model->verification_token;
                $models->password           = $model->password;
                $models->save();
                Yii::$app->session->setFlash('success', 'Password telah berhasil diupdate');
                if (@Yii::$app->user->identity->role == 'admin') {
                    return $this->redirect(['/data-karyawan/index']);
                } else {
                    return $this->redirect(['/data-karyawan/index']);
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Password gagal diupdate');
                return $this->redirect(['/data-karyawan/index']);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Password lama yang anda masukan salah');
            return $this->redirect(['/data-karyawan/index']);
        }
    }
}
