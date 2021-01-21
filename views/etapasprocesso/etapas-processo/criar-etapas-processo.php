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
            <div class="col-md-3">
                <?php
                    $data_contratacao = ArrayHelper::map($processo, 'id', 'numeroEdital');
                    echo $form->field($model, 'processo_id')->widget(Select2::classname(), [
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
                    $data_pedidocusto = ArrayHelper::map($pedidoCusto, 'custo_id', 'custo_assunto');
                    echo $form->field($model, 'pedidocusto_id')->widget(Select2::classname(), [
                            'data' =>  $data_pedidocusto,
                            'options' => ['placeholder' => 'Selecione o Pedido de Custo...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                    echo $form->field($model, 'etapa_cidade')->widget(Select2::classname(), [
                            'data' =>  ['Manaus' => 'Manaus', 'Manacapuru' => 'Manacapuru', 'Itacoatiara' => 'Itacoatiara', 'Tefé' => 'Tefé','Rorainópolis' => 'Rorainópolis', 'Parintins' => 'Parintins', 'Coari' => 'Coari', 'Beruri' => 'Beruri'],
                            'options' => ['placeholder' => 'Selecione a cidade...', 'multiple' => true],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
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
            <div class="col-md-3">
                <?php
                    echo $form->field($model, 'etapa_perfil')->widget(Select2::classname(), [
                            'data' =>  ['0' => 'Administrativo', '1' => 'Docente/Motorista/Cozinha'],
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
