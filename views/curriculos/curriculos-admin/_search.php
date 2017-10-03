<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="panel-body">
    <div class="row">
        <div class="col-md-2"><?php  echo $form->field($model, 'bairroLabel') ?></div>
        <div class="col-md-2"><?php  echo $form->field($model, 'cidadeLabel') ?></div>
        <div class="col-md-2">
            <?php  echo $form->field($model, 'tecnicoLabel')->widget(Select2::classname(), [
                                'data' =>  ['1' => 'Completo', '0' => 'Incompleto'],
                                'options' => ['placeholder' => 'Completo/Incompleto...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ]);
            ?>
        </div>
        <div class="col-md-2">
            <?php  echo $form->field($model, 'graduacaoLabel')->widget(Select2::classname(), [
                                'data' =>  ['1' => 'Completo', '0' => 'Incompleto'],
                                'options' => ['placeholder' => 'Completo/Incompleto...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ]);
            ?>
        </div>
        <div class="col-md-2">
            <?php  echo $form->field($model, 'posLabel')->widget(Select2::classname(), [
                                'data' =>  ['1' => 'Completo', '0' => 'Incompleto'],
                                'options' => ['placeholder' => 'Completo/Incompleto...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ]);
            ?>
        </div>
        <div class="col-md-2">
            <?php  echo $form->field($model, 'mestradoLabel')->widget(Select2::classname(), [
                                'data' =>  ['1' => 'Completo', '0' => 'Incompleto'],
                                'options' => ['placeholder' => 'Completo/Incompleto...'],
                                'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><?php  echo $form->field($model, 'idadeInicial') ?></div>
        <div class="col-md-2"><?php  echo $form->field($model, 'idadeFinal') ?></div>
    </div>

</div>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
