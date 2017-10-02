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

$this->title = 'Pedido de Contratação em Aprovação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-contratacao-index">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Pedido de Contratação', ['create'], ['class' => 'btn btn-success']) ?>
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
                 return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'modelsItens' => $model->pedidocontratacaoItens]);
             },
             'headerOptions'=>['class'=>'kartik-sheet-style'], 
             'expandOneOnly'=>true
             ],

            'pedcontratacao_id',
            [
                'attribute' => 'pedidocusto_id',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->pedidoCusto->etapasProcesso->pedidocusto_id;
                },
            ],
            'pedcontratacao_assunto',
            'pedcontratacao_recursos',
            [
               'attribute' => 'pedcontratacao_valortotal',
               'contentOptions' => ['class' => 'col-lg-1'],
               'format' => ['decimal',2],
            ],

            [
                'attribute'=>'pedcontratacao_situacaoggp', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->pedcontratacaoSituacaoggp->situacao_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(PedidocustoSituacao::find()->orderBy('situacao_descricao')->asArray()->all(), 'situacao_descricao', 'situacao_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
            ],

            [
                'attribute'=>'pedcontratacao_situacaodad', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->pedcontratacaoSituacaodad->situacao_descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(PedidocustoSituacao::find()->orderBy('situacao_descricao')->asArray()->all(), 'situacao_descricao', 'situacao_descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
            ],

            'pedcontratacao_responsavel',
            

            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'contentOptions' => ['style' => 'width: 7%;'],
                        'buttons' => [

                        //VISUALIZAR/IMPRIMIR
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-print"></span> ', $url, [
                                        'target'=>'_blank', 
                                        'data-pjax'=>"0",
                                        'class'=>'btn btn-info btn-xs',
                                        'title' => Yii::t('app', 'Imprimir'),
                       
                            ]);
                        },

                        //VISUALIZAR/IMPRIMIR
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url, [
                                        'class'=>'btn btn-default btn-xs',
                                        'title' => Yii::t('app', 'Atualizar'),
                       
                            ]);
                        },

                         //DELETAR
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Deletar'),
                                        'data' =>  [
                                                        'confirm' => 'Você tem CERTEZA que deseja EXCLUIR esse item?',
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
                ['content'=>'Detalhes do Pedido de Contratação', 'options'=>['colspan'=>9, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Pedido de Contratação em Aprovação</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

