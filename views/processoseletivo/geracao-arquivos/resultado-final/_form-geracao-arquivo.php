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
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"><?= $form->field($model, 'processoSeletivo')->textInput(['value' => $model->processo->numeroEdital,'readonly' => true]) ?></div>

                <div class="col-md-3"><?= $form->field($model, 'cargoLabel')->textInput(['value' => $model->etapasprocesso->etapa_cargo,'readonly' => true]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-6"><?= $form->field($model, 'gerarq_titulo')->textInput(['maxlength' => true]) ?></div>
            </div>
    </div>

</div>
