<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;
use \kartik\form\ActiveForm;
use app\models\processoseletivo\Situacao;
use app\models\processoseletivo\Modalidade;
use app\models\processoseletivo\Status;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\ProcessoSeletivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="processo-seletivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numeroEdital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objetivo')->textarea(['rows' => 6]) ?>

    <?php

            echo $form->field($model, 'data')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);

    ?>

        <?php

            echo $form->field($model, 'data_encer')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);
    ?>

    <?php

            $rows = Modalidade::find()->all();
            $data_modalidade = ArrayHelper::map($rows, 'id', 'descricao');
            echo $form->field($model, 'modalidade_id')->radiolist($data_modalidade);
 
    ?>


    <?php

            $rows = Situacao::find()->all();
            $data_situacao = ArrayHelper::map($rows, 'id', 'descricao');
            echo $form->field($model, 'situacao_id')->radiolist($data_situacao);
 
    ?>



    <?= $form->field($model, 'status_id')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?>


    <?php 
    $options = \yii\helpers\ArrayHelper::map($cargos, 'idcargo', 'descricao');
                    echo $form->field($model, 'permissions')->widget(Select2::classname(), [
                        'data' => $options,
                        'options' => ['placeholder' => 'Selecione os Cargos...', 'multiple'=>true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);  

    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Processo Seletivo' : 'Atualizar Processo Seletivo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
