<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosFormacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-formacao-form">

    <?php $form = ActiveForm::begin(); ?>

        <?php
            echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>4,
                'attributes'=>[       // 2 column layout
                    'fundamental_inc'=>['type'=>Form::INPUT_CHECKBOX],
                    'superior_area'=>['type'=>Form::INPUT_TEXT],
                    'superior_comp'=>['type'=>Form::INPUT_RADIO,],
                    'superior_inc'=>['type'=>Form::INPUT_RADIO,],
                            ],
            ]);
    ?>

    <?= $form->field($model, 'fundamental_inc')->textInput() ?>

    <?= $form->field($model, 'fundamental_comp')->textInput() ?>

    <?= $form->field($model, 'medio_inc')->textInput() ?>

    <?= $form->field($model, 'medio_comp')->textInput() ?>

    <?= $form->field($model, 'superior_inc')->textInput() ?>

    <?= $form->field($model, 'superior_comp')->textInput() ?>

    <?= $form->field($model, 'superior_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos')->textInput() ?>

    <?= $form->field($model, 'pos_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mestrado')->textInput() ?>

    <?= $form->field($model, 'mestrado_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doutorado')->textInput() ?>

    <?= $form->field($model, 'doutorado_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estuda_atualmente')->textInput() ?>

    <?= $form->field($model, 'estuda_curso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estuda_turno')->textInput() ?>

    <?= $form->field($model, 'curriculos_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
