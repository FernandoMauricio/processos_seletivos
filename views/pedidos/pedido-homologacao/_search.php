<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-homologacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'homolog_id') ?>

    <?= $form->field($model, 'contratacao_id') ?>

    <?= $form->field($model, 'homolog_cargo') ?>

    <?= $form->field($model, 'homolog_salario') ?>

    <?= $form->field($model, 'homolog_encargos') ?>

    <?php // echo $form->field($model, 'homolog_total') ?>

    <?php // echo $form->field($model, 'homolog_tipo') ?>

    <?php // echo $form->field($model, 'homolog_unidade') ?>

    <?php // echo $form->field($model, 'homolog_motivo') ?>

    <?php // echo $form->field($model, 'homolog_sintese') ?>

    <?php // echo $form->field($model, 'homolog_validade') ?>

    <?php // echo $form->field($model, 'homolog_aprovadorggp') ?>

    <?php // echo $form->field($model, 'homolog_situacaoggp') ?>

    <?php // echo $form->field($model, 'homolog_dataaprovacaoggp') ?>

    <?php // echo $form->field($model, 'homolog_aprovadordad') ?>

    <?php // echo $form->field($model, 'homolog_situacaodad') ?>

    <?php // echo $form->field($model, 'homolog_dataaprovacaodad') ?>

    <?php // echo $form->field($model, 'homolog_responsavel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
