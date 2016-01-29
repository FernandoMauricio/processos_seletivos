<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosEndereco */

$this->title = 'Update Curriculos Endereco: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Curriculos Enderecos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curriculos-endereco-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
