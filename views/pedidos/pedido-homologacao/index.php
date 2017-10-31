<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use app\models\pedidos\pedidocusto\PedidocustoSituacao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pedidos\pedidohomologacao\PedidoHomologacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos de Homologações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-homologacao-index">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Novo Pedido de Homologação', ['value'=> Url::to('index.php?r=pedidos/pedido-homologacao/gerar-pedido-homologacao'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Geração do Processo de Homologação</h4>',
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
                         return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'modelsItens' => $model->pedidohomologacaoItens]);
                     },
                     'headerOptions'=>['class'=>'kartik-sheet-style'], 
                     'expandOneOnly'=>true
                     ],

                    'homolog_id',
                    [
                           'attribute' => 'contratacao_id',
                           'format' => 'raw',
                           'value' => function ($data) {
                                         return Html::a($data->contratacao_id, ['/contratacao/contratacao/view', 'id' => $data->contratacao_id], ['target'=>'_blank', 'data-pjax'=>"0"]);
                                     },
                    ],
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
                    [
                        'class'=>'kartik\grid\EditableColumn',
                        'attribute'=>'homolog_datahomologacao',    
                        'hAlign'=>'center',
                        'vAlign'=>'middle',
                        'width'=>'9%',
                        'format' => ['datetime', 'php:d/m/Y'],
                        'xlFormat'=>"mmm\\-dd\\, \\-yyyy",
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                        'readonly'=>function($model, $key, $index, $widget) {
                            return (isset($model->pedcontratacao_homologador)); // do not allow editing of inactive records
                        },
                        'editableOptions'=>[
                            'inputType'=>\kartik\editable\Editable::INPUT_WIDGET,
                            'widgetClass'=> 'kartik\datecontrol\DateControl',
                            'options'=>[
                                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                                'displayFormat'=>'dd/MM/yyyy',
                                'saveFormat'=>'php:Y-m-d',
                                'options'=>[
                                    'pluginOptions'=>[
                                        'autoclose'=>true
                                    ]
                                ]
                            ]
                        ],
                    ],

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

    <?php Pjax::begin(['id' => 'w0-pjax']); ?>

    <?php 
        echo GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'rowOptions' =>function($model){
                    if($model->homolog_situacaoggp == 4 && $model->homolog_situacaodad == 4)
                    {
                        return['class'=>'success'];                        
                    }
        },
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Detalhes do Pedido de Homologação', 'options'=>['colspan'=>10, 'class'=>'text-center warning']], 
                    ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
                ],
            ]
        ],
            'hover' => true,
            'panel' => [
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Pedidos de Homologações</h3>',
        ],
        ]);
    ?>
    <?php Pjax::end(); ?>

</div>