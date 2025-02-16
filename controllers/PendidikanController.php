<?php

namespace app\controllers;

use Yii;
use app\models\Pendidikan;
use app\models\Pelatihan;
use app\models\Pekerjaan;
use app\models\PendidikanSearch;
use app\models\Biodata;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PendidikanController implements the CRUD actions for Pendidikan model.
 */
class PendidikanController extends Controller
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
     * Lists all Pendidikan models.
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
        'query' => Pendidikan::find()->where(['biodata_id' => $biodata->id]),
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}


    /**
     * Displays a single Pendidikan model.
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
     * Creates a new Pendidikan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new Pendidikan();


    $biodata = Biodata::findOne(['user_id' => Yii::$app->user->id]);

    if (!$biodata) {
        Yii::$app->session->setFlash('warning', 'Anda harus mengisi biodata terlebih dahulu.');
        return $this->redirect(['biodata/create']);
    }

    if ($model->load(Yii::$app->request->post())) {
        $model->biodata_id = $biodata->id;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Pendidikan berhasil ditambahkan.');
            return $this->redirect(['site/dashboard-user']);
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}


    /**
     * Updates an existing Pendidikan model.
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
        Yii::$app->session->setFlash('success', 'Data pendidikan berhasil diperbarui.');
        return $this->redirect(['index']);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}




    /**
     * Deletes an existing Pendidikan model.
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

    Yii::$app->session->setFlash('success', 'Data pendidikan berhasil dihapus.');
    return $this->redirect(['index']);
}

    

    /**
     * Finds the Pendidikan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pendidikan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) 
    {
        if (($model = Pendidikan::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
