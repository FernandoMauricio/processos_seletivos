<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;

?>
<div class="curriculos-admin-pre-selecionados" style="text-align: center;">

    <?php $form = ActiveForm::begin(); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                <?php
                    $data_contratacao = ArrayHelper::map($processo, 'id', 'numeroEdital');
                    echo $form->field($model, 'edital')->widget(Select2::classname(), [
                            'data' =>  $data_contratacao,
                            'options' => ['id'=>'edital-id', 'placeholder' => 'Selecione o Documento de Abertura...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
				</div>

                <div class="col-md-5">
                <?php
                    echo $form->field($model, 'cargo')->widget(DepDrop::classname(), [
                                    'type'=>DepDrop::TYPE_SELECT2,
                                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                                    'pluginOptions'=>[
                                        'depends'=>['edital-id'],
                                        'placeholder'=>'Selecione o Cargo...',
                                        'initialize' => true,
                                        'url'=>Url::to(['/curriculos/curriculos-admin/cargos-processo'])
                                    ]
                                ]);

                ?>
                </div>

                <div class="col-md-5">
                <?php
                    $data_unidades = ArrayHelper::map($unidades, 'uni_codunidade', 'uni_nomeabreviado');
                    echo $form->field($model, 'unidade_aprovador')->widget(Select2::classname(), [
                            'data' =>  $data_unidades,
                            'options' => ['placeholder' => 'Selecione a Unidade...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                ?>
                </div>

			</div>
		</div>

        <?= Html::a('Enviar!', ['pre-selecionados'], [
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post'
            ],
        ]) ?>

    <?php ActiveForm::end(); ?>

</div>