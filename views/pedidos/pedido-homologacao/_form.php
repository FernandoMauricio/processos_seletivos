<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-homologacao-form">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<div class="panel panel-primary">
<div class="panel-heading">
  <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span>  Cadastrar Pedido de Homologação</h3>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'contratacao_id')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-3"><?= $form->field($model, 'homolog_cargo')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_salario')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_encargos')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-3"><?= $form->field($model, 'homolog_total')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'homolog_tipo')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-5"><?= $form->field($model, 'homolog_unidade')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-5"><?= $form->field($model, 'homolog_motivo')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'homolog_validade')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'homolog_sintese')->textarea(['rows' => 6]) ?></div>
    </div>
       
</div>


</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    <?php //echo $form->field($model, '')->textInput() ?>

    <?php //echo $form->field($model, '')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, '')->textInput() ?>

    <?php //echo $form->field($model, '')->textInput() ?>

    <?php //echo $form->field($model, '')->textInput() ?>

    <?php //echo $form->field($model, '')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, '')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, '')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, '')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, '')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'homolog_aprovadorggp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'homolog_situacaoggp')->textInput() ?>

    <?php //echo $form->field($model, 'homolog_dataaprovacaoggp')->textInput() ?>

    <?php //echo $form->field($model, 'homolog_aprovadordad')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'homolog_situacaodad')->textInput() ?>

    <?php //echo $form->field($model, 'homolog_dataaprovacaodad')->textInput() ?>

    <?php //echo $form->field($model, 'homolog_responsavel')->textInput(['maxlength' => true]) ?>