<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>
<div class="curriculos-admin-pre-selecionados" style="text-align: center;">

    <?php $form = ActiveForm::begin(); ?>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                <?php
                    $data_contratacao = ArrayHelper::map($processo, 'numeroEdital', 'numeroEdital');
                    echo $form->field($model, 'edital')->widget(Select2::classname(), [
                            'data' =>  $data_contratacao,
                            'hideSearch' => true,
                            'options' => ['placeholder' => 'Selecione o Edital...'],
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