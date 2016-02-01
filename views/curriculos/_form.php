<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\datecontrol\DateControl;

 
/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-endereco-form">

<?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
        
        <?php echo $form->errorSummary($model); ?>

        <div class="span12">
            <section id="wizard">
              <div class="page-header">
                <h1>Cadastros de Curriculos</h1>
              </div>
    
                <div id="rootwizard" class="tabbable tabs-left">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">Candidato</a></li>
                        <li><a href="#tab2" data-toggle="tab">Endereço</a></li>
                        <li><a href="#tab3" data-toggle="tab">Formação Escolar</a></li>
                        <li><a href="#tab4" data-toggle="tab">Cursos Complementares</a></li>
                        <li><a href="#tab5" data-toggle="tab">Empregos Anteriroes</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">


                <!--            INFORMAÇÕES DO CANDIDATO                -->

                    <?= $form->field($model, 'edital')->textInput(['readonly'=>true]) ?>


                        <?php
                                    $data_cargos = ArrayHelper::map($cargos, 'descricao', 'descricao');
                                    echo $form->field($model, 'cargo')->widget(Select2::classname(), [
                                        'data' => array_merge(["" => ""], $data_cargos),
                                        'options' => ['placeholder' => 'Selecione o cargo...'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                         ?>


                    <?= $form->field($model, 'nome')->textInput(['maxlength' => true,'placeholder' => 'Nome completo...']) ?>

                    <?php

                      echo  $form->field($model, "datanascimento")->widget(DateControl::classname(), [
                        'type'=>DateControl::FORMAT_DATETIME,
                        'displayFormat' => 'dd/MM/yyyy',
                        'autoWidget' => false,
                        'widgetClass' => 'yii\widgets\MaskedInput',
                        'options' => [
                           'mask' => '99/99/9999',
                           'options' => ['class'=>'form-control', 'placeholder' => 'Data nascimento...'],
                         ]
                    ]); 

                    ?>

                    <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       // 2 column layout
                                    'cpf'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu CPF...']],
                                    'identidade'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu RG...']],
                                    'orgao_exped'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe o orgão expedidor...']],
                                    'sexo'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[true=>'Masculino', false=>'Feminino'], 'options'=>['inline'=>true]],
                                            ],
                            ]);
                    ?>

                    <?php
                            echo Form::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       // 2 column layout
                                    'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail...']],
                                    'emailAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu e-mail alternativo...']],
                                    'telefone'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone...']],
                                    'telefoneAlt'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Informe seu telefone alternativo...']],
                                ]
                            ]);
                    ?>
                       
                    <?php $form->field($model, 'cpf')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999.999.999-99']) ?>

                    <?php $form->field($model, 'telefone')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>

                    <?php $form->field($model, 'telefoneAlt')->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-999[9]']) ?>
                                       

                 </div>

            <!--            ENDEREÇO                -->

                    <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-sm-12">

                                    <?= $form->field($curriculosEndereco, 'cep')->widget('yiibr\correios\CepInput', [
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
                                <?= $form->field($curriculosEndereco, 'endereco')->textInput(['readonly'=>true]) ?>
                                </div>

                                <div class="col-sm-2">
                                <?= $form->field($curriculosEndereco, 'numero_end')->textInput(['placeholder'=>'Número']) ?>
                                </div>

                                <div class="col-sm-4">
                                <?= $form->field($curriculosEndereco, 'bairro')->textInput(['readonly'=>true]) ?>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                <?= $form->field($curriculosEndereco, 'complemento')->textInput(['placeholder'=>'Complemento']) ?>
                                </div>

                                <div class="col-sm-4">
                                <?= $form->field($curriculosEndereco, 'cidade')->textInput(['readonly'=>true]) ?>
                                </div>

                                <div class="col-sm-2">
                                <?= $form->field($curriculosEndereco, 'estado')->textInput(['readonly'=>true]) ?>
                                </div>
                            </div>

                    </div>


                        <div class="tab-pane" id="tab3">
                            3
                        </div>
                        <div class="tab-pane" id="tab4">
                            4
                        </div>
                        <div class="tab-pane" id="tab5">
                            5
                        </div>
                        <ul class="pager wizard">
                            <li class="previous first" style="display:none;"><a href="#">First</a></li>
                            <li class="previous"><a href="#">Anterior</a></li>
                            <li class="next last" style="display:none;"><a href="#">Last</a></li>
                            <li class="next"><a href="#">Próximo</a></li>
                        </ul>
                    </div>  
                </div>

                

<?php
$script = <<< JS
$(document).ready(function() {
    $('#rootwizard').bootstrapWizard({'tabClass': 'nav nav-tabs'});
});
JS;
$this->registerJs($script);
?>


<?php
 $this->registerJsFile(Yii::$app->request->baseUrl.'/js/bootstrap.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
 $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.bootstrap.wizard.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>