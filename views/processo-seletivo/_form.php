<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Situacao;
use app\models\Modalidade;
use app\models\Status;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoSeletivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="processo-seletivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>


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

    <?= $form->field($model, 'numeroEdital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objetivo')->textarea(['rows' => 6]) ?>


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



    <?php

            $rows = Status::find()->all();
            $data_situacao = ArrayHelper::map($rows, 'status', 'descricao');
            echo $form->field($model, 'status')->radiolist($data_situacao);
 
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Processo Seletivo' : 'Atualizar Processo Seletivo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
