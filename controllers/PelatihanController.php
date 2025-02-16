<?php

namespace app\controllers;

use Yii;
use app\models\Pelatihan;
use app\models\Pendidikan;
use app\models\Pekerjaan;

use app\models\PelatihanSearch;
use app\models\Biodata;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PelatihanController implements the CRUD actions for Pelatihan model.
 */
class PelatihanController extends Controller
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
     * Lists all Pelatihan models.
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
        'query' => Pelatihan::find()->where(['biodata_id' => $biodata->id]),
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}


    /**
     * Displays a single Pelatihan model.
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
     * Creates a new Pelatihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($biodata_id)
{
    $model = new Pelatihan();
    $model->biodata_id = $biodata_id;

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Pelatihan berhasil ditambahkan.');
        return $this->redirect(['site/dashboard-user']);
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

    

    /**
     * Updates an existing Pelatihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    // Cek apakah data ini milik user yang login
    if ($model->biodata->user_id !== Yii::$app->user->id) {
        throw new \yii\web\ForbiddenHttpException('Anda tidak berhak mengakses data ini.');
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Data pelatihan berhasil diperbarui.');
        return $this->redirect(['index']);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}



    /**
     * Deletes an existing Pelatihan model.
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

    Yii::$app->session->setFlash('success', 'Data pelatihan berhasil dihapus.');
    return $this->redirect(['index']);
}

    /**
     * Finds the Pelatihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pelatihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
{
    if (($model = Pelatihan::findOne(['id' => $id])) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('Halaman yang Anda cari tidak ditemukan.');
}

}
