<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pendidikan $model */

$this->title = 'Create Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
