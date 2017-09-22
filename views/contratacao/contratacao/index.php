<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use app\models\contratacao\SituacaoContratacao;
use app\models\curriculos\Unidades;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitação de Contratação ';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

$session = Yii::$app->session;
$unidade = $session['sess_unidade'];

?>
<div class="contratacao-index">

    <h1><?= Html::encode($this->title) .'<small>'.$unidade.'</small>' ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Contratação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                            return Yii::$app->controller->renderPartial('imprimir', ['model'=>$model]);
                        },
                        'headerOptions'=>['class'=>'kartik-sheet-style'], 
                        'expandOneOnly'=>true
                        ],

                        'id',

                        [
                            'attribute' => 'data_solicitacao',
                            'format' => ['datetime', 'php:d/m/Y'],
                            'width' => '190px',
                            'hAlign' => 'center',
                            'filter'=> DatePicker::widget([
                            'model' => $searchModel, 
                            'attribute' => 'data_solicitacao',
                            'pluginOptions' => [
                                 'autoclose'=>true,
                                 'format' => 'yyyy-mm-dd',
                                ]
                            ])
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
                            'attribute'=>'situacao_id', 
                            'width'=>'310px',
                            'value'=>function ($model, $key, $index, $widget) { 
                                return $model->situacao->descricao;
                            },
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>ArrayHelper::map(SituacaoContratacao::find()->orderBy('descricao')->asArray()->all(), 'descricao', 'descricao'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true],
                            ],
                                'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
                        ],

                        [
                            'attribute' => 'data_ingresso',
                            'hAlign' => 'center',
                            'filter'=> DatePicker::widget([
                            'model' => $searchModel, 
                            'attribute' => 'data_ingresso',
                            'pluginOptions' => [
                                 'autoclose'=>true,
                                ]
                            ])
                        ],

                        ['class' => 'yii\grid\ActionColumn',
                        'template' => ' {observacoes} {view} {etapas} {update} {delete}',
                        'contentOptions' => ['style' => 'width: 15%;'],
                        'buttons' => [

                        //OBSERVAÇÕES PARA CORREÇÃO DA SOLICITAÇÃO
                        'observacoes' => function ($url, $model) {
                            return $model->situacao_id == 2 ? Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [
                                'class'=>'btn btn-danger btn-xs',
                                'title' => Yii::t('app', 'Observações'),
                                   ]): '';
                        },

                        //VISUALIZAR CONTRATAÇÃO
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                        'class'=>'btn btn-default btn-xs',
                                        'title' => Yii::t('app', 'Visualizar'),
                                    ]);
                        },

                        //ENVIAR PARA CORREÇÃO E INSERIR JUSTIIFCATIVA
                        'etapas' => function ($url, $model) {
                            return isset($model->pedidocustoItens->contratacao_id) ? Html::a('<span class="glyphicon glyphicon-list"></span> ', $url, [
                                        'target'=>'_blank', 
                                        'data-pjax'=>"0",
                                        'class'=>'btn btn-info btn-xs',
                                        'title' => Yii::t('app', 'Listagem de Candidatos aprovados para as Etapas do Processo'),
                                    ]): '';
                        },

                        //ATUALIZAR A SOLICITAÇÃO
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url, [
                                        'class'=>'btn btn-primary btn-xs',
                                        'title' => Yii::t('app', 'Atualizar'),
                                    ]);
                        },

                        //DELETAR A SOLICITAÇÃO
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Deletar'),
                                    ]);
                        },  
                ],
            ],
    ]; ?>

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
                ['content'=>'Detalhes da Solicitação de Contratação', 'options'=>['colspan'=>7, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Contratações</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>
