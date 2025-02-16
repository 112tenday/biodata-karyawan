<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Biodata $model */
/** @var app\models\Pendidikan[] $pendidikan */
/** @var app\models\Pelatihan[] $pelatihan */
/** @var app\models\Pekerjaan[] $pekerjaan */

$this->title = $model->nama;
?>
<div class="biodata-view">

    <h2>Detail Biodata: <?= Html::encode($this->title) ?></h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'no_ktp',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'golongan_darah',
            'status',
            'alamat_ktp',
            'alamat_tinggal',
            'email:email',
            'no_telp',
            'kontak_darurat',
            'skill',
            'bersedia_ditempatkan:boolean',
            [
                'attribute' => 'penghasilan_diharapkan',
                'format' => ['currency', 'IDR'],
            ],
        ],
    ]) ?>

    <h3>Riwayat Pendidikan</h3>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $pendidikan,
            'pagination' => false
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'jenjang',
            'institusi',
            'jurusan',
            'tahun_lulus',
            [
                'attribute' => 'ipk',
                'format' => 'decimal',
            ],
        ],
    ]) ?>

    <h3>Riwayat Pelatihan</h3>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $pelatihan,
            'pagination' => false
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_kursus',
            [
                'attribute' => 'disertifikat',
                'value' => function ($model) {
                    return $model->disertifikat ? 'Ya' : 'Tidak';
                },
            ],
            'tahun',
        ],
    ]) ?>

    <h3>Riwayat Pekerjaan</h3>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $pekerjaan,
            'pagination' => false
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_perusahaan',
            'posisi',
            [
                'attribute' => 'gaji',
                'format' => ['currency', 'IDR'],
            ],
            'tahun',
        ],
    ]) ?>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Kembali', ['admin-index'], ['class' => 'btn btn-secondary']) ?>
    </p>

</div>
