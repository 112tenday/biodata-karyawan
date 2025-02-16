<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Daftar Akun';
?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h1 class="text-center mb-3"><?= Html::encode($this->title) ?></h1>
        <p class="text-center text-muted">Silakan isi form berikut untuk membuat akun:</p>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Masukkan Email'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Masukkan Password'])->label(false) ?>

        <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => 'Konfirmasi Password'])->label(false) ?>

        <div class="d-grid mt-3">
            <?= Html::submitButton('Daftar', ['class' => 'btn btn-success btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="text-center mt-3">
            <p>Sudah punya akun? <?= Html::a('Login di sini', ['site/login']) ?></p>
        </div>
    </div>
</div>
