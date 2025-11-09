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
        return $this->render('view', [
            'model' => $this->findModel($id_sap_reconcile),
        ]);
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
            // echo "<pre>";
            $getUser = ActionSap::getDataUser();
            // print_r($getUser);
            // exit;
            if ($model->load($this->request->post())) {
                $request = $this->request->post();
                if ($request['SapReconcile']['jenis_reconcile'] == 'sap') {
                    $model->nrp                     = $getUser['nrp'];
                    $model->jenis_reconcile         = $request['SapReconcile']['jenis_reconcile'];
                    $model->sub_jenis_reconcile     = $request['SapReconcile']['sub_jenis_reconcile'];
                    $model->week                    = $request['SapReconcile']['week'];
                    $model->bulan                   = $request['SapReconcile']['bulan'];
                    if (isset($_FILES['sap_images'])) {
                        $sapFiles = ActionReconcile::normalizeFilesArray($_FILES['sap_images']);
                    }
                    if ($model->save(false)) {
                        foreach ($sapFiles as $img) {
                            $image                   = new FileImageReconcile();
                            $image->nrp              = $model->id_sap_reconcile;
                            $image->filecontent      = file_get_contents($img['tmp_name']);
                            $image->filename         = $img['name'];
                            $image->filetype         = $img['type'];
                            $image->filesize         = $img['size'];
                            if ($image->save(false)) {
                                Yii::$app->session->setFlash('success', 'renconcile segera di proses');
                                return $this->redirect(['view', 'id_sap_reconcile' => $model->id_sap_reconcile]);
                            }
                        }
                    }
                } else {
                    $json = [
                        'kegiatan' => $request['RosterData']['kegiatan'],
                        'tanggal'   => $request['reconcile_json']
                    ];
                    $model->nrp                     = $getUser['nrp'];
                    $model->jenis_reconcile         = $request['SapReconcile']['jenis_reconcile'];
                    $model->sub_jenis_reconcile     = $request['SapReconcile']['sub_jenis_reconcile'];
                    $model->week                    = $request['SapReconcile']['week'];
                    $model->bulan                   = $request['SapReconcile']['bulan'];
                    $model->reconcile_json          = json_encode($json);
                    if ($model->save(false)) {
                        Yii::$app->session->setFlash('success', 'renconcile segera di proses');
                        return $this->redirect(['view', 'id_sap_reconcile' => $model->id_sap_reconcile]);
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
