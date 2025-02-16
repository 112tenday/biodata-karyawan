<?php

namespace app\controllers;

use Yii;
use app\models\Biodata;
use app\models\Pendidikan;
use app\models\Pelatihan;
use app\models\Pekerjaan;
use app\models\BiodataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl; 


/**
 * BiodataController implements the CRUD actions for Biodata model.
 */
class BiodataController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'only' => ['index', 'view', 'create', 'update', 'delete', 'admin-index', 'admin-view'], 
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'], 
                ],
                [
                    'allow' => true,
                    'actions' => ['admin-index', 'admin-view'], 
                    'roles' => ['admin'], 
                ],
            ],
        ],
    ];
}


    /**
     * Lists all Biodata models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BiodataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Biodata model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
{
    $biodata = Biodata::findOne($id);
    if (!$biodata) {
        throw new NotFoundHttpException("Data tidak ditemukan.");
    }

    $pendidikan = Pendidikan::find()->where(['biodata_id' => $id])->all();
    $pelatihan = Pelatihan::find()->where(['biodata_id' => $id])->all();
    $pekerjaan = Pekerjaan::find()->where(['biodata_id' => $id])->all();

    return $this->render('view', [
        'biodata' => $biodata,
        'pendidikan' => $pendidikan,
        'pelatihan' => $pelatihan,
        'pekerjaan' => $pekerjaan,
    ]);
}

    

    

    /**
     * Creates a new Biodata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new Biodata();

    $pendidikanModels = [new Pendidikan()];
    $pelatihanModels = [new Pelatihan()];
    $pekerjaanModels = [new Pekerjaan()];

    if ($model->load(Yii::$app->request->post())) {
        $model->user_id = Yii::$app->user->id; 
        if ($model->save()) {
            $pendidikanData = Yii::$app->request->post('Pendidikan', []);
            $pelatihanData = Yii::$app->request->post('Pelatihan', []);
            $pekerjaanData = Yii::$app->request->post('Pekerjaan', []);

            foreach ($pendidikanData as $pendidikanRow) {
                $pendidikanModel = new Pendidikan();
                $pendidikanModel->biodata_id = $model->id;
                $pendidikanModel->load($pendidikanRow, '');
                $pendidikanModel->save();
            }

            foreach ($pelatihanData as $pelatihanRow) {
                $pelatihanModel = new Pelatihan();
                $pelatihanModel->biodata_id = $model->id;
                $pelatihanModel->load($pelatihanRow, '');
                $pelatihanModel->save();
            }

            foreach ($pekerjaanData as $pekerjaanRow) {
                $pekerjaanModel = new Pekerjaan();
                $pekerjaanModel->biodata_id = $model->id;
                $pekerjaanModel->load($pekerjaanRow, '');
                $pekerjaanModel->save();
            }

            Yii::$app->session->setFlash('success', 'Biodata berhasil ditambahkan.');

            if (Yii::$app->user->identity->role == 'admin') {
                return $this->redirect(['biodata/admin-index']);
            }

            return $this->redirect(['site/dashboard-user']);
        }
    }

    return $this->render('create', [
        'model' => $model,
        'pendidikanModels' => $pendidikanModels,
        'pelatihanModels' => $pelatihanModels,
        'pekerjaanModels' => $pekerjaanModels,
    ]);
}





    /**
     * Updates an existing Biodata model.
     * If update is successful, the browser will be redirected to the dashboard.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $pendidikanModels = Pendidikan::find()->where(['biodata_id' => $id])->all();
    $pelatihanModels = Pelatihan::find()->where(['biodata_id' => $id])->all();
    $pekerjaanModels = Pekerjaan::find()->where(['biodata_id' => $id])->all();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Pendidikan::deleteAll(['biodata_id' => $id]);
        Pelatihan::deleteAll(['biodata_id' => $id]);
        Pekerjaan::deleteAll(['biodata_id' => $id]);

        $pendidikanData = Yii::$app->request->post('Pendidikan', []);
        $pelatihanData = Yii::$app->request->post('Pelatihan', []);
        $pekerjaanData = Yii::$app->request->post('Pekerjaan', []);

        foreach ($pendidikanData as $pendidikanRow) {
            $pendidikanModel = new Pendidikan();
            $pendidikanModel->biodata_id = $id;
            $pendidikanModel->load($pendidikanRow, '');
            $pendidikanModel->save();
        }

        foreach ($pelatihanData as $pelatihanRow) {
            $pelatihanModel = new Pelatihan();
            $pelatihanModel->biodata_id = $id;
            $pelatihanModel->load($pelatihanRow, '');
            $pelatihanModel->save();
        }

        foreach ($pekerjaanData as $pekerjaanRow) {
            $pekerjaanModel = new Pekerjaan();
            $pekerjaanModel->biodata_id = $id;
            $pekerjaanModel->load($pekerjaanRow, '');
            $pekerjaanModel->save();
        }

        Yii::$app->session->setFlash('success', 'Biodata berhasil diperbarui.');

        if (Yii::$app->user->identity->role == 'admin') {
            return $this->redirect(['biodata/admin-index']);
        }

        return $this->redirect(['site/dashboard-user']);
    }

    return $this->render('update', [
        'model' => $model,
        'pendidikanModels' => $pendidikanModels ?: [new Pendidikan()],
        'pelatihanModels' => $pelatihanModels ?: [new Pelatihan()],
        'pekerjaanModels' => $pekerjaanModels ?: [new Pekerjaan()],
    ]);
}

    



    /**
     * Deletes an existing Biodata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
{
    $this->findModel($id)->delete();
    Yii::$app->session->setFlash('success', 'Biodata berhasil dihapus.');


    if (Yii::$app->user->identity->role == 'admin') {
        return $this->redirect(['biodata/admin-index']);
    }

    return $this->redirect(['index']);
}


    public function actionAdminIndex()
{
    $searchModel = new BiodataSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('admin-index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}

public function actionAdminView($id)
{
    $biodata = Biodata::findOne($id);
    if (!$biodata) {
        throw new NotFoundHttpException("Data tidak ditemukan.");
    }

    $pendidikan = \app\models\Pendidikan::find()->where(['biodata_id' => $id])->all();
    $pelatihan = \app\models\Pelatihan::find()->where(['biodata_id' => $id])->all();
    $pekerjaan = \app\models\Pekerjaan::find()->where(['biodata_id' => $id])->all();

    return $this->render('admin-view', [
        'biodata' => $biodata,
        'pendidikan' => $pendidikan,
        'pelatihan' => $pelatihan,
        'pekerjaan' => $pekerjaan,
    ]);
}





    /**
     * Finds the Biodata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Biodata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Biodata::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Halaman yang Anda cari tidak ditemukan.');
    }
}
