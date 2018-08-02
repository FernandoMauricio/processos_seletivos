<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\datecontrol\DateControl;
use kartik\widgets\TimePicker;
use yii\helpers\Url;
use yii\helpers\Json;
use faryshta\widgets\JqueryTagsInput;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geracao-arquivos-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
                   
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Formulário de Cadastrado para Geração de Arquivo</h3>
        </div>
                   <?php echo $form->errorSummary($model); ?>
            <div id="rootwizard" class="tabbable tabs-left">
                <ul>
                    <li><a href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Informações</a></li>
                    <li><a href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Listagem de Candidatos</a></li>
                </ul>
                    <div class="tab-content"><br>
                        <div class="tab-pane" id="tab1">
                            <?= $this->render('_form-geracao-arquivo', [
                                'form' => $form,
                                'model' => $model,
                            ]) ?>
                        </div>

                        <div class="tab-pane" id="tab2">
                           <?= $this->render('_form-candidatos', [
                                'form' => $form,
                                'model' => $model,
                                'modelsItens' => $modelsItens,
                            ]) ?>
                        </div>
                    </div>
            </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
            <!--          JS etapas dos formularios            -->
<?php
$script = <<< JS
$(document).ready(function() {
    $('#rootwizard').bootstrapWizard({'tabClass': 'nav nav-tabs'});
});

JS;
$this->registerJs($script);
?>

<?php  $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.bootstrap.wizard.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
