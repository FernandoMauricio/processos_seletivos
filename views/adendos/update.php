<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adendos */

$this->title = 'Update Adendos: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adendos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adendos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
