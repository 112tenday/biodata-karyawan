<?php

namespace app\controllers;

use Yii;
use app\models\Pekerjaan;
use app\models\Pendidikan;
use app\models\Pelatihan;
use app\models\PekerjaanSearch;
use app\models\Biodata;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PekerjaanController implements the CRUD actions for Pekerjaan model.
 */
class PekerjaanController extends Controller
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
     * Lists all Pekerjaan models.
     *
     * @return string
     */
    public function actionIndex()
{
    $biodata = Biodata::find()->where(['user_id' => Yii::$app->user->id])->one();

    if (!$biodata) {
        throw new \yii\web\NotFoundHttpException('Biodata tidak ditemukan.');
    }

    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => Pekerjaan::find()->where(['biodata_id' => $biodata->id]),
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}


    /**
     * Displays a single Pekerjaan model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pekerjaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new Pekerjaan();

    $biodata = Biodata::findOne(['user_id' => Yii::$app->user->id]);

    if (!$biodata) {
        Yii::$app->session->setFlash('warning', 'Anda harus mengisi biodata terlebih dahulu.');
        return $this->redirect(['biodata/create']);
    }

    if ($model->load(Yii::$app->request->post())) {
        $model->biodata_id = $biodata->id; // Set otomatis biodata_id
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Pekerjaan berhasil ditambahkan.');
            return $this->redirect(['site/dashboard-user']);
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}


    /**
     * Updates an existing Pekerjaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->biodata->user_id !== Yii::$app->user->id) {
        throw new \yii\web\ForbiddenHttpException('Anda tidak berhak mengakses data ini.');
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Data pekerjaan berhasil diperbarui.');
        return $this->redirect(['index']);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}



    /**
     * Deletes an existing Pekerjaan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
{
    $model = $this->findModel($id);

    if ($model->biodata->user_id !== Yii::$app->user->id) {
        throw new \yii\web\ForbiddenHttpException('Anda tidak berhak menghapus data ini.');
    }

    $model->delete();

    Yii::$app->session->setFlash('success', 'Data pekerjaan berhasil dihapus.');
    return $this->redirect(['index']);
}


    /**
     * Finds the Pekerjaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pekerjaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
{
    if (($model = Pekerjaan::findOne($id)) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('Data yang Anda cari tidak ditemukan.');
}

}
