<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BiodataSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="biodata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'posisi_dilamar') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_ktp') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'golongan_darah') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'alamat_ktp') ?>

    <?php // echo $form->field($model, 'alamat_tinggal') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'no_telp') ?>

    <?php // echo $form->field($model, 'kontak_darurat') ?>

    <?php // echo $form->field($model, 'skill') ?>

    <?php // echo $form->field($model, 'bersedia_ditempatkan')->checkbox() ?>

    <?php // echo $form->field($model, 'penghasilan_diharapkan') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
