<?php

namespace app\controllers;

use app\models\ActionReconcile;
use app\models\ActionSap;
use app\models\FileImageReconcile;
use app\models\SapReconcile;
use app\models\search\SapReconcileSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SapReconcileController implements the CRUD actions for SapReconcile model.
 */
class SapReconcileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all SapReconcile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel    = new SapReconcileSearch();
        $dataProvider   = $searchModel->search($this->request->queryParams);
        $models         = $dataProvider->getModels();
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'models'        => $models,
        ]);
    }

    /**
     * Displays a single SapReconcile model.
     * @param int $id_sap_reconcile Id Sap Reconcile
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_sap_reconcile)
    {
        $data = $this->findModel($id_sap_reconcile);
        if ($data->jenis_reconcile == 'roster') {
            return $this->render('viewRoster', [
                'model' => $data,
            ]);
        } else {
            return $this->render('viewSap', [
                'model' => $data,
            ]);
        }
    }

    /**
     * Creates a new SapReconcile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SapReconcile();

        if ($this->request->isPost) {
            echo "<pre>";

            // print_r($_POST);
            // print_r($_FILES);
            // exit;
            $getUser = ActionSap::getDataUser();
            // print_r($getUser['departemen']);
            // exit;
            if ($model->load($this->request->post())) {
                $request = $this->request->post();
                if ($request['SapReconcile']['jenis_reconcile'] == 'sap') {
                    $model->nrp                     = $getUser['nrp'];
                    $model->jenis_reconcile         = $request['SapReconcile']['jenis_reconcile'];
                    $model->sub_jenis_reconcile     = $request['SapReconcile']['sub_jenis_reconcile'];
                    $model->week                    = $request['SapReconcile']['week'];
                    $model->departement             = $getUser['departemen'];
                    $model->bulan                   = $request['SapReconcile']['bulan'];
                    if (isset($_FILES['sap_images'])) {
                        $sapFiles = ActionReconcile::normalizeFilesArray($_FILES['sap_images']);
                    }
                    if ($model->jenis_reconcile != null && $model->sub_jenis_reconcile != null) {
                        if ($model->save()) {
                            $json = [];
                            foreach ($sapFiles as $img) {
                                $image                   = new FileImageReconcile();
                                $image->nrp              = $getUser['nrp'];
                                $image->id_sap_reconcile = $model->id_sap_reconcile;
                                $image->filecontent      = file_get_contents($img['tmp_name']);
                                $image->filename         = $img['name'];
                                $image->filetype         = $img['type'];
                                $image->filesize         = $img['size'];
                                $image->save(false);
                                $json[] = [
                                    'id_file'   => $image->id_file_image_reconcile,
                                    'status'    => 'pending',
                                ];
                            }
                            $model2                 = SapReconcile::findOne($model->id_sap_reconcile);
                            $model2->reconcile_json = json_encode($json);
                            $model2->save(false);
                            Yii::$app->session->setFlash('success', 'renconcile segera di proses');
                            return $this->redirect(['view', 'id_sap_reconcile' => $model->id_sap_reconcile]);
                        }
                    } else {
                        Yii::$app->session->setFlash('danger', 'renconcile gagal di proses');
                        return $this->redirect(['index']);
                    }
                } else {
                    $json = [
                        'kegiatan' => $request['RosterData']['kegiatan'],
                        'tanggal'   => $request['reconcile_json']
                    ];
                    $json = [];
                    foreach ($request['reconcile_json'] as $data) {
                        $json[] = [
                            'tanggal'   => $data,
                            'kegiatan'  => $request['RosterData']['kegiatan'],
                            'status'    => 'pending',
                        ];
                    }
                    
                    $model->departement             = $getUser['departemen'];
                    $model->nrp                     = $getUser['nrp'];
                    $model->jenis_reconcile         = $request['SapReconcile']['jenis_reconcile'];
                    $model->week                    = $request['SapReconcile']['week'];
                    $model->bulan                   = $request['SapReconcile']['bulan'];
                    $model->reconcile_json          = json_encode($json);
                    // echo "<pre>";
                    // print_r($request['RosterData']['kegiatan']);
                    // // print_r($_FILES['FileImages']['size']);
                    // // print_r($_FILES['FileImages']);
                    // exit;
                    if (@$model->jenis_reconcile != null && $request['RosterData']['kegiatan'] != null && $request['reconcile_json'][0] != null && $_FILES['FileImages']['size'] != 0) {
                        if ($model->save()) {
                            $img                     = $_FILES['FileImages'];
                            $image                   = new FileImageReconcile();
                            $image->nrp              = $getUser['nrp'];
                            $image->id_sap_reconcile = $model->id_sap_reconcile;
                            $image->filecontent      = file_get_contents($img['tmp_name']);
                            $image->filename         = $img['name'];
                            $image->filetype         = $img['type'];
                            $image->filesize         = $img['size'];

                            if ($image->save(false)) {
                                Yii::$app->session->setFlash('success', 'renconcile segera di proses');
                                return $this->redirect(['view', 'id_sap_reconcile' => $model->id_sap_reconcile]);
                            }
                        }
                    } else {
                        Yii::$app->session->setFlash('danger', 'renconcile gagal di proses');
                        return $this->redirect(['index']);
                    }
                }
                Yii::$app->session->setFlash('danger', 'renconcile gagal di proses');
                return $this->redirect(['view', 'id_sap_reconcile' => $model->id_sap_reconcile]);
            }

            // print_r($_POST);
            // print_r($model->attributes);
            // exit;
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SapReconcile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_sap_reconcile Id Sap Reconcile
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_sap_reconcile)
    {
        $model = $this->findModel($id_sap_reconcile);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_sap_reconcile' => $model->id_sap_reconcile]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SapReconcile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_sap_reconcile Id Sap Reconcile
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_sap_reconcile)
    {
        $this->findModel($id_sap_reconcile)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SapReconcile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_sap_reconcile Id Sap Reconcile
     * @return SapReconcile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_sap_reconcile)
    {
        if (($model = SapReconcile::findOne(['id_sap_reconcile' => $id_sap_reconcile])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
