<?php

use app\models\Biodata;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BiodataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Biodatas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biodata-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Biodata', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'posisi_dilamar',
            'nama',
            'no_ktp',
            [
                'label' => 'Tempat & Tanggal Lahir',
                'value' => function ($model) {
                    return $model->tempatTanggalLahir ?? 'Data tidak tersedia';
                },
            ],
            //'tempat_lahir',
            //'tanggal_lahir',
            //'jenis_kelamin',
            //'agama',
            //'golongan_darah',
            //'status',
            //'alamat_ktp:ntext',
            //'alamat_tinggal:ntext',
            //'email:email',
            //'no_telp',
            //'kontak_darurat',
            //'skill:ntext',
            //'bersedia_ditempatkan:boolean',
            //'penghasilan_diharapkan',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Biodata $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
