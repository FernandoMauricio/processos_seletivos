<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratacaoJustificativas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratacao-justificativas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_contratacao')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'usuario')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Inserir Justificativa' : 'Atualizar Justificativa', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
