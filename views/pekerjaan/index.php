<?php

use app\models\Pekerjaan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PekerjaanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Riwayat Pekerjaan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pekerjaan-index">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Riwayat Pekerjaan</h5>
        </div>
        <div class="card-body">
            <p>
                <?= Html::a('<i class="fas fa-plus"></i> Tambah Pekerjaan', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table table-striped table-hover table-bordered'],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No',
                        ],

                        'nama_perusahaan',
                        'posisi',
                        [
                            'attribute' => 'pendapatan',
                            'value' => function ($model) {
                                return 'Rp ' . number_format($model->pendapatan, 0, ',', '.');
                            },
                            'format' => 'raw',
                        ],

                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Aksi',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('Edit', $url, [
                                        'class' => 'btn btn-primary btn-sm mx-1',
                                        'title' => 'Edit Data'
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('Hapus', $url, [
                                        'class' => 'btn btn-danger btn-sm mx-1',
                                        'title' => 'Hapus Data',
                                        'data' => [
                                            'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                            ],
                            'contentOptions' => ['style' => 'white-space: nowrap; text-align: center;'], 
                            'urlCreator' => function ($action, Pekerjaan $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>

</div>
