<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocontratacao\PedidoContratacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-contratacao-form">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<div class="panel panel-primary">
<div class="panel-heading">
  <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span>  Cadatrar Pedido de Contratação</h3>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'pedcontratacao_assunto')->textInput(['maxlength' => true]) ?></div>
    </div>

     <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'pedcontratacao_recursos')->textInput(['readonly' => true]) ?></div>

        <div class="col-md-4"> <?= $form->field($model, 'pedcontratacao_valortotal')->textInput(['class' => 'sum', 'readonly'=> true]) ?></div>
           
        <div class="col-md-4"><?= $form->field($model, 'pedcontratacao_responsavel')->textInput(['readonly' => true]) ?></div>
    </div>
       
</div>

<?= $this->render('_form-itens', [
    'form' => $form,
    'model' => $model,
    'contratacoes' => $contratacoes,
    'processo' => $processo,
    'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
]) ?>

    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

