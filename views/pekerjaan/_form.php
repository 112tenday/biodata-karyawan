<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="pekerjaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Posisi Terakhir</th>
                <th>Pendapatan Terakhir</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true])->label(false) ?></td>
                <td><?= $form->field($model, 'posisi')->textInput(['maxlength' => true])->label(false) ?></td>
                <td><?= $form->field($model, 'pendapatan')->textInput(['maxlength' => true])->label(false) ?></td>
                <td><?= $form->field($model, 'tahun')->textInput(['maxlength' => true])->label(false) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
