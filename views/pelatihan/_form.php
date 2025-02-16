<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pelatihan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelatihan-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_kursus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sertifikat')->dropDownList([1 => 'Ada', 0 => 'Tidak'], ['prompt' => 'Pilih']) ?>

    <?= $form->field($model, 'tahun')->textInput(['type' => 'number', 'maxlength' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
