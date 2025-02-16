<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Data Calon Karyawan';
?>

<div class="site-dashboard">
    <div style="background-color: #212529; padding: 15px; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 20px; font-weight: bold;">
            <?= Html::encode($this->title) ?>
        </h1>
    </div>

    <?php if ($biodata): ?>
        <table class="table table-bordered" style="border-radius: 0 0 8px 8px; overflow: hidden;">
            <tr><th>1. Posisi yang Dilamar</th><td><?= Html::encode($biodata->posisi_dilamar) ?></td></tr>
            <tr><th>2. Nama</th><td><?= Html::encode($biodata->nama) ?></td></tr>
            <tr><th>3. No. KTP</th><td><?= Html::encode($biodata->no_ktp) ?></td></tr>
            <tr><th>4. Tempat, Tanggal Lahir</th><td><?= Html::encode($biodata->tempat_lahir) ?>, <?= Yii::$app->formatter->asDate($biodata->tanggal_lahir, 'php:d-m-Y') ?></td></tr>
            <tr><th>5. Jenis Kelamin</th><td><?= Html::encode($biodata->jenis_kelamin) ?></td></tr>
            <tr><th>6. Agama</th><td><?= Html::encode($biodata->agama) ?></td></tr>
            <tr><th>7. Golongan Darah</th><td><?= Html::encode($biodata->golongan_darah) ?></td></tr>
            <tr><th>8. Status</th><td><?= Html::encode($biodata->status) ?></td></tr>
            <tr><th>9. Alamat KTP</th><td><?= Html::encode($biodata->alamat_ktp) ?></td></tr>
            <tr><th>10. Alamat Tinggal</th><td><?= Html::encode($biodata->alamat_tinggal) ?></td></tr>
            <tr><th>11. Email</th><td><?= Html::encode($biodata->email) ?></td></tr>
            <tr><th>12. No. Telp</th><td><?= Html::encode($biodata->no_telp) ?></td></tr>
            <tr><th>13. Orang Terdekat yang Dapat Dihubungi</th><td><?= Html::encode($biodata->kontak_darurat) ?></td></tr>

 <tr><th colspan="2">14. Pendidikan Terakhir:</th></tr>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered">
                        <thead class="table-header">
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
                </td>
            </tr>

 <tr><th colspan="2">15. Riwayat Pelatihan:</th></tr>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered">
                        <thead class="table-header">
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
                                    <td><?= $item->sertifikat ? 'Ada' : 'Tidak' ?></td>
                                    <td><?= Html::encode($item->tahun) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr><th colspan="2">16. Riwayat Pekerjaan:</th></tr>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered">
                        <thead class="table-header">
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
                                    <td>Rp <?= number_format($item->pendapatan, 0, ',', '.') ?></td>
                                    <td><?= Html::encode($item->tahun) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr><th>17. Skill</th><td><?= Html::encode($biodata->skill) ?></td></tr>
            <tr><th>18. Bersedia Ditempatkan di Seluruh Indonesia</th><td><?= $biodata->bersedia_ditempatkan ? 'Ya' : 'Tidak' ?></td></tr>
            <tr><th>19. Penghasilan yang Diharapkan</th><td>Rp <?= number_format($biodata->penghasilan_diharapkan, 0, ',', '.') ?></td></tr>
        </table>

        <div style="margin-top: 10px;">
            <?= Html::a('Edit Biodata', ['biodata/update', 'id' => $biodata->id], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php else: ?>
        <p>Anda belum mengisi biodata.</p>
        <?= Html::a('Isi Biodata', ['biodata/create'], ['class' => 'btn btn-success']) ?>
    <?php endif; ?>
</div>

<style>
    .table-header th {
        background-color:rgb(134, 132, 132) !important; 
        color: black !important; 
        text-align: center;
        font-weight: bold;
    }
</style>
