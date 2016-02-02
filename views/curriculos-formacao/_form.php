<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosFormacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-formacao-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>


        <?= $form->field($model, 'fundamental_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?>

        <?= $form->field($model, 'medio_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?>

                        <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'superior_comp'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'superior_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a sua graduação...'],'columnOptions'=>['colspan'=>2]],
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'pos'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'pos_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de Pós-graduação...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'mestrado'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'mestrado_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de mestrado...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'doutorado'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'doutorado_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de Pós-graduação...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'estuda_atualmente'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Sim', 0=>'Não'], 'options'=>['inline'=>true]],
                                    'estuda_curso'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

        <?= $form->field($model, 'estuda_turno_mat')->checkbox() ?>
        
        <?= $form->field($model, 'estuda_turno_vesp')->checkbox() ?>
        
        <?= $form->field($model, 'estuda_turno_not')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
