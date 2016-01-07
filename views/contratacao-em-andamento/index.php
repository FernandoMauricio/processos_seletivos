<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

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
<div class="contratacao-index">

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
                            return Yii::$app->controller->renderPartial('/contratacao/pdf_contratacao', ['model'=>$model]);
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
                        
                        'unidade',
                        
                        [
                            'attribute' => 'situacao_id',
                            'value' => 'situacao.descricao',
                        ],
                        // 'cod_unidade_solic',
                        // 'unidade',
                        // 'quant_pessoa',
                        // 'motivo:ntext',
                        // 'substituicao',
                        // 'periodo',
                        // 'tempo_periodo',
                        // 'aumento_quadro',
                        // 'nome_substituicao',
                        // 'deficiencia',
                        // 'obs_deficiencia:ntext',
                        // 'data_ingresso',
                        // 'fundamental_comp',
                        // 'fundamental_inc',
                        // 'medio_comp',
                        // 'medio_inc',
                        // 'tecnico_comp',
                        // 'tecnico_inc',
                        // 'tecnico_area',
                        // 'superior_comp',
                        // 'superior_inc',
                        // 'superior_area',
                        // 'pos_comp',
                        // 'pos_inc',
                        // 'pos_area',
                        // 'dominio_atividade:ntext',
                        // 'windows',
                        // 'word',
                        // 'excel',
                        // 'internet',
                        // 'experiencia',
                        // 'experiencia_tempo',
                        // 'experiencia_atividade',
                        // 'jornada_horas',
                        // 'jornada_obs:ntext',
                        // 'principais_atividades:ntext',
                        // 'recrutamento_id',
                        // 'selec_curriculo',
                        // 'selec_dinamica',
                        // 'selec_prova',
                        // 'selec_entrevista',
                        // 'selec_teste',
                        // 'situacao_id',

                        ['class' => 'yii\grid\ActionColumn',
                        'template' => '{encerrar} {correcao} {cancelar}',
                        'contentOptions' => ['style' => 'width: 380px;'],
                        'buttons' => [


                        //ENCERRAR PROCESSO SOLETIVO
                        'encerrar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> Encerrar', $url, [
                                        'class'=>'btn btn-success btn-xs',
                                        'data' => [
                                                        'confirm' => 'Você tem CERTEZA que deseja ENCERRAR o processo?',
                                                        'method' => 'post',
                                                    ],
                            ]);
                        },
                        //ENVIAR PARA CORREÇÃO
                        'correcao' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-repeat"></span> Enviar para Correção', $url, [
                                        'class'=>'btn btn-warning btn-xs',
                       
                            ]);
                        },

                        //CANCELAR
                        'cancelar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                       
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
                ['content'=>'Detalhes da Solicitação de Contratação', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
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
