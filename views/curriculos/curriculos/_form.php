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

<?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
        

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> Cadastros de Curriculos</h3>
  </div>
  <div class="panel-body">
                            <?php echo $form->errorSummary($model); ?>    
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

                  <!--            INFORMAÇÕES DO CANDIDATO                -->

                        <div class="tab-pane" id="tab1">
                    <?php
                    echo $this->render('_form-candidato', [
                        'form' => $form,
                        'model' => $model,
                        'cargos' => $cargos,
                    ])
                    ?>
                 </div>


            <!--            ENDEREÇO                -->

                    <div class="tab-pane" id="tab2">
                    <?php
                    echo $this->render('_form-endereco', [
                        'form' => $form,
                        'curriculosEndereco' => $curriculosEndereco,
                    ])
                    ?>
                    </div>

                    <!--         FORMAÇÃO       -->

                    <div class="tab-pane" id="tab3">
                    <?php
                    echo $this->render('_form-formacao', [
                        'form' => $form,
                        'curriculosFormacao' => $curriculosFormacao,
                    ])
                    ?>
                    </div>


                    <!--        CURSOS COMPLEMENTARES      -->

                        <div class="tab-pane" id="tab4">
                            <div class="row">
                     <?php
                     echo $this->render('_form-complemento', [
                        'form' => $form,
                        'modelsComplementos' => $modelsComplementos,
                        ])
                        ?>
                            </div>
                        </div>


                                <!--        EMPREGOS ANTERIORES      -->

                        <div class="tab-pane" id="tab5">
                             <div class="row">
                        <?php
                        echo $this->render('_form-empregos', [
                        'form' => $form,
                        'modelsEmpregos' => $modelsEmpregos,
                        ])
                        ?>
                             </div>


                        <?php
                            $list = ['Jornais' => 'Jornais', 'Internet' => 'Internet', 'Televisão' => 'Televisão', 'Redes Sociais' => 'Redes Sociais'];
                            echo $form->field($model, 'marketing')->checkboxlist($list);
                        ?> 

<P style="text-align: center;"><b>DECLARAÇÃO</b></P>

  <?= $form->field($model, 'termoAceite[]')->checkboxList([ 1 => 'Li o Documento de Abertura e concordo em participar do processo de seleção desta instituição de acordo com o que foi estabelecido e proposto pelo mesmo.'])->label(false); ?>

<div class="row">
    <div class="col-md-2">
  <?= $form->field($model, 'parentesco')->radiolist(['0' => 'Não', '1' => 'Sim'], ['inline'=>true])->label(false); ?>
    </div>

    <div class="col-md-10">
    <p>Declaro para os devidos fins, que ______ tenho parentes que sejam servidores do SESC ou do SENAC, que sejam membros, efetivos ou suplentes, dos Conselhos Nacional, Fiscal e do Conselho Regional neste Estado, bem como que sejam dirigentes de entidades sindicais ou civis, do comércio, patronais ou de empregados</p>
    </div>
</div>

   <?= $form->field($model, 'termoAceite2[]')->checkboxList([ 1 => 'Declaro que todas as informações contidas nesse formulário e no meu currículo constituem a expressão da verdade, e sobre as quais assumo total responsabilidade. Ficando V.S.ª autorizada a efetuar qualquer confirmação que achar necessária, e que a inexatidão das informações ou irregularidades nos documentos, verificadas a qualquer tempo, acarretará a nulidade da Contratação, com todas as suas decorrências, sem prejuízo das demais medidas de ordem administrativa, civil ou criminal.'])->label(false); ?>


                             <!-- SUBMIT PARA ENVIAR O CURRICULO SE TODOS OS CAMPOS COM VALIDAÇÕES TIVEREM SIDO PREENCHIDOS-->
                            <?= Html::submitButton('Finalizar Cadastro de Currículo', ['class' => 'btn btn-success btn-lg btn-block',
                            'data' => [
                            'confirm' => 'Você tem certeza que deseja enviar seu currículo?',
                            'method' => 'post'
                            ],
                        ]) ?>
                        </div>

                        <!-- BOTÕES PARA NAVEGAR ENTRE OS FORMULÁRIOS-->
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