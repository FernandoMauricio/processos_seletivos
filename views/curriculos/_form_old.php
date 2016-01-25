<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-form">


    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'edital')->textInput(['readonly'=>true]) ?>

        <?php
                    $data_cargos = ArrayHelper::map($cargos, 'idcargo', 'descricao');
                    echo $form->field($model, 'cargo')->widget(Select2::classname(), [
                        'data' => array_merge(["" => ""], $data_cargos),
                        'options' => ['placeholder' => 'Selecione o cargo...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
         ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpf')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999.999.999-99']) ?>

    <?= $form->field($model, 'sexo')->radioList(array('0'=>'Masculino','1'=>'Feminino'), ['inline'=>true]); ?>

    <?php
    echo $form->field($model, 'datanascimento')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Insira a data de nascimento ...'],
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]);

    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailAlt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>

    <?= $form->field($model, 'telefoneAlt')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
