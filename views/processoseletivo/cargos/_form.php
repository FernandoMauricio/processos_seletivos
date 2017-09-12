<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\Cargos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cargos-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="panel-body">
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>

        <div class="col-md-4">
            <?php 
                $options = \yii\helpers\ArrayHelper::map($areas, 'idarea', 'descricao');
                    echo $form->field($model, 'areasLabel')->widget(Select2::classname(), [
                        'data' => $options,
                        'options' => ['placeholder' => 'Selecione as Áreas...', 'multiple'=>true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);  
            ?>

       </div>

        <div class="col-md-2"><?= $form->field($model, 'ch_semana')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'salario_valorhora')->textInput() ?></div>

        <div class="col-md-2"><?= $form->field($model, 'salario')->textInput() ?></div>

        <div class="col-md-2"><?= $form->field($model, 'status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?></div>

        <div class="col-md-6"><?= $form->field($model, 'calculos')->radioList(['1' => 'Sim', '0' => 'Não']) ?></div>
    </div>

</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Cargo' : 'Atualizar Cargo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
