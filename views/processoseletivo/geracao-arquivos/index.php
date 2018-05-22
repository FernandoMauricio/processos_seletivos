<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\processoseletivo\geracaoarquivo\GeracaoArquivosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geração de Arquivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geracao-arquivos-index">

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
    <h1><?= Html::encode($this->title) . ' <small>Resultados das Etapas / Resultados Finais</small>' ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Criar Geração de Arquivo', ['value'=> Url::to('index.php?r=processoseletivo/geracao-arquivos/create'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Geração de Arquivos</h4>',
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
                 return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'modelsItens' => $model->geracaoarquivosItens]);
             },
             'headerOptions'=>['class'=>'kartik-sheet-style'], 
             'expandOneOnly'=>true
             ],
            'gerarq_id',
            [
                'attribute' => 'processo_id',
                'value' => 'processo.numeroEdital',
            ],
            [
                'attribute' => 'etapasprocesso_id',
                'value' => 'etapasprocesso.etapa_cargo',
            ],
            'gerarq_titulo',
            'gerarq_fase:ntext',
            'gerarq_local',
            [
                'attribute'=>'gerarq_perfil', 
                'value' => function ($data) { return $data->gerarq_perfil == 0 ? 'Administrativo' : 'Docente'; },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['0'=>'Administrativo','1'=>'Docente'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione o Perfil'],
            ],
            [
                'attribute'=>'gerarq_tipo', 
                'value' => function ($data) { return $data->gerarq_tipo == 0 ? 'Resultados das Etapas' : 'Resultado Final'; },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['0'=>'Resultados das Etapas','1'=>'Resultado Final'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione o Tipo'],
            ],

            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{imprimir} {update} {delete}',
                        'contentOptions' => ['style' => 'width: 10%;'],
                        'buttons' => [

                        //VISUALIZAR/IMPRIMIR
                        'imprimir' => function ($url, $model) {
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
                ['content'=>'Detalhes das Gerações de Arquivos', 'options'=>['colspan'=>9, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Geração de Arquivos</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>
