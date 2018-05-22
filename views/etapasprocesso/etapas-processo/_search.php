<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcessoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="etapas-processo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'etapa_id') ?>

    <?= $form->field($model, 'processo_id') ?>

    <?= $form->field($model, 'etapa_cargo') ?>

    <?= $form->field($model, 'etapa_data') ?>

    <?= $form->field($model, 'etapa_atualizadopor') ?>

    <?php // echo $form->field($model, 'etapa_dataatualizacao') ?>

    <?php // echo $form->field($model, 'etapa_situacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
