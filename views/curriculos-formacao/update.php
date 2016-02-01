<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosFormacao */

$this->title = 'Update Curriculos Formacao: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Curriculos Formacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curriculos-formacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
