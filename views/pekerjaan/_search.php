<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PekerjaanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pekerjaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'biodata_id') ?>

    <?= $form->field($model, 'nama_perusahaan') ?>

    <?= $form->field($model, 'posisi') ?>

    <?= $form->field($model, 'pendapatan') ?>

    <?php // echo $form->field($model, 'tahun') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
