<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/** @var yii\web\View $this */
/** @var app\models\Biodata $model */
/** @var app\models\Pendidikan[] $pendidikanModels */
/** @var app\models\Pelatihan[] $pelatihanModels */
/** @var app\models\Pekerjaan[] $pekerjaanModels */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="biodata-form">

    <?php $form = ActiveForm::begin(); ?>

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
<?php foreach ($pendidikanModels as $i => $pendidikanModel): ?>
    <?= $form->field($pendidikanModel, "[$i]jenjang")->textInput() ?>
    <?= $form->field($pendidikanModel, "[$i]institusi")->textInput() ?>
    <?= $form->field($pendidikanModel, "[$i]jurusan")->textInput() ?>
    <?= $form->field($pendidikanModel, "[$i]tahun_lulus")->textInput() ?>
    <?= $form->field($pendidikanModel, "[$i]ipk")->textInput() ?>
<?php endforeach; ?>


<h3>Riwayat Pelatihan</h3>
<?php foreach ($pelatihanModels as $i => $pelatihanModel): ?>
    <?= $form->field($pelatihanModel, "[$i]nama_kursus")->textInput() ?>
    <?= $form->field($pelatihanModel, "[$i]tahun")->textInput() ?>
<?php endforeach; ?>


<h3>Riwayat Pekerjaan</h3>
<?php foreach ($pekerjaanModels as $i => $pekerjaanModel): ?>
    <?= $form->field($pekerjaanModel, "[$i]nama_perusahaan")->textInput() ?>
    <?= $form->field($pekerjaanModel, "[$i]posisi")->textInput() ?>
    <?= $form->field($pekerjaanModel, "[$i]tahun")->textInput() ?>
<?php endforeach; ?>


    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Batal', Yii::$app->user->identity->role == 'admin' ? ['biodata/admin-index'] : ['site/dashboard-user'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
