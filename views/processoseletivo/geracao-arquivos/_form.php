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
use faryshta\widgets\JqueryTagsInput;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geracao-arquivos-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Formulário de Cadastrado para Geração de Arquivo</h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"><?= $form->field($model, 'processoSeletivo')->textInput(['value' => $model->processo->numeroEdital,'readonly' => true]) ?></div>

                <div class="col-md-3"><?= $form->field($model, 'cargoLabel')->textInput(['value' => $model->etapasprocesso->etapa_cargo,'readonly' => true]) ?></div>

                <div class="col-md-6"><?= $form->field($model, 'gerarq_titulo')->textInput(['maxlength' => true]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-2">
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
            
                <div class="col-md-2"><?= $form->field($model, 'gerarq_horarealizacao')->widget(TimePicker::classname(), [ 'pluginOptions' => ['showSeconds' => false,'showMeridian' => false]]); ?></div>

                <div class="col-md-4"><?= $form->field($model, 'gerarq_local')->textInput(['maxlength' => true]) ?></div>

                <div class="col-md-4"><?= $form->field($model, 'gerarq_endereco')->textInput(['maxlength' => true]) ?></div>
            </div>
 
            <div class="row">
                <div class="col-md-9"><?= $form->field($model, 'gerarq_tempo')->textInput(['maxlength' => true]) ?></div>

                <div class="col-md-3">
                    <?php 
                            echo $form->field($model, 'gerarq_emailconfirmacao')->widget(Select2::classname(), [
                                'data' =>  [
                                    'israel.galvao@am.senac.br' => 'israel.galvao@am.senac.br', 
                                    'keila.neves@am.senac.br' => 'keila.neves@am.senac.br'
                                ],
                                'options' => ['placeholder' => 'E-mail de confirmação...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);  
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php 
                            echo $form->field($model, 'gerarq_documentos')->widget(Select2::classname(), [
                                'data' =>  [
                                    'Identidade ou Carteira de Trabalho (original)' => 'Identidade ou Carteira de Trabalho (original)', 
                                    'Currículo Atualizado' => 'Currículo Atualizado'
                                ],
                                'options' => ['placeholder' => 'Informe os arquivos a serem apresentados...', 'multiple'=>true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);  
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'gerarq_fase')->widget(JqueryTagsInput::classname(), [
                           'clientOptions' => [
                           'defaultText' => '',
                           'width' => '100%',
                           'height' => '100%',
                           'interactive' => true,
                          ],
                ]) ?>
                </div>
            </div>



    <?= $form->field($model, 'gerarq_responsavel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>

</div>
