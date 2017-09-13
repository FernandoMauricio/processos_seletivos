<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocontratacao\PedidoContratacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-contratacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pedcontratacao_id') ?>

    <?= $form->field($model, 'pedcontratacao_assunto') ?>

    <?= $form->field($model, 'pedcontratacao_recursos') ?>

    <?= $form->field($model, 'pedcontratacao_valortotal') ?>

    <?= $form->field($model, 'pedcontratacao_data') ?>

    <?php // echo $form->field($model, 'pedcontratacao_aprovadorggp') ?>

    <?php // echo $form->field($model, 'pedcontratacao_situacaoggp') ?>

    <?php // echo $form->field($model, 'pedcontratacao_dataaprovacaoggp') ?>

    <?php // echo $form->field($model, 'pedcontratacao_aprovadordad') ?>

    <?php // echo $form->field($model, 'pedcontratacao_situacaodad') ?>

    <?php // echo $form->field($model, 'pedcontratacao_dataaprovacaodad') ?>

    <?php // echo $form->field($model, 'pedcontratacao_responsavel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
