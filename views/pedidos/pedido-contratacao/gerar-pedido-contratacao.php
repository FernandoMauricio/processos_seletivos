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
          <div class="col-md-9"><?= $form->field($model, 'pedcontratacao_assunto')->textInput(['maxlength' => true]) ?></div>
          <div class="col-md-3">
              <?php
                  echo $form->field($model, 'pedcontratacao_tipo')->widget(Select2::classname(), [
                          'data' =>  ['0' => 'Normal', '1' => 'Especial'],
                          'hideSearch' => true,
                          'options' => ['placeholder' => 'Selecione o Tipo de Contratação...'],
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
    
  </div>

    <?php ActiveForm::end(); ?>

</div>
