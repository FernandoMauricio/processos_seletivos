<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CurriculosEndereco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-endereco-form">

    <?php $form = ActiveForm::begin(); ?>

<?php echo $form->errorSummary($model); ?>


<div class="row">
    <div class="col-sm-12">

        <?= $form->field($model, 'cep')->widget('yiibr\correios\CepInput', [
        'action' => ['addressSearch'],
        'fields' => [
            'location' => 'curriculosendereco-endereco',
            'district' => 'curriculosendereco-bairro',
            'city' => 'curriculosendereco-cidade',
            'state' => 'curriculosendereco-estado',
        ],
    ]) ?>

    </div>

    <div class="col-sm-6">
    <?= $form->field($model, 'endereco')->textInput(['readonly'=>true]) ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'numero_end')->textInput(['placeholder'=>'Número']) ?>
    </div>

    <div class="col-sm-4">
    <?= $form->field($model, 'bairro')->textInput(['readonly'=>true]) ?>
    </div>

 </div>


<div class="row">
    <div class="col-sm-6">
    <?= $form->field($model, 'complemento')->textInput(['placeholder'=>'Complemento']) ?>
    </div>

    <div class="col-sm-4">
    <?= $form->field($model, 'cidade')->textInput(['readonly'=>true]) ?>
    </div>

    <div class="col-sm-2">
    <?= $form->field($model, 'estado')->textInput(['readonly'=>true]) ?>
    </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Próxima Etapa' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

