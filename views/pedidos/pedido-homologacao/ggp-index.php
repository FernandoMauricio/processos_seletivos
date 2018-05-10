<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use app\models\pedidos\pedidocusto\PedidocustoSituacao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pedidos\pedidocontratacao\PedidoContratacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido de Homologação em Aprovação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-pedidocontratacao-index">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>
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
                return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'modelsItens' => $model->pedidohomologacaoItens]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'], 
            'expandOneOnly'=>true
            ],

            'homolog_id',
            'homolog_unidade',
            'homolog_cargo',
            [
               'attribute' => 'homolog_total',
               'contentOptions' => ['class' => 'col-lg-1'],
               'format' => ['decimal',2],
            ],

            [
                'attribute'=>'homolog_situacaoggp', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->homologSituacaoggp->situacao_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(PedidocustoSituacao::find()->orderBy('situacao_descricao')->asArray()->all(), 'situacao_descricao', 'situacao_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
            ],

            [
                'attribute'=>'homolog_situacaodad', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->homologSituacaodad->situacao_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(PedidocustoSituacao::find()->orderBy('situacao_descricao')->asArray()->all(), 'situacao_descricao', 'situacao_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
            ],

            'homolog_responsavel',
            
            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{aprovar-ggp} {reprovar-ggp}',
                        'contentOptions' => ['style' => 'width: 7%;'],
                        'buttons' => [

                        //APROVAR
                        'aprovar-ggp' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> ', $url, [
                                        'class'=>'btn btn-success btn-xs',
                                        'title' => Yii::t('app', 'Aprovar'),
                       
                            ]);
                        },

                        //REPROVAR
                        'reprovar-ggp' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Reprovar'),
                       
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
                ['content'=>'Detalhes do Pedido de Homologação', 'options'=>['colspan'=>8, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Pedido de Homologação em Aprovação</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

