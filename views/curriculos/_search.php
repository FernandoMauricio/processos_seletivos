<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cv_id') ?>

    <?= $form->field($model, 'cv_numeroEdital') ?>

    <?= $form->field($model, 'cv_cargo') ?>

    <?= $form->field($model, 'cv_nome') ?>

    <?= $form->field($model, 'cv_datanascimento') ?>

    <?php // echo $form->field($model, 'cv_email') ?>

    <?php // echo $form->field($model, 'cv_telefone') ?>

    <?php // echo $form->field($model, 'cv_resumocv') ?>

    <?php // echo $form->field($model, 'cv_data') ?>

    <?php // echo $form->field($model, 'cv_email2') ?>

    <?php // echo $form->field($model, 'cv_telefone2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
