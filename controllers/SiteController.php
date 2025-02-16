<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Biodata;
use app\models\Pendidikan;
use app\models\Pelatihan;
use app\models\Pekerjaan;


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
                        'actions' => ['logout'],
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
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }

    if (!isset(Yii::$app->user->identity->role)) {
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }

    if (Yii::$app->user->identity->role === 'admin') {
        return $this->redirect(['biodata/admin-index']);
    } else {
        return $this->redirect(['site/dashboard-user']);
    }
}

    

public function actionDashboardUser()
{
    $userId = Yii::$app->user->id;
    $biodata = Biodata::find()->where(['user_id' => $userId])->one();

    $pendidikan = [];
    $pelatihan = [];
    $pekerjaan = [];

    if ($biodata) {
        $pendidikan = $biodata->getPendidikans()->all();
        $pelatihan = $biodata->getPelatihans()->all();
        $pekerjaan = $biodata->getPekerjaans()->all();
    }

    return $this->render('dashboard-user', [
        'biodata' => $biodata,
        'pendidikan' => $pendidikan,
        'pelatihan' => $pelatihan,
        'pekerjaan' => $pekerjaan,
    ]);
}


    


    public function actionSignup()
    {
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Pendaftaran berhasil! Silakan login.');
            return $this->redirect(['site/login']);
        }
    
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->role === 'admin') {
                return $this->redirect(['/biodata/admin-index']);
            } else {
                return $this->redirect(['/site/dashboard-user']);
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
