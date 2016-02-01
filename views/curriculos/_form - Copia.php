<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class='container'>
        

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


    <?= $form->field($model, 'nome')->textInput(['maxlength' => true,'placeholder' => 'Nome completo...']) ?>

    <?php

      echo  $form->field($model, "datanascimento")->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATETIME,
        'displayFormat' => 'dd/MM/yyyy',
        'autoWidget' => false,
        'widgetClass' => 'yii\widgets\MaskedInput',
        'options' => [
           'mask' => '99/99/9999',
           'options' => ['class'=>'form-control', 'placeholder' => 'Data nascimento...'],
         ]
    ]); 

    ?>

    <?php
            echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'cpf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu CPF...']],
                    'sexo'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[true=>'Masculino', false=>'Feminino'], 'options'=>['inline'=>true]],
                            ],
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

    <?php $form->field($model, 'telefone')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>

    <?php $form->field($model, 'telefoneAlt')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>

   
                        </div>
                        <div class="tab-pane" id="tab2">
                          2
                        </div>
                        <div class="tab-pane" id="tab3">
                            3
                        </div>
                        <div class="tab-pane" id="tab4">
                            4
                        </div>
                        <div class="tab-pane" id="tab5">
                            5
                        </div>
                        <div class="tab-pane" id="tab6">
                            6
                        </div>
                        <div class="tab-pane" id="tab7">
                            7
                        </div>
                        <ul class="pager wizard">
                            <li class="previous first" style="display:none;"><a href="#">First</a></li>
                            <li class="previous"><a href="#">Previous</a></li>
                            <li class="next last" style="display:none;"><a href="#">Last</a></li>
                            <li class="next"><a href="#">Next</a></li>
                        </ul>
                    </div>  
                </div>
                
<h3>HTML</h3>



 <?php ActiveForm::end(); ?>