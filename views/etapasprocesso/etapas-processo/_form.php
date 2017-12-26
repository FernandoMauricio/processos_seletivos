<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="etapas-processo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>   


    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Formulário de Cadastro das Etapas do Processo</h3>
        </div>
        <table class="table table-condensed table-hover">
          <thead>
            <tr class="info"><th colspan="12">SEÇÃO 1: Informações</th></tr>
          </thead>
        </table>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-2"><?= $form->field($model, 'processoSeletivo')->textInput(['value' => $model->processo->numeroEdital,'readonly' => true]) ?></div>
                
                <div class="col-md-10"><?= $form->field($model, 'pedidocusto_id')->textInput(['value' => $model->pedidocusto->custo_id .' - ' . $model->pedidocusto->custo_assunto,'readonly' => true]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-4"><?= $form->field($model, 'etapa_cargo')->textInput(['readonly' => true]) ?></div>
                   
                <div class="col-md-4"><?= $form->field($model, 'etapa_atualizadopor')->textInput(['readonly' => true]) ?></div>
                    
                <div class="col-md-4"><?= $form->field($model, 'etapa_dataatualizacao')->textInput(['readonly' => true]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-3"><?= $form->field($model, 'etapa_datarealizacao')->textInput(['maxlength' => true]) ?></div>
                    
                <div class="col-md-3">
                    <?php
                        $data_unidades = ArrayHelper::map($unidades, 'uni_nomeabreviado', 'uni_nomeabreviado');
                        echo $form->field($model, 'etapa_local')->widget(Select2::classname(), [
                                'data' =>  $data_unidades,
                                'options' => ['placeholder' => 'Selecione o Local...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                </div>
                    
                <div class="col-md-3"><?= $form->field($model, 'etapa_cidade')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
                    
                <div class="col-md-3"><?= $form->field($model, 'etapa_estado')->textInput(['value' => 'AM', 'maxlength' => true, 'readonly' => true]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <?php 
                        $options = \yii\helpers\ArrayHelper::map($selecionadores, 'usu_nomeusuario', 'usu_nomeusuario');
                            echo $form->field($model, 'etapa_selecionadores')->widget(Select2::classname(), [
                                'data' => $options,
                                'options' => ['placeholder' => 'Informe os Selecionadores...', 'multiple'=>true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);  
                    ?>
                </div>
                <div class="col-md-3">
                    <?php
                        echo $form->field($model, 'etapa_situacao')->widget(Select2::classname(), [
                                'data' =>  ['Em Processo' => 'Em Processo', 'Em Homologação' => 'Em Homologação', 'Encerrado' => 'Encerrado','Encerrado sem Classificados' => 'Encerrado sem Classificados'],
                                'options' => ['placeholder' => 'Situação...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"><?= $form->field($model, 'etapa_observacao')->textarea(['maxlength' => true, 'rows' => 3]) ?></div>
            </div>

        </div>

        <table class="table table-condensed table-hover">
          <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Candidatos Selecionados</th></tr>
          </thead>
        </table>

        <?= $this->render('_form-itens-etapas', [
            'form' => $form,
            'model' => $model,
            'itens' => $itens,
        ]) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
