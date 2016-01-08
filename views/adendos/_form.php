<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Adendos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adendos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'adendos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'processo_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
