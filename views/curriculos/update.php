<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */

$this->title = 'Update Curriculos: ' . ' ' . $model->cv_id;
$this->params['breadcrumbs'][] = ['label' => 'Curriculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cv_id, 'url' => ['view', 'id' => $model->cv_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curriculos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
