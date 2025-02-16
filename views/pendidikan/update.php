<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pendidikan $model */

$this->title = 'Update Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Pendidikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendidikan-update container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
