<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PendidikanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pendidikan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'biodata_id') ?>

    <?= $form->field($model, 'jenjang') ?>

    <?= $form->field($model, 'institusi') ?>

    <?= $form->field($model, 'jurusan') ?>

    <?php // echo $form->field($model, 'tahun_lulus') ?>

    <?php // echo $form->field($model, 'ipk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
