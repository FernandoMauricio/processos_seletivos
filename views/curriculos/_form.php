<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cv_numeroEdital')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cv_cargo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cv_nome')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cv_datanascimento')->textInput() ?>

    <?= $form->field($model, 'cv_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cv_telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cv_resumocv')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cv_data')->textInput() ?>

    <?= $form->field($model, 'cv_email2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cv_telefone2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
