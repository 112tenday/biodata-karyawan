<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Biodata $model */

$this->title = 'Tambah Biodata';
?>
<div class="biodata-create">
    <div style="background-color: #212529; padding: 15px; border-radius: 8px 8px 0 0;">
        <h2 style="color: white; margin: 0;"><?= Html::encode($this->title) ?></h2>
    </div>

    <div class="card" style="padding: 15px;">
        <?= $this->render('_form', [
            'model' => $model,
            'pendidikanModels' => $pendidikanModels,
            'pelatihanModels' => $pelatihanModels,
            'pekerjaanModels' => $pekerjaanModels,
        ]) ?>
    </div>
</div>
