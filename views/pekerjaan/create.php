<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pekerjaan $model */

$this->title = 'Create Pekerjaan';
$this->params['breadcrumbs'][] = ['label' => 'Pekerjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
