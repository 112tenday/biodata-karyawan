<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BiodataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Data Pelamar';
?>

<div class="biodata-admin-index">

    <h2 class="mb-4"><?= Html::encode($this->title) ?></h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Menampilkan {begin} - {end} dari {totalCount} pelamar',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'nama',
                'label' => 'Nama Lengkap',
                'format' => 'text',
            ],
            [
                'attribute' => 'tempat_lahir',
                'label' => 'Tempat Lahir',
                'format' => 'text',
            ],
            [
                'attribute' => 'tanggal_lahir',
                'label' => 'Tanggal Lahir',
                'format' => ['date', 'php:d-m-Y'],
            ],
            [
                'attribute' => 'posisi_dilamar',
                'label' => 'Posisi Dilamar',
                'format' => 'text',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Lihat', ['biodata/admin-view', 'id' => $model->id], [
                            'class' => 'btn btn-info btn-sm',
                            'title' => 'Lihat detail pelamar',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('Edit', ['biodata/update', 'id' => $model->id], [
                            'class' => 'btn btn-warning btn-sm',
                            'title' => 'Edit data pelamar',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Hapus', ['biodata/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Hapus data pelamar',
                            'data' => [
                                'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'visible' => Yii::$app->user->identity->role === 'admin',
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
    ]); ?>

</div>
