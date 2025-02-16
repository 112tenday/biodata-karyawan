<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Biodata $biodata */
/** @var app\models\Pendidikan[] $pendidikan */
/** @var app\models\Pelatihan[] $pelatihan */
/** @var app\models\Pekerjaan[] $pekerjaan */

$this->title = $biodata->nama;
?>

<div class="biodata-view">

    <h2>Detail Biodata: <?= Html::encode($this->title) ?></h2>

    <div class="card mb-3">
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $biodata,
                'attributes' => [
                    'posisi_dilamar',
                    'nama',
                    'no_ktp',
                    'tempat_lahir',
                    [
                        'attribute' => 'tanggal_lahir',
                        'format' => ['date', 'php:d-m-Y'],
                    ],
                    'jenis_kelamin',
                    'agama',
                    'golongan_darah',
                    'status',
                    'alamat_ktp:ntext',
                    'alamat_tinggal:ntext',
                    'email:email',
                    'no_telp',
                    'kontak_darurat',
                    'skill:ntext',
                    [
                        'attribute' => 'bersedia_ditempatkan',
                        'value' => $biodata->bersedia_ditempatkan ? 'Ya' : 'Tidak',
                    ],
                    [
                        'attribute' => 'penghasilan_diharapkan',
                        'value' => 'Rp ' . number_format($biodata->penghasilan_diharapkan, 0, ',', '.'),
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <h5>Riwayat Pendidikan:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenjang Pendidikan Terakhir</th>
                <th>Nama Institusi</th>
                <th>Jurusan</th>
                <th>Tahun Lulus</th>
                <th>IPK</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendidikan as $item): ?>
                <tr>
                    <td><?= Html::encode($item->jenjang) ?></td>
                    <td><?= Html::encode($item->institusi) ?></td>
                    <td><?= Html::encode($item->jurusan) ?></td>
                    <td><?= Html::encode($item->tahun_lulus) ?></td>
                    <td><?= Html::encode($item->ipk) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h5>Riwayat Pelatihan:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kursus/Seminar</th>
                <th>Sertifikat</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pelatihan as $item): ?>
                <tr>
                    <td><?= Html::encode($item->nama_kursus) ?></td>
                    <td><?= $item->sertifikat ? 'Ada' : 'Tidak Ada' ?></td>
                    <td><?= Html::encode($item->tahun) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h5>Riwayat Pekerjaan:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Posisi Terakhir</th>
                <th>Pendapatan Terakhir</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pekerjaan as $item): ?>
                <tr>
                    <td><?= Html::encode($item->nama_perusahaan) ?></td>
                    <td><?= Html::encode($item->posisi) ?></td>
                    <td><?= 'Rp ' . number_format($item->pendapatan, 0, ',', '.') ?></td>
                    <td><?= Html::encode($item->tahun) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-3">
        <?= Html::a('Edit', ['update', 'id' => $biodata->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $biodata->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Kembali', ['admin-index'], ['class' => 'btn btn-secondary']) ?>
    </div>

</div>
