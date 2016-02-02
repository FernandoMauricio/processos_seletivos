<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosFormacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-formacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fundamental_comp') ?>

    <?= $form->field($model, 'medio_comp') ?>

    <?= $form->field($model, 'superior_comp') ?>

    <?= $form->field($model, 'superior_area') ?>

    <?php // echo $form->field($model, 'pos') ?>

    <?php // echo $form->field($model, 'pos_area') ?>

    <?php // echo $form->field($model, 'mestrado') ?>

    <?php // echo $form->field($model, 'mestrado_area') ?>

    <?php // echo $form->field($model, 'doutorado') ?>

    <?php // echo $form->field($model, 'doutorado_area') ?>

    <?php // echo $form->field($model, 'estuda_atualmente') ?>

    <?php // echo $form->field($model, 'estuda_curso') ?>

    <?php // echo $form->field($model, 'estuda_turno_mat') ?>

    <?php // echo $form->field($model, 'estuda_turno_vesp') ?>

    <?php // echo $form->field($model, 'estuda_turno_not') ?>

    <?php // echo $form->field($model, 'curriculos_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
