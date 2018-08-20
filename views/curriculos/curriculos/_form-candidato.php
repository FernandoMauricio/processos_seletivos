<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

?>
                    
    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'edital')->textInput(['readonly'=>true]) ?></div>
            <?php
                echo Form::widget([
                    'model'=>$model,
                    'form'=>$form,
                    'columns'=>6,
                    'attributes'=>[  
                        'nome'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome completo...'],'columnOptions'=>['colspan'=>3]],
                        'deficiencia'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[true=>'Sim', false=>'Não'],'options'=>['inline'=>true]],
                        'deficiencia_cid'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe o CID...'], 'columnOptions'=>['colspan'=>2]],     
                    ],
                ]);
            ?>
    </div>

    <div class="row">
        <div class="col-md-4">
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
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'datanascimento')->widget(DateControl::classname(), [
                    'type'=>DateControl::FORMAT_DATE,
                    'ajaxConversion'=>false,
                    'widgetOptions' => [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]
                ]);
            ?>
        </div>

        <?php //echo $form->field($model, 'curriculo_lattes')->textInput(['maxlength' => true]) ?>


        <div class="col-md-4">
            <?php
                echo $form->field($model, 'estado_civil')->widget(Select2::classname(), [
                    'data' => ['Solteiro(a)' => 'Solteiro(a)', 'Casado(a)' => 'Casado(a)', 'Separado(a)' => 'Separado(a)', 'Divorciado(a)' => 'Divorciado(a)', 'Viúvo(a)' => 'Viúvo(a)', 'União Estável ' => 'União Estável '],
                    'options' => ['placeholder' => 'Estado Civil...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
    </div>


        <?php
                echo Form::widget([
                    'model'=>$model,
                    'form'=>$form,
                    'columns'=>4,
                    'attributes'=>[
                        'cpf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu CPF...']],
                        'identidade'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu RG...']],
                        'orgao_exped'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe o orgão expedidor...']],
                        'sexo'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[true=>'Masculino', false=>'Feminino'], 'options'=>['inline'=>true]],
                                ],
                ]);
        ?>

        <?php
                echo Form::widget([
                    'model'=>$model,
                    'form'=>$form,
                    'columns'=>4,
                    'attributes'=>[
                        'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail...']],
                        'emailAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail alternativo...']],
                        'telefone'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone...']],
                        'telefoneAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone alternativo...']],
                    ]
                ]);
        ?>

        <?php
                echo Form::widget([
                    'model'=>$model,
                    'form'=>$form,
                    'columns'=>2,
                    'attributes'=>[
                        'profile_facebook'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu facebook...']],
                        'profile_linkedin'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu linkedin...']],
                    ]
                ]);
        ?>

        <?php $form->field($model, 'cpf')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999.999.999-99']) ?>

        <?php $form->field($model, 'telefone')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>

        <?php $form->field($model, 'telefoneAlt')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>
                    