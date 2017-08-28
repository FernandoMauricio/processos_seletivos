<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;

use wbraganca\dynamicform\DynamicFormWidget;

?>
       <?php DynamicFormWidget::begin([
          'widgetContainer' => 'dynamicform_pedidocusto', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
          'widgetBody' => '.container-items-pedidocusto', // required: css class selector
          'widgetItem' => '.item-pedidocusto', // required: css class
          'limit' => 999, // the maximum times, an element can be cloned (default 999)
          'min' => 1, // 0 or 1 (default 1)
          'insertButton' => '.add-item-pedidocusto', // css class
          'deleteButton' => '.remove-item-pedidocusto', // css class
          'model' => $modelsItens[0],
          'formId' => 'dynamic-form',
          'formFields' => [
              'itemcusto_id',
              'contratacao_id',
              'itemcusto_unidade',
              'itemcusto_quantidade',
              'itemcusto_tipocontrato',
              'itemcusto_area',
              'itemcusto_chsemanal',
              'itemcusto_cargo',
              'itemcusto_salario',
              'itemcusto_encargos',
              'itemcusto_total',
              'itemcusto_justificativa',
              'itemcusto_dataingresso',
          ],
      ]); ?>

<div class="panel panel-info">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-list-alt"></i> Listagem de Contratações
        <button type="button" class="pull-right add-item-pedidocusto btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body container-items-pedidocusto"><!-- widgetContainer -->
    <?php foreach ($modelsItens as $i => $modelItens): ?>
      <div class="item-pedidocusto panel panel-default"><!-- widgetBody -->
        <div class="panel-heading">
            <span class="panel-title-pedidocusto">Item: <?= ($i + 1) ?></span>
            <button type="button" class="pull-right remove-item-pedidocusto btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
            <button type="button" class="pull-right add-item-pedidocusto btn btn-success btn-xs" style="margin-right: 12px;"><i class="glyphicon glyphicon-plus"></i></button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          <?php
              // necessary for update action.
              if (!$modelItens->isNewRecord) {
                  echo Html::activeHiddenInput($modelItens, "[{$i}]itemcusto_id");
              }
          ?>
            <div class="row">
              <div class="col-sm-2">
              <?php
                   $data_contratacoes = ArrayHelper::map($contratacoes, 'id', 'id');
                   echo $form->field($modelItens, "[{$i}]contratacao_id")->widget(Select2::classname(), [
                           'data' =>  $data_contratacoes,
                           'options' => ['placeholder' => 'Selecione a Solicitação...',
                           'onchange'=>'
                                   var select = this;
                                   $.getJSON( "'.Url::toRoute('/pedidos/pedido-custo/get-contratacao').'", { contratacaoId: $(this).val() } )
                                   .done(function( data ) {
                                          var $divPanelBody        =  $(select).parent().parent().parent();
                                          var $inputUnidade        = $divPanelBody.find("input:eq(0)");
                                          var $inputCargo          = $divPanelBody.find("input:eq(1)");
                                          var $inputQuant          = $divPanelBody.find("input:eq(2)");
                                          var $inputPeriodo        = $divPanelBody.find("input:eq(3)");
                                          var $inputArea           = $divPanelBody.find("input:eq(4)");
                                          var $inputCHSemana       = $divPanelBody.find("input:eq(5)");
                                          var $inputSalario        = $divPanelBody.find("input:eq(6)");
                                          var $inputEncargos       = $divPanelBody.find("input:eq(7)");
                                          var $inputTotal          = $divPanelBody.find("input:eq(8)");
                                          var $inputJustificativa  = $divPanelBody.find("input:eq(9)");
                                          var $inputDataIngresso   = $divPanelBody.find("input:eq(10)");

                                          $inputUnidade.val(data.unidade);
                                          $inputCargo.val(data.cargo);
                                          $inputQuant.val(data.quant_pessoa);
                                          $inputPeriodo.val(data.periodo == 1 ? "Inderterminado" : "Determinado");
                                          $inputArea.val(data.cargo_area);
                                          $inputCHSemana.val(data.cargo_chsemanal);
                                          $inputSalario.val(data.cargo_salario);
                                          $inputEncargos.val(data.cargo_encargos);
                                          $inputTotal.val(data.cargo_valortotal);
                                          $inputJustificativa.val(data.motivo);
                                          $inputDataIngresso.val(data.data_ingresso);

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

              <div class="col-sm-6"><?= $form->field($modelItens, "[{$i}]itemcusto_unidade")->textInput(['readonly'=> true]) ?></div>

              <div class="col-sm-3"><?= $form->field($modelItens, "[{$i}]itemcusto_cargo")->textInput(['readonly'=> true]) ?></div>
                  
              <div class="col-sm-1"><?= $form->field($modelItens, "[{$i}]itemcusto_quantidade")->textInput(['readonly'=> true]) ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_tipocontrato")->textInput(['readonly'=> true]) ?></div>
                 
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_area")->textInput(['readonly'=> true]) ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_chsemanal")->textInput(['readonly'=> true]) ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_salario")->textInput(['readonly'=> true ]) ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_encargos")->textInput(['readonly'=> true]) ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_total")->textInput(['maxlength' => true,'class' => 'sumPart']) ?></div>
             
              <div class="col-sm-10"><?= $form->field($modelItens,"[{$i}]itemcusto_justificativa")->textInput() ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcusto_dataingresso")->textInput(['readonly'=> true]) ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
</div>
            <?php DynamicFormWidget::end(); ?>

<?php
/* start getting the totalamount */
$script = <<<EOD
    var getSum = function() {

        var items = $(".item-pedidocusto");
        var sum = 0;

        items.each(function (index, elem) {
            var priceValue = $(elem).find(".sumPart").val();
            //Check if priceValue is numeric or something like that
            sum = parseInt(sum) + parseInt(priceValue);
        });
        //Assign the sum value to the field
        $(".sum").val(sum);
    };

    //Bind new elements to support the function too
    $(".container-items-pedidocusto").on("change", ".sumPart", function() {
        getSum();
    });
EOD;
$this->registerJs($script);
/*end getting the totalamount */
?>

<?php

$js = '

jQuery(".dynamicform_pedidocusto").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_pedidocusto .panel-title-pedidocusto").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_pedidocusto").on("afterDelete", function(e) {

  var items = $(".item-pedidocusto");
        var sum = 0;

    jQuery(".dynamicform_pedidocusto .panel-title-pedidocusto").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });

   getSum();
});

';

$this->registerJs($js);

?>

