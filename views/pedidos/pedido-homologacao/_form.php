<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use faryshta\widgets\JqueryTagsInput;
use app\models\contratacao\Areas;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-homologacao-form">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<div class="panel panel-primary">
<div class="panel-heading">
  <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span>  Cadastrar Pedido de Homologação</h3>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-1"><?= $form->field($model, 'contratacao_id')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-6"><?= $form->field($model, 'homolog_unidade')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-3">
            <?= $form->field($model, 'homolog_data')->widget(DateControl::classname(), [
                            'type'=>DateControl::FORMAT_DATE,
                            'ajaxConversion'=>true,
                            'widgetOptions' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]);
            ?>
        </div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_tipo')->textInput(['value' => $model->homolog_tipo == 0 ? 'Determinado' : 'Inderterminado','maxlength' => true, 'readonly' => true]) ?></div>

    </div>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'homolog_cargo')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_salario')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_encargos')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>

        <div class="col-md-2"><?= $form->field($model, 'homolog_total')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'homolog_motivo')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'homolog_sintese')->textarea(['rows' => 6]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-12">
                    <?= $form->field($model, 'homolog_fases')->widget(JqueryTagsInput::classname(), [
                               'clientOptions' => [
                               'defaultText' => '',
                               'width' => '100%',
                               'height' => '100%',
                               'interactive' => true,
                              ],
                    ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'homolog_validade')->textInput() ?></div>
    </div> 

        <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">Candidatos Aprovados</th></tr>
              <tr>
                <th>Classificação</th>
                <th>Candidatos</th>
                <th>Nível</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php foreach ($modelsItens as $i => $modelItens): ?>
                  <td><?= $modelItens->pedhomolog_classificacao; ?></td>
                  <td><span class="text-uppercase"><?= $modelItens->pedhomolog_candidato; ?></span></td>
                  <td><?php 
                            $areas = Areas::find()->where(['status' => 1])->orderBy('descricao')->all();
                            $options = \yii\helpers\ArrayHelper::map($areas, 'descricao', 'descricao');
                                echo $form->field($modelItens, "[{$i}]pedhomolog_nivel")->widget(Select2::classname(), [
                                    'data' => $options,
                                    'options' => ['placeholder' => 'Selecione o Nível...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label(false);  
                      ?>
            </tr>
              <?php endforeach; ?>
        </table>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
