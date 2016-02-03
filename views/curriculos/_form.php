<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\datecontrol\DateControl;
use wbraganca\dynamicform\DynamicFormWidget;

 
/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curriculos-endereco-form">

<?php $form = ActiveForm::begin(['id' => 'dynamic-form','type'=>ActiveForm::TYPE_VERTICAL]); ?>
        
        <?php echo $form->errorSummary($model); ?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Cadastros de Curriculos</h3>
  </div>
  <div class="panel-body">
        <div class="span12">
            <section id="wizard">

                <div id="rootwizard" class="tabbable tabs-left">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Candidato</a></li>
                        <li><a href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-home"></span> Endereço</a></li>
                        <li><a href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-education"></span> Formação Escolar</a></li>
                        <li><a href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-bookmark"></span> Cursos Complementares</a></li>
                        <li><a href="#tab5" data-toggle="tab"><span class="glyphicon glyphicon-briefcase"></span> Empregos Anteriroes</a></li>
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
                                        'cep' => 'curriculosendereco-cep',
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



                    <!--         FORMAÇÃO       -->

                        <div class="tab-pane" id="tab3">

        <?= $form->field($curriculosFormacao, 'fundamental_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?>

        <?= $form->field($curriculosFormacao, 'medio_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'superior_comp'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'superior_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a sua graduação...'],'columnOptions'=>['colspan'=>2]],
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'pos'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'pos_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de Pós-graduação...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'mestrado'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'mestrado_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de mestrado...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'doutorado'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'doutorado_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de Pós-graduação...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'estuda_atualmente'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Sim', 0=>'Não'], 'options'=>['inline'=>true]],
                                    'estuda_curso'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

        <?= $form->field($curriculosFormacao, 'estuda_turno_mat')->checkbox() ?>
        
        <?= $form->field($curriculosFormacao, 'estuda_turno_vesp')->checkbox() ?>
        
        <?= $form->field($curriculosFormacao, 'estuda_turno_not')->checkbox() ?>

                        </div>


                    <!--        CURSOS COMPLEMENTARES      -->

            <div class="tab-pane" id="tab4">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4><i class="glyphicon glyphicon-bookmark"></i> Listagem de Cursos Complementares</h4></div>
                        <div class="panel-body">
                             <?php DynamicFormWidget::begin([
                                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                'widgetBody' => '.container-items', // required: css class selector
                                'widgetItem' => '.item', // required: css class
                                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                                'min' => 1, // 0 or 1 (default 1)
                                'insertButton' => '.add-item', // css class
                                'deleteButton' => '.remove-item', // css class
                                'model' => $modelsComplemento[0],
                                'formId' => 'dynamic-form',
                                'formFields' => [
                                    'cursos',
                                    'certificado',
                                    'curriculos_id',
                                ],
                            ]); ?>

                            <div class="container-items"><!-- widgetContainer -->
                            <?php foreach ($modelsComplemento as $i => $modelComplemento): ?>
                                <div class="item panel panel-default"><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <h3 class="panel-title pull-left">Curso Complementar</h3>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                    
                                        <?php
                                            // necessary for update action.
                                            if (! $modelComplemento->isNewRecord) {
                                                echo Html::activeHiddenInput($modelComplemento, "[{$i}]id");
                                            }
                                        ?>

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <?= $form->field($modelComplemento, "[{$i}]cursos")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= $form->field($modelComplemento, "[{$i}]certificado")->radioList([1 =>'Sim', 0 =>'Não'], ['inline'=>true]) ?>
                                            </div>
                                        </div><!-- .row -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                        </div>
                </div>
            </div>


                        <div class="tab-pane" id="tab5">
                            5

                            <?= Html::submitButton($model->isNewRecord ? 'Enviar Curriculo' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block']) ?>
                        </div>
                        <ul class="pager wizard">
                            <li class="previous"><a href="#">Anterior</a></li>
                            <li class="next"><a href="#">Próximo</a></li>
                        </ul>

        

                    </div>  
                </div>

      </div>
    </div>


  <?php ActiveForm::end(); ?>

            <!--          JS etapas dos formularios            -->
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