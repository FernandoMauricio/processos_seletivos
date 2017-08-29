<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criar-etapas-processo-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="panel-body">
    <div class="row">
        <div class="col-md-2">
            <?php
                $data_contratacao = ArrayHelper::map($processo, 'id', 'numeroEdital');
                echo $form->field($model, 'processo_id')->widget(Select2::classname(), [
                        'data' =>  $data_contratacao,
                        'hideSearch' => true,
                        'options' => ['id'=>'edital-id', 'placeholder' => 'Selecione o Edital...'],
                        'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]);
            ?>
        </div>
        <div class="col-md-5">
            <?php
                echo $form->field($model, 'etapa_cargo')->widget(DepDrop::classname(), [
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions'=>[
                            'depends'=>['edital-id'],
                            'placeholder'=>'Selecione o Cargo...',
                            'initialize' => true,
                            'url'=>Url::to(['/etapasprocesso/etapas-processo/cargos-etapas-processo'])
                        ]
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
