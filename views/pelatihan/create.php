<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pelatihan $model */

$this->title = 'Create Pelatihan';
$this->params['breadcrumbs'][] = ['label' => 'Pelatihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelatihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
