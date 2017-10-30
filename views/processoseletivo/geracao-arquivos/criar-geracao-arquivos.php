<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use yii\helpers\Url;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geracao-arquivos-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <?php
                    $data_contratacao = ArrayHelper::map($processo, 'id', 'numeroEdital');
                    echo $form->field($model, 'processo_id')->widget(Select2::classname(), [
                            'data' =>  $data_contratacao,
                            'hideSearch' => true,
                            'options' => ['id'=>'edital-id', 'placeholder' => 'Selecione o Documento de Abertura...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                    echo $form->field($model, 'etapasprocesso_id')->widget(DepDrop::classname(), [
                            'type'=>DepDrop::TYPE_SELECT2,
                            'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                            'pluginOptions'=>[
                                'depends'=>['edital-id'],
                                'placeholder'=>'Selecione o Cargo da Etapa do Processo...',
                                'initialize' => true,
                                'url'=>Url::to(['/processoseletivo/geracao-arquivos/etapas-processo'])
                            ]
                        ]);
                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'gerarq_datarealizacao')->widget(DateControl::classname(), [
                            'type'=>DateControl::FORMAT_DATE,
                            'ajaxConversion'=>true,
                            'widgetOptions' => [
                                'removeButton' => false,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                ],
                            ]
                        ]);
                    ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'gerarq_horarealizacao')->widget(TimePicker::classname(), [ 'pluginOptions' => ['showSeconds' => false,'showMeridian' => false]]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?php
                    echo $form->field($model, 'gerarq_perfil')->widget(Select2::classname(), [
                            'data' =>  ['0' => 'Administrativo', '1' => 'Docente'],
                            'hideSearch' => true,
                            'options' => ['placeholder' => 'Selecione o Perfil...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
            </div>

            <div class="col-md-3">
                <?php
                    echo $form->field($model, 'gerarq_tipo')->widget(Select2::classname(), [
                            'data' =>  ['0' => 'Resultado das Etapas', '1' => 'Resultado Final'],
                            'hideSearch' => true,
                            'options' => ['placeholder' => 'Selecione o Perfil...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>