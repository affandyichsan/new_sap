<?php

namespace app\controllers;

use app\models\ActionSap;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = @ActionSap::getCountDataSAP();
        $cuti = @json_decode($data['note_per_date']);

        // pastikan data cuti valid array
        $cutiArray = is_array($cuti) ? $cuti : (array)$cuti;

        if (!empty($cutiArray)) {
            // ambil semua tanggal
            $tanggalList = array_column($cutiArray, 'tanggal');

            $cutiStart = min($tanggalList);
            $cutiEnd   = max($tanggalList);
        } else {
            $cutiStart = null;
            $cutiEnd   = null;
        }

        return $this->render('index', [
            'data' => $data,
            'cutiStart' => $cutiStart,
            'cutiEnd' => $cutiEnd,
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = "main_login";
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('success', "Anda sudah melakukan Login");
            // return $this->render('index');
            return $this->redirect(['site/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->login()) {
                Yii::$app->session->setFlash('success', "berhasil Login");
                return $this->redirect(['site/index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Try checking your username and password again!');
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
