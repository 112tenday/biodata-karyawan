<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h1 class="text-center mb-3"><?= Html::encode($this->title) ?></h1>
        <p class="text-center text-muted">Silakan masukkan email dan password Anda:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Masukkan Email'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Masukkan Password'])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="d-grid">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="text-center mt-3">
            <p>Belum punya akun?</p>
            <?= Html::a('Daftar Sekarang', ['site/signup'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
