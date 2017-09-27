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
            <div class="col-md-2">
                <?php
                   $data_contratacoes = ArrayHelper::map($contratacoes, 'id', 'id');
                   echo $form->field($model, 'contratacao_id')->widget(Select2::classname(), [
                           'data' =>  $data_contratacoes,
                           'options' => ['placeholder' => 'Selecione a Solicitação...',
                           'onchange'=>'
                                   var select = this;
                                   $.getJSON( "'.Url::toRoute('/pedidos/pedido-homologacao/get-contratacao-candidatos-aprovados').'", { contratacaoId: $(this).val() } )
                                   .done(function( data ) {
                                          var $divPanelBody        =  $(select).parent().parent().parent().parent();
                                          var $inputUnidade        = $divPanelBody.find("input:eq(5)");
                                          var $inputCargo          = $divPanelBody.find("input:eq(0)");
                                          var $inputPeriodo        = $divPanelBody.find("input:eq(4)");
                                          var $inputSalario        = $divPanelBody.find("input:eq(1)");
                                          var $inputEncargos       = $divPanelBody.find("input:eq(2)");
                                          var $inputTotal          = $divPanelBody.find("input:eq(3)");
                                          var $inputJustificativa  = $divPanelBody.find("input:eq(6)");
                                          var $inputDataIngresso   = $divPanelBody.find("input:eq(10)");

                                          $inputUnidade.val(data.unidade);
                                          $inputCargo.val(data.cargo_descricao);
                                          $inputPeriodo.val(data.periodo == 1 ? "Indeterminado" : "Determinado");
                                          $inputSalario.val(data.cargo_salario);
                                          $inputEncargos.val(data.cargo_encargos);
                                          $inputTotal.val(data.cargo_valortotal);
                                          $inputJustificativa.val(data.motivo);
                                          $inputDataIngresso.val(data.data_ingresso_prevista);

                                        //Somar total de custo de todos os itens
                                         var items = $(".item-pedidocusto");
                                         var sum = 0;
                                                items.each(function (index, elem) {
                                                    var priceValue = $(elem).find(".sumPart").val();
                                                    //Check if priceValue is numeric or something like that
                                                    sum = parseInt(sum) + parseInt(priceValue);
                                                });
                                                //Assign the sum value to the field
                                                $(".sum").val(sum);
                                       });
                                   '
                           ]]);
                ?>
        </div>

        <div class="col-md-3"><?= $form->field($model, 'homolog_cargo')->textInput(['maxlength' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_salario')->textInput(['maxlength' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_encargos')->textInput(['maxlength' => true]) ?></div>

        <div class="col-md-3"><?= $form->field($model, 'homolog_total')->textInput(['maxlength' => true]) ?></div>
    </div>

     <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'homolog_tipo')->textInput(['maxlength' => true]) ?></div>

        <div class="col-md-5"><?= $form->field($model, 'homolog_unidade')->textInput(['maxlength' => true]) ?></div>

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