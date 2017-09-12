<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocusto\PedidoCustoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-custo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'custo_id') ?>

    <?= $form->field($model, 'custo_assunto') ?>

    <?= $form->field($model, 'custo_recursos') ?>

    <?= $form->field($model, 'custo_valortotal') ?>

    <?= $form->field($model, 'custo_data') ?>

    <?php // echo $form->field($model, 'custo_aprovadorggp') ?>

    <?php // echo $form->field($model, 'custo_situacaoggp') ?>

    <?php // echo $form->field($model, 'custo_dataaprovacaoggp') ?>

    <?php // echo $form->field($model, 'custo_aprovadordad') ?>

    <?php // echo $form->field($model, 'custo_situacaodad') ?>

    <?php // echo $form->field($model, 'custo_dataaprovacaodad') ?>

    <?php // echo $form->field($model, 'custo_responsavel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
