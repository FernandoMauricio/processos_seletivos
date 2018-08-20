<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

use app\models\curriculos\SituacaoCandidato;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Candidatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-index">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo Collapse::widget([
                    'items' => [
                        // equivalent to the above
                        [
                            'label' => 'Pesquisa Avançada',
                            'content' => $this->render('_search', ['model' => $searchModel]),
                            // open its content by default
                            //'options' => ['class' => 'panel panel-primary']
                        ],
                    ]
                ]);
    ?>

    <p>
        <?= Html::button('Enviar Pré-Selecionados', ['value'=> Url::to('index.php?r=curriculos/curriculos-admin/pre-selecionados'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'options' => ['tabindex' => false ], // important for Select2 to work properly
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => true],
            'header' => '<h4>Defina o edital a ser enviado os Curriculos Pré-Selecionados:</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

<?php

$gridColumns = [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'50px',
                'format' => 'raw',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'curriculosEnderecos' => $model->curriculosEnderecos, 'curriculosFormacaos' => $model->curriculosFormacaos, 'curriculosComplementos' => $model->curriculosComplementos, 'curriculosEmpregos' => $model->curriculosEmpregos]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'], 
                'expandOneOnly'=>true
            ],

            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'edital',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'numeroInscricao',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'cargo',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'nome',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'cpf',
            'options' => ['width' => '140px'],
            ],

            [
            'attribute'=>'idade',
            'options' => ['width' => '50px'],
            ],

            [
            'attribute'=>'email',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'emailAlt',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'telefone',
            'options' => ['width' => '300px'],
            ],

            [
                'attribute'=>'sexo',
                'width'=>'6%',
                'value' => function ($data) { return $data->sexo == 0 ? 'Feminino' : 'Masculino'; },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['0'=>'Feminino','1'=>'Masculino'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Sexo'],
            ],

            [
                'attribute' => 'deficiencia',
                'label' => 'Deficiência',
                'value' => function ($data) { return $data->deficiencia ? 'Sim' : 'Não'; },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['0'=>'Não','1'=>'Sim'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Deficiência'],
            ],

            [
                'attribute'=>'classificado', 
                'width'=>'8%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->situacaoCandidato->sitcan_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(SituacaoCandidato::find()->orderBy('sitcan_descricao')->asArray()->all(), 'sitcan_id', 'sitcan_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Situação'],
            ],

            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{imprimir} {aguardando-envio-gerencia-imediata} {desclassificarggp}',
                        'contentOptions' => ['style' => 'width: 10%;'],
                        'buttons' => [

                        //IMPRIMIR
                        'imprimir' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-print"></span> ', $url, [
                                        'target'=>'_blank', 
                                        'data-pjax'=>"0",
                                        'class'=>'btn btn-info btn-xs',
                                        'title' => Yii::t('app', 'Imprimir'),
                       
                            ]);
                        },

                        //VISUALIZAR
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                        'class'=>'btn btn-primary btn-xs',
                                        'title' => Yii::t('app', 'Visualizar candidato'),
                       
                            ]);
                        },

                        //CLASSIFICAR CANDIDATO
                        'aguardando-envio-gerencia-imediata' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> ', $url, [
                                        'class'=>'btn btn-warning btn-xs',
                                        'title' => Yii::t('app', 'Pré-Selecionar Candidato'),
                                         'data' => [
                                                   'method' => 'post',
                                                   ],
                            ]);
                        },
                        
                        //DESCLASSIFICAR CANDIDATO COMO GGP
                        'desclassificarggp' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Desclassificar Candidato'),
                                         'data' => [
                                                   //'confirm' => 'Você tem certeza que deseja <b style="color: red;">DESCLASSIFICAR</b> esse candidato?',
                                                   'method' => 'post',
                                                   ],
                       
                            ]);
                        },

                        //DESCLASSIFICAR CANDIDATO
                        'desclassificarggp' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Desclassificar Candidato'),
                                         'data' => [
                                                   //'confirm' => 'Você tem certeza que deseja <b style="color: red;">DESCLASSIFICAR</b> esse candidato?',
                                                   'method' => 'post',
                                                   ],
                       
                            ]);
                        },
            ],
       ],
    ]; 

?>

<?php Pjax::begin(); ?>

    <?php 
    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>false, // pjax is set to always true for this demo
    'rowOptions' =>function($model){
                if($model->classificado == '0') //Desclassificado
                {
                    return['class'=>'danger'];                        
                }elseif ($model->classificado == '1') {//Classificado
                    return['class'=>'success']; 
                }elseif ($model->classificado == '2') {//Pré-Selecionado pela Gerência Imediata
                    return['class'=>'success']; 
                }elseif ($model->classificado == '3') {//Aguardando Envio para Gerência Imediata
                    return['class'=>'warning']; 
                }elseif ($model->classificado == '4') {//Enviado para Gerência imediata
                    return['class'=>'info']; 
                }

    },
    'export'=>[
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK,
            'autoXlFormat'=>true,
        ],

 'exportConfig' => [
        kartik\export\ExportMenu::EXCEL => true,
        kartik\export\ExportMenu::PDF => true,
    ],  

'toolbar' => [
        '{toggleData}',
        '{export}',
    ],

    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes de Curriculos Cadastrados', 'options'=>['colspan'=>14, 'class'=>'text-center warning']], 
                ['content'=>'Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']],
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Curriculos</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>




</div>

