<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;
use faryshta\widgets\JqueryTagsInput;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criar-etapas-processo-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <?php
                    $data_contratacao = ArrayHelper::map($processo, 'numeroEdital', 'numeroEdital');
                    echo $form->field($model, 'edital')->widget(Select2::classname(), [
                            'data' =>  $data_contratacao,
                            'options' => ['id'=>'edital-id', 'placeholder' => 'Selecione o Documento de Abertura...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
            </div>
            <div class="col-md-6">
                <?php
                   $data_contratacoes = ArrayHelper::map($contratacoes, 'id', 'id');
                   echo $form->field($model, 'contratacao_id')->widget(Select2::classname(), [
                           'data' =>  $data_contratacoes,
                           'options' => ['placeholder' => 'Selecione a Solicitação...']
                       ]);
                ?>
            </div>
        </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
  </div>

    <?php ActiveForm::end(); ?>

</div>
