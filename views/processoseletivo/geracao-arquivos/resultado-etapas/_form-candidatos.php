<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_candidatos', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items-candidatos', // required: css class selector
    'widgetItem' => '.item-candidatos', // required: css class
    'limit' => 999, // the maximum times, an element can be cloned (default 999)
    'min' => 0, // 0 or 1 (default 1)
    'insertButton' => '.add-item-candidatos', // css class
    'deleteButton' => '.remove-item-candidatos', // css class
    'model' => $modelsItens[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'id',
        'gerarqitens_candidato',
        'gerarqitens_horario',
        'gerarqitens_tema',
    ],
]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list-alt"></i> Listagem de Candidatos
                <button type="button" class="pull-right add-item-candidatos btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Adicionar Item</button>
                <div class="clearfix"></div>
            </div>
                <div class="panel-body container-items-candidatos"><!-- widgetContainer -->
                    <?php foreach ($modelsItens as $i => $modelItens): ?>
                        <div class="item-candidatos panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-candidatos">Item: <?= ($i + 1) ?></span>
                                <button type="button" class="pull-right remove-item-candidatos btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <button type="button" class="pull-right add-item-candidatos btn btn-success btn-xs" style="margin-right: 12px;"><i class="glyphicon glyphicon-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$modelItens->isNewRecord) {
                                        echo Html::activeHiddenInput($modelItens, "[{$i}]id");
                                    }
                                ?>
                                    <div class="col-sm-4"><?= $form->field($modelItens, "[{$i}]gerarqitens_candidato")->textInput(['readonly' => true, 'style' => 'text-transform: uppercase']) ?></div>

                                    <?= $model->gerarq_perfil == 1 ? '<div class="col-sm-2">'.$form->field($modelItens, "[{$i}]gerarqitens_horario")->widget(TimePicker::classname(), [ 'pluginOptions' => ['showSeconds' => false,'showMeridian' => false]]) .'</div>' : ''; ?>

                                    <?= $model->gerarq_perfil == 1 ? '<div class="col-sm-6">'.$form->field($modelItens, "[{$i}]gerarqitens_tema")->textInput() .'</div>' : ''; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
<?php

$js = '
jQuery(".dynamicform_candidatos").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_candidatos .panel-title-candidatos").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

jQuery(".dynamicform_candidatos").on("afterDelete", function(e) {
    jQuery(".dynamicform_candidatos .panel-title-candidatos").each(function(i) {
        jQuery(this).html("Item: " + (i + 1))
    });
});

';

$this->registerJs($js);

?>