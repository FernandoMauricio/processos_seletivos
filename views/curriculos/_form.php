<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use \yii\widgets\MaskedInput;


/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-form">


    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>

        <?= $form->field($model, 'edital')->textInput(['readonly'=>true]) ?>

        <?php
                    $data_cargos = ArrayHelper::map($cargos, 'descricao', 'descricao');
                    echo $form->field($model, 'cargo')->widget(Select2::classname(), [
                        'data' => array_merge(["" => ""], $data_cargos),
                        'options' => ['placeholder' => 'Selecione o cargo...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
         ?>

<?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

 

<?php
echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>[       // 2 column layout
        'cpf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu CPF...']],
        'datanascimento'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker', 'hint'=>'Formato (dd/mm/yyyy)'],
        'sexo'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[true=>'Masculino', false=>'Feminino'], 'options'=>['inline'=>true]],
    ]
]);
?>



<?php
echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>4,
    'attributes'=>[       // 2 column layout
        'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail...']],
        'emailAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail alternativo...']],
        'telefone'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone...']],
        'telefoneAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone alternativo...']],
    ]
]);
?>
    
    <?php $form->field($model, 'cpf')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999.999.999-99']) ?>

    <?php $form->field($model, 'telefone')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>

    <?php $form->field($model, 'telefoneAlt')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar Currículo' : 'Enviar Currículo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
