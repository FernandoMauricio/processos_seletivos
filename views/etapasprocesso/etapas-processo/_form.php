<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="etapas-processo-form">

    <?php $form = ActiveForm::begin(); ?>


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
                <div class="col-md-3">
                    <?= $form->field($model, 'processoSeletivo')->textInput(['value' => $model->processo->numeroEdital,'readonly' => true]) ?>
                </div>
                <div class="col-md-7">
                    <?= $form->field($model, 'etapa_cargo')->textInput(['readonly' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'etapa_data')->textInput(['readonly' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?php
                        echo $form->field($model, 'etapa_situacao')->widget(Select2::classname(), [
                                'data' =>  ['Aberto' => 'Aberto', 'Em Processo' => 'Em Processo', 'Encerrado' => 'Encerrado'],
                                'options' => ['placeholder' => 'Situação...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                    ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'etapa_atualizadopor')->textInput(['readonly' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'etapa_dataatualizacao')->textInput(['readonly' => true]) ?>
                </div>
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
