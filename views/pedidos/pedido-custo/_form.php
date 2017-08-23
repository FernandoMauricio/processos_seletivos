<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\PedidoCusto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-custo-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>


<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'custo_assunto')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'custo_recursos')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'custo_valortotal')->textInput() ?>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'custo_responsavel')->textInput(['readonly' => true]) ?>
        </div>
    </div>


<?= $this->render('_form-itens', [
    'form' => $form,
    'model' => $model,
    'contratacao' => $contratacao,
    'contratacoes' => $contratacoes,
    'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
]) ?>

</div>

    <?php //echo $form->field($model, 'custo_data')->textInput() ?>

    <?php //echo $form->field($model, 'custo_aprovadorggp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'custo_situacaoggp')->textInput() ?>

    <?php //echo $form->field($model, 'custo_dataaprovacaoggp')->textInput() ?>

    <?php //echo $form->field($model, 'custo_aprovadordad')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'custo_situacaodad')->textInput() ?>

    <?php //echo $form->field($model, 'custo_dataaprovacaodad')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
