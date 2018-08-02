<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\Aprovacoes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aprovacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aprov_descricao')->textInput(['maxlength' => true, 'placeholder' => 'Nome do Aprovador...']) ?>

    <?= $form->field($model, 'aprov_cargo')->textInput(['maxlength' => true, 'placeholder' => 'Cargo...']) ?>

    <?= $form->field($model, 'aprov_observacao')->textInput(['maxlength' => true, 'placeholder' => 'Ordem de serviço, se existir...']) ?>

    <?php
            echo $form->field($model, 'aprov_area')->widget(Select2::classname(), [
                'data' =>  ['GGP' => 'GGP', 'DAD' => 'DAD',  'DIRETORIA REGIONAL' => 'DIRETORIA REGIONAL',  'PRESIDÊNCIA' => 'PRESIDÊNCIA' ],
                'options' => ['placeholder' => 'Selecione a área de aprovação...'],
                'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        ?>

    <?= $form->field($model, 'aprov_status')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
