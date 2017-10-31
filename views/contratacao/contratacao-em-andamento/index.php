<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\contratacao\SituacaoContratacao;
use app\models\curriculos\Unidades;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratacaoEmAndamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contratações em Andamento';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

<div class="contratacao-em-andamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                            return Yii::$app->controller->renderPartial('../contratacao/imprimir', ['model'=>$model]);
                        },
                        'headerOptions'=>['class'=>'kartik-sheet-style'], 
                        'expandOneOnly'=>true
                        ],

                        'id',

                        [
                            'attribute' => 'data_solicitacao',
                            'format' => ['date', 'php:d/m/Y'],
                        ],

                        'colaborador',

                        [
                            'attribute'=>'unidade', 
                            'width'=>'310px',
                            'value'=>function ($model, $key, $index, $widget) { 
                                return $model->unidade;
                            },
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(Unidades::find()->orderBy('uni_nomeabreviado')->asArray()->all(), 'uni_nomeabreviado', 'uni_nomeabreviado'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true],
                            ],
                                'filterInputOptions'=>['placeholder'=>'Selecione a Unidade'],
                        ],

                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'situacao_id',
                            'value'=>function ($model, $key, $index, $widget) { 
                                return $model->situacao->descricao;
                            },
                            'readonly'=>function($model, $key, $index, $widget) {
                                return (!$model->situacao_id); // do not allow editing of inactive records
                            },
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(SituacaoContratacao::find()->orderBy('descricao')->asArray()->all(), 'descricao', 'descricao'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true],
                            ],
                                'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
                            //CAIXA DE ALTERAÇÕES DA SITUAÇÃO
                            'editableOptions' => [
                                'header' => 'Situação',
                                'data'=>[
                                            7 => 'Pedido Recebido', 
                                            8 => 'Aguardando Autorização de Custo', 
                                            9 => 'Elaboração de Edital', 
                                            10 => 'Período de Inscrição', 
                                            // 11 => 'Análise de Currículo',
                                            // 12 => 'Avaliação Escrita', 
                                            // 13 => 'Avaliação Comportamental', 
                                            // 14 => 'Avaliação Didática', 
                                            // 15 => 'Entrevista', 
                                            16 => 'Homologação',
                                            17 => 'Pedido de Contratação',
                                        ],
                                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                            ],          
                        ],

                        ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {encerrar} {correcao} {cancelar}',
                        'contentOptions' => ['style' => 'width: 35%'],
                        'buttons' => [

                        //VISUALIZAR
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Visualizar', $url, [
                                        'class'=>'btn btn-primary btn-xs',
                       
                            ]);
                        },

                        //ENCERRAR PROCESSO SOLETIVO
                        'encerrar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> Encerrar', $url, [
                                         'class'=>'btn btn-success btn-xs',
                                         'data' => [
                                                   'confirm' => 'Você tem certeza que deseja ENCERRAR essa Solicitação de Contratação?',
                                                   'method' => 'post',
                                                   ],
                            ]);
                        },

                        //ENVIAR PARA CORREÇÃO E INSERIR JUSTIIFCATIVA
                        'correcao' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-repeat"></span> Correção', $url, [
                                         'class'=>'btn btn-warning btn-xs',
                                   ]);
                                },


                        //CANCELAR
                        'cancelar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar', $url, [
                                         'class'=>'btn btn-danger btn-xs',
                                         'data' => [
                                                   'confirm' => 'Você tem certeza que deseja CANCELAR essa Solicitação de Contratação?',
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
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes da Solicitação de Contratação', 'options'=>['colspan'=>6, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Contratações em Andamento</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>
