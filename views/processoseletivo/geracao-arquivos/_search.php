<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\GeracaoArquivosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geracao-arquivos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gerarq_id') ?>

    <?= $form->field($model, 'processo_id') ?>

    <?= $form->field($model, 'curriculos_id') ?>

    <?= $form->field($model, 'etapasprocesso_id') ?>

    <?= $form->field($model, 'gerarq_titulo') ?>

    <?php // echo $form->field($model, 'gerarq_documentos') ?>

    <?php // echo $form->field($model, 'gerarq_emailconfirmacao') ?>

    <?php // echo $form->field($model, 'gerarq_datarealizacao') ?>

    <?php // echo $form->field($model, 'gerarq_horarealizacao') ?>

    <?php // echo $form->field($model, 'gerarq_local') ?>

    <?php // echo $form->field($model, 'gerarq_endereco') ?>

    <?php // echo $form->field($model, 'gerarq_fase') ?>

    <?php // echo $form->field($model, 'gerarq_tempo') ?>

    <?php // echo $form->field($model, 'gerarq_responsavel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
