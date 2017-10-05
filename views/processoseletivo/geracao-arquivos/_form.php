<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geracao-arquivos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gerarq_id')->textInput() ?>

    <?= $form->field($model, 'processo_id')->textInput() ?>

    <?= $form->field($model, 'curriculos_id')->textInput() ?>

    <?= $form->field($model, 'etapasprocesso_id')->textInput() ?>

    <?= $form->field($model, 'gerarq_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gerarq_documentos')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gerarq_emailconfirmacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gerarq_datarealizacao')->textInput() ?>

    <?= $form->field($model, 'gerarq_horarealizacao')->textInput() ?>

    <?= $form->field($model, 'gerarq_local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gerarq_endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gerarq_fase')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gerarq_tempo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gerarq_responsavel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
