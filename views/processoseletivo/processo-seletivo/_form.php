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

    <div class="panel-body">
        <div class="row">
            <div class="col-md-2"><?= $form->field($model, 'numeroEdital')->textInput(['maxlength' => true]) ?></div>

            <div class="col-md-10"><?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="row">
             <div class="col-md-12"><?= $form->field($model, 'objetivo')->textarea(['rows' => 6]) ?></div>
        </div> 
        
        <div class="row">
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?php
                        $rows = Modalidade::find()->all();
                        $data_modalidade = ArrayHelper::map($rows, 'id', 'descricao');
                        echo $form->field($model, 'modalidade_id')->radiolist($data_modalidade);
                ?>
            </div>
            <div class="col-md-4">
                <?php
                        $rows = Situacao::find()->all();
                        $data_situacao = ArrayHelper::map($rows, 'id', 'descricao');
                        echo $form->field($model, 'situacao_id')->radiolist($data_situacao);
                ?>
            </div>

            <div class="col-md-4"><?= $form->field($model, 'status_id')->radioList(['1' => 'Ativo', '0' => 'Inativo']) ?></div>
        </div>


        <div class="row">
            <div class="col-md-12">
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
            </div>
   </div>  

</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Processo Seletivo' : 'Atualizar Processo Seletivo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
