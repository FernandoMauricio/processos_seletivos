<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use app\models\etapasprocesso\EtapasItens;
use yii\db\Expression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\etapasprocesso\EtapasProcessoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadastro de Reserva';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-cadastro-de-reserva-index">
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

            'pedidohomologacao_id',
            'pedhomolog_docabertura', 
            'pedhomolog_numeroInscricao', 
            'pedhomolog_candidato',
            [
                'attribute' => 'email',
                'value' => function($model) { 
                    return $model->curriculos->email; 
                }
            ],
            [
                'attribute' => 'email',
                'value' => function($model) { 
                    return $model->curriculos->telefone; 
                }
            ],
            'pedhomolog_classificacao',
            [
                'attribute' => 'unidade',
                'value' => function($model) { 
                    return $model->pedidohomologacao->contratacao->unidade; 
                }
            ],
            'pedhomolog_localcontratacao', 
            'pedhomolog_cargo', 
            [
                'attribute' => 'pedhomolog_expiracao',
                'format' => ['datetime', 'php:d/m/Y'],
                'width' => '10%',
                'hAlign' => 'center',
                'filter'=> DatePicker::widget([
                'model' => $searchModel, 
                'attribute' => 'pedhomolog_expiracao',
                'pluginOptions' => [
                     'autoclose'=>true,
                     'format' => 'yyyy-mm-dd',
                    ]
                ])
            ],

            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'contentOptions' => ['style' => 'width: 7%;'],
                        'buttons' => [

                        //VISUALIZAR/IMPRIMIR
                        'view' => function ($url, $model) {
                            $url = 'index.php?r=curriculos/curriculos-admin/imprimir&id=' . $model->curriculos_id;
                            return Html::a('<span class="glyphicon glyphicon-print"></span> ', $url, [
                                        'target'=>'_blank', 
                                        'data-pjax'=>"0",
                                        'class'=>'btn btn-info btn-xs',
                                        'title' => Yii::t('app', 'Imprimir'),
                       
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
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
        'beforeGrid'=>'<em style="color:red;">Listagem de candidatos com validade até 1 ano a partir da <b>Data de Homologação</b>.</em>',
    ],
    'beforeHeader'=>[
        [
            'columns'=>[
                ['content'=>'Detalhes do Cadastro de Reserva', 'options'=>['colspan'=>11, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem - Cadastro de Reserva</h3>',
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

