<?php

use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\models\Recrutamento;

/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'colaborador')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'unidade')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'quant_pessoa')->textInput() ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'substituicao')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'nome_substituicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodo')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'tempo_periodo')->textInput() ?>

    <?= $form->field($model, 'aumento_quadro')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'obs_aumento')->textarea(['rows' => 3]) ?>

        <?php
        echo $form->field($model, 'data_ingresso')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Insira a data ...'],
            'pluginOptions' => [
                'autoclose'=>true
            ]
        ]);

        ?>

    <?= $form->field($model, 'deficiencia')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'obs_deficiencia')->textarea(['rows' => 3]) ?>


    <center><div>--------------------------------------------------<strong style="color: #E61238"> IDENTIFICAÇÃO DO PERFIL </strong>--------------------------------------------------</center></div>

    <?php echo '<label class="control-label">--- Ensino Fundamental:</label><br>'; ?>

    <?= $form->field($model, 'fundamental_comp')->checkbox() ?>

    <?= $form->field($model, 'fundamental_inc')->checkbox() ?>



    <?php echo '<label class="control-label">--- Ensino Médio:</label><br>'; ?>

    <?= $form->field($model, 'medio_comp')->checkbox() ?>

    <?= $form->field($model, 'medio_inc')->checkbox() ?>



    <?php echo '<label class="control-label">--- Ensino Técnico:</label><br>'; ?>

    <?= $form->field($model, 'tecnico_comp')->checkbox() ?>

    <?= $form->field($model, 'tecnico_inc')->checkbox() ?>

    <?= $form->field($model, 'tecnico_area')->textInput(['maxlength' => true]) ?>



    <?php echo '<label class="control-label">--- Ensino Superior:</label><br>'; ?>

    <?= $form->field($model, 'superior_comp')->checkbox() ?>

    <?= $form->field($model, 'superior_inc')->checkbox() ?>

    <?= $form->field($model, 'superior_area')->textInput(['maxlength' => true]) ?>



    <?php echo '<label class="control-label">--- Pós-Graduação:</label><br>'; ?>

    <?= $form->field($model, 'pos_comp')->checkbox() ?>

    <?= $form->field($model, 'pos_inc')->checkbox() ?>

    <?= $form->field($model, 'pos_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dominio_atividade')->textarea(['rows' => 3]) ?>


    <?php echo '<label class="control-label">Domínio de informática:</label><br>'; ?>

    <?= $form->field($model, 'windows')->checkbox() ?>

    <?= $form->field($model, 'word')->checkbox() ?>

    <?= $form->field($model, 'excel')->checkbox() ?>

    <?= $form->field($model, 'internet')->checkbox() ?>

    <?= $form->field($model, 'experiencia')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'experiencia_tempo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experiencia_atividade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jornada_horas')->radioList(array('0'=>'Não','1'=>'Sim'), ['inline'=>true]); ?>

    <?= $form->field($model, 'jornada_obs')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'principais_atividades')->textarea(['rows' => 3]) ?>

    <?php

                $rows = Recrutamento::find()->all();
                $data = ArrayHelper::map($rows, 'idrecrutamento', 'descricao');
                echo $form->field($model, 'recrutamento_id')->radiolist($data, ['inline'=>true]);

    ?>


    <?php echo '<label class="control-label">Métodos de seleção indicados, considerando um ou mais dos seguintes processos:</label><br>'; ?>

    <?= $form->field($model, 'selec_dinamica')->checkbox() ?>

    <?= $form->field($model, 'selec_prova')->checkbox() ?>

    <?= $form->field($model, 'selec_entrevista')->checkbox() ?>

    <?= $form->field($model, 'selec_teste')->checkbox() ?>

    <?= $form->field($model, 'nomesituacao')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'situacao_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar Solicitação' : 'Atualizar Solicitação', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
