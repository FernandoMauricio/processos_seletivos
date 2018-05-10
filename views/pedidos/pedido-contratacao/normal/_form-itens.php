<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\depdrop\DepDrop;


?>
       <?php DynamicFormWidget::begin([
          'widgetContainer' => 'dynamicform_pedidocontratacao', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
          'widgetBody' => '.container-items-pedidocontratacao', // required: css class selector
          'widgetItem' => '.item-pedidocontratacao', // required: css class
          'limit' => 999, // the maximum times, an element can be cloned (default 999)
          'min' => 1, // 0 or 1 (default 1)
          'insertButton' => '.add-item-pedidocontratacao', // css class
          'deleteButton' => '.remove-item-pedidocontratacao', // css class
          'model' => $modelsItens[0],
          'formId' => 'dynamic-form',
          'formFields' => [
              'id',
              'pedidocontratacao_id',
              'contratacao_id',
              'etapasprocesso_id',
              'itemcontratacao_unidade',
              'itemcontratacao_cargo',
              'itemcontratacao_nome',
              'itemcontratacao_processoseletivo',
              'itemcontratacao_tipocontrato',
              'itemcontratacao_chsemanal',
              'itemcontratacao_total',
              'itemcontratacao_justificativa',
              'itemcontratacao_dataingresso',
          ],
      ]); ?>

<div class="panel panel-info">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-list-alt"></i> Listagem de Contratações
        <button type="button" class="pull-right add-item-pedidocontratacao btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body container-items-pedidocontratacao"><!-- widgetContainer -->
    <?php foreach ($modelsItens as $i => $modelItens): ?>
      <div class="item-pedidocontratacao panel panel-default"><!-- widgetBody -->
        <div class="panel-heading">
            <span class="panel-title-pedidocontratacao">Item: <?= ($i + 1) ?></span>
            <button type="button" class="pull-right remove-item-pedidocontratacao btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
            <button type="button" class="pull-right add-item-pedidocontratacao btn btn-success btn-xs" style="margin-right: 12px;"><i class="glyphicon glyphicon-plus"></i></button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
          <?php
              // necessary for update action.
              if (!$modelItens->isNewRecord) {
                  echo Html::activeHiddenInput($modelItens, "[{$i}]id");
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
                                          var $inputArea           = $divPanelBody.find("input:eq(2)");
                                          var $inputPeriodo        = $divPanelBody.find("input:eq(3)");
                                          var $inputCHSemana       = $divPanelBody.find("input:eq(4)");
                                          var $inputTotal          = $divPanelBody.find("input:eq(5)");
                                          var $inputJustificativa  = $divPanelBody.find("input:eq(6)");
                                          var $inputDataIngresso   = $divPanelBody.find("input:eq(7)");

                                          $inputUnidade.val(data.unidade);
                                          $inputCargo.val(data.cargo_descricao);
                                          $inputArea.val(data.cargo_area);
                                          $inputPeriodo.val(data.periodo == 1 ? "Indeterminado" : "Determinado");
                                          $inputCHSemana.val(data.cargo_chsemanal);
                                          $inputTotal.val(data.cargo_valortotal);
                                          $inputJustificativa.val(data.motivo);
                                          $inputDataIngresso.val(data.data_ingresso_prevista);

                                        //Somar total de custo de todos os itens
                                         var items = $(".item-pedidocontratacao");
                                         var sum = 0;
                                                items.each(function (index, elem) {
                                                    var priceValue = $(elem).find(".sumPart").val();
                                                    //Check if priceValue is numeric or something like that
                                                    sum = parseFloat(sum) + parseFloat(priceValue);
                                                });
                                                //Assign the sum value to the field
                                                $(".sum").val(sum);
                                       });
                                   '
                           ]]);
                ?>
              </div>

              <div class="col-sm-5"><?= $form->field($modelItens, "[{$i}]itemcontratacao_unidade")->textInput(['readonly'=> true]) ?></div>

              <div class="col-sm-3"><?= $form->field($modelItens, "[{$i}]itemcontratacao_cargo")->textInput(['readonly'=> true]) ?></div>

              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcontratacao_area")->textInput(['readonly'=> true]) ?></div>

              <div class="col-sm-4">
                    <?php 
                        $options = \yii\helpers\ArrayHelper::map($processo, 'etapa_id', 'etapa_cargo');
                            echo $form->field($modelItens, "[{$i}]etapasprocesso_id")->widget(Select2::classname(), [
                                'data' => $options,
                                'options' => ['id'=>"pedidocontratacaoitens-".$i."-etapasprocesso_id", 'placeholder' => 'Informe o Documento de Abertura...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);  
                    ?>
              </div>

              <div class="col-sm-8">
                  <?php
                      echo $form->field($modelItens, "[{$i}]itemcontratacao_nome")->widget(DepDrop::classname(), [
                              'type'=>DepDrop::TYPE_SELECT2,
                              'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                              'pluginOptions'=>[
                                  'depends'=>["pedidocontratacaoitens-".$i."-etapasprocesso_id"],
                                  'placeholder'=>'Selecione o Candidato...',
                                  'initialize' => true,
                                  'url'=>Url::to(['/pedidos/pedido-contratacao/get-candidatos-aprovados'])
                              ]
                          ]);
                  ?>
              </div>
                 
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcontratacao_tipocontrato")->textInput(['readonly'=> true]) ?></div>

              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcontratacao_chsemanal")->textInput(['readonly'=> true]) ?></div>
             
              <div class="col-sm-3"><?= $form->field($modelItens, "[{$i}]itemcontratacao_total")->textInput(['maxlength' => true,'class' => 'sumPart', 'readonly' => true]) ?></div>
             
              <div class="col-sm-10"><?= $form->field($modelItens, "[{$i}]itemcontratacao_justificativa")->textInput() ?></div>
             
              <div class="col-sm-2"><?= $form->field($modelItens, "[{$i}]itemcontratacao_dataingresso")->textInput() ?></div>
             
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

        var items = $(".item-pedidocontratacao");
        var sum = 0;

        items.each(function (index, elem) {
            var priceValue = $(elem).find(".sumPart").val();
            //Check if priceValue is numeric or something like that
            sum = parseFloat(sum) + parseFloat(priceValue);
        });
        //Assign the sum value to the field
        $(".sum").val(sum);
    };

    //Bind new elements to support the function too
    $(".container-items-pedidocontratacao").on("change", ".sumPart", function() {
        getSum();
    });
EOD;
$this->registerJs($script);
/*end getting the totalamount */
?>

<?php

$js = '

jQuery(".dynamicform_pedidocontratacao").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_pedidocontratacao .panel-title-pedidocontratacao").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_pedidocontratacao").on("afterDelete", function(e) {

  var items = $(".item-pedidocontratacao");
        var sum = 0;

    jQuery(".dynamicform_pedidocontratacao .panel-title-pedidocontratacao").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });

   getSum();
});

';

$this->registerJs($js);

?>

