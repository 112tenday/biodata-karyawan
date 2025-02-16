<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Biodata $model */
/** @var app\models\Pendidikan[] $pendidikanModels */
/** @var app\models\Pelatihan[] $pelatihanModels */
/** @var app\models\Pekerjaan[] $pekerjaanModels */

$this->title = 'Edit Biodata: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Biodata', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biodata-update">

    <!-- Header -->
    <div style="background-color: #212529; padding: 15px; border-radius: 8px 8px 0 0;">
        <h2 style="color: white; margin: 0; font-size: 20px; font-weight: bold;">
            <?= Html::encode($this->title) ?>
        </h2>
    </div>

    <!-- Flash Message -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <div class="card" style="border-radius: 0 0 8px 8px; padding: 15px;">
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>

        <h3>Data Pribadi</h3>
        <?= $form->field($model, 'posisi_dilamar')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'no_ktp')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tanggal_lahir')->input('date') ?>
        <?= $form->field($model, 'jenis_kelamin')->dropDownList([
            'Laki-laki' => 'Laki-laki',
            'Perempuan' => 'Perempuan',
        ], ['prompt' => 'Pilih Jenis Kelamin']) ?>
        <?= $form->field($model, 'agama')->dropDownList([
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Buddha' => 'Buddha',
            'Konghucu' => 'Konghucu',
        ], ['prompt' => 'Pilih Agama']) ?>
        <?= $form->field($model, 'golongan_darah')->dropDownList([
            'A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O',
        ], ['prompt' => 'Pilih Golongan Darah']) ?>
        <?= $form->field($model, 'status')->dropDownList([
            'Belum Menikah' => 'Belum Menikah',
            'Menikah' => 'Menikah',
            'Cerai' => 'Cerai',
        ], ['prompt' => 'Pilih Status']) ?>
        <?= $form->field($model, 'alamat_ktp')->textarea(['rows' => 2]) ?>
        <?= $form->field($model, 'alamat_tinggal')->textarea(['rows' => 2]) ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'kontak_darurat')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'skill')->textarea(['rows' => 2]) ?>
        <?= $form->field($model, 'bersedia_ditempatkan')->dropDownList([
            1 => 'Ya',
            0 => 'Tidak',
        ], ['prompt' => 'Pilih']) ?>
        <?= $form->field($model, 'penghasilan_diharapkan')->textInput(['type' => 'number']) ?>


        <h3>Riwayat Pendidikan</h3>
        <div id="pendidikan-wrapper">
            <?php foreach ($pendidikanModels as $i => $pendidikan): ?>
                <div class="pendidikan-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <?= Html::hiddenInput("Pendidikan[$i][id]", $pendidikan->id) ?>
                    <?= Html::textInput("Pendidikan[$i][jenjang]", $pendidikan->jenjang, ['class' => 'form-control', 'placeholder' => 'Jenjang']) ?>
                    <?= Html::textInput("Pendidikan[$i][institusi]", $pendidikan->institusi, ['class' => 'form-control', 'placeholder' => 'Institusi']) ?>
                    <?= Html::textInput("Pendidikan[$i][jurusan]", $pendidikan->jurusan, ['class' => 'form-control', 'placeholder' => 'Jurusan']) ?>
                    <?= Html::textInput("Pendidikan[$i][tahun_lulus]", $pendidikan->tahun_lulus, ['class' => 'form-control', 'placeholder' => 'Tahun Lulus']) ?>
                    <?= Html::textInput("Pendidikan[$i][ipk]", $pendidikan->ipk, ['class' => 'form-control', 'placeholder' => 'IPK']) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <h3>Riwayat Pelatihan</h3>
        <div id="pelatihan-wrapper">
            <?php foreach ($pelatihanModels as $i => $pelatihan): ?>
                <div class="pelatihan-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <?= Html::hiddenInput("Pelatihan[$i][id]", $pelatihan->id) ?>
                    <?= Html::textInput("Pelatihan[$i][nama_kursus]", $pelatihan->nama_kursus, ['class' => 'form-control', 'placeholder' => 'Nama Kursus']) ?>
                    <?= Html::textInput("Pelatihan[$i][sertifikat]", $pelatihan->sertifikat, ['class' => 'form-control', 'placeholder' => 'Sertifikat (1: Ada, 0: Tidak)']) ?>
                    <?= Html::textInput("Pelatihan[$i][tahun]", $pelatihan->tahun, ['class' => 'form-control', 'placeholder' => 'Tahun']) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <h3>Riwayat Pekerjaan</h3>
        <div id="pekerjaan-wrapper">
            <?php foreach ($pekerjaanModels as $i => $pekerjaan): ?>
                <div class="pekerjaan-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <?= Html::hiddenInput("Pekerjaan[$i][id]", $pekerjaan->id) ?>
                    <?= Html::textInput("Pekerjaan[$i][nama_perusahaan]", $pekerjaan->nama_perusahaan, ['class' => 'form-control', 'placeholder' => 'Nama Perusahaan']) ?>
                    <?= Html::textInput("Pekerjaan[$i][posisi]", $pekerjaan->posisi, ['class' => 'form-control', 'placeholder' => 'Posisi']) ?>
                    <?= Html::textInput("Pekerjaan[$i][pendapatan]", $pekerjaan->pendapatan, ['class' => 'form-control', 'placeholder' => 'Pendapatan']) ?>
                    <?= Html::textInput("Pekerjaan[$i][tahun]", $pekerjaan->tahun, ['class' => 'form-control', 'placeholder' => 'Tahun']) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Batal', ['site/dashboard-user'], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>

</div>
