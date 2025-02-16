<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pendidikan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pendidikan-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenjang')->dropDownList([
        'D3' => 'D3',
        'S1' => 'S1',
        'S2' => 'S2',
        'S3' => 'S3',
    ], ['prompt' => 'Pilih Jenjang Pendidikan']) ?>

    <?= $form->field($model, 'institusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jurusan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_lulus')->textInput(['type' => 'number', 'min' => 1900, 'max' => date('Y')]) ?>

    <?= $form->field($model, 'ipk')->textInput(['type' => 'number', 'step' => '0.01', 'min' => 0, 'max' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
