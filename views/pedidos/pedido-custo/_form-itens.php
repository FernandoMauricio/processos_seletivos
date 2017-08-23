<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\helpers\Url;

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
          ],
      ]); ?>

        <div class="panel panel-default">
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

                                                                var $divPanelBody =  $(select).parent().parent().parent();

                                                                var $inputUnidade = $divPanelBody.find("input:eq(0)");
                                                                var $inputQuant   = $divPanelBody.find("input:eq(1)");
                                                                var $inputPeriodo = $divPanelBody.find("input:eq(2)");
                                                                //var $inputArea    = $divPanelBody.find("input:eq(3)");

                                                                $inputUnidade.val(data.unidade);
                                                                $inputQuant.val(data.quant_pessoa);
                                                                $inputPeriodo.val(data.periodo == 1 ? "Inderterminado" : "Determinado");
                                                                //$inputArea.val(data.quant_pessoa);

                                                             });
                                                         '
                                                 ]]);
                                      ?>
                                    </div>

                                    <div class="col-sm-5">
                                        <?= $form->field($modelItens, "[{$i}]itemcusto_unidade")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-1">
                                        <?= $form->field($modelItens, "[{$i}]itemcusto_quantidade")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelItens, "[{$i}]itemcusto_tipocontrato")->textInput(['readonly'=> true]) ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelItens, "[{$i}]itemcusto_area")->textInput(['readonly'=> true]) ?>
                                    </div>
                                  </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <?= $form->field($modelItens, "[{$i}]itemcusto_chsemanal")->textInput() ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
<?php

$js = '
jQuery(".dynamicform_pedidocusto").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_pedidocusto .panel-title-pedidocusto").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_pedidocusto").on("afterDelete", function(e) {
    jQuery(".dynamicform_pedidocusto .panel-title-pedidocusto").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>