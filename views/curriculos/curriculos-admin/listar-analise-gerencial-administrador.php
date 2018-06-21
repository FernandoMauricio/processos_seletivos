<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

use app\models\curriculos\Unidades;
use app\models\curriculos\SituacaoCandidato;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Análise de Curriculos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-admin-index">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>
    <h1><?= Html::encode($this->title). '<small> Administrador </small>' ?></h1>

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
                    return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'curriculosEnderecos' => $model->curriculosEnderecos, 'curriculosFormacaos' => $model->curriculosFormacaos, 'curriculosComplementos' => $model->curriculosComplementos, 'curriculosEmpregos' => $model->curriculosEmpregos]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'], 
                'expandOneOnly'=>true
            ],

            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'unidade_aprovador', 
                'width'=>'7%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->unidades->uni_nomeabreviado;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Unidades::find()->orderBy('uni_nomeabreviado')->asArray()->all(), 'uni_codunidade', 'uni_nomeabreviado'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione a Unidade'],
            ],

            [
            'attribute'=>'edital',
            'label' => 'Doc. Abertura',
            'options' => ['width' => '5%'],
            ],

            [
            'attribute'=>'numeroInscricao',
            'options' => ['width' => '5%'],
            ],

            [
            'attribute'=>'cargo',
            'options' => ['width' => '5%'],
            ],

            [
            'attribute'=>'nome',
            'options' => ['width' => '5%'],
            ],

            [
            'attribute'=>'cpf',
            'options' => ['width' => '5%'],
            ],

            [
            'attribute'=>'idade',
            'options' => ['width' => '50px'],
            ],

            [
            'attribute'=>'email',
            'options' => ['width' => '4%'],
            ],

            [
            'attribute'=>'emailAlt',
            'options' => ['width' => '4%'],
            ],

            [
            'attribute'=>'telefone',
            'options' => ['width' => '4%'],
            ],

            [
                'attribute'=>'sexo', 
                'value' => function ($data) { return $data->sexo == 0 ? 'Feminino' : 'Masculino'; },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['0'=>'Feminino','1'=>'Masculino'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione o sexo'],
            ],
 
            // [
            //     'attribute'=>'classificado', 
            //     'width'=>'3%',
            //     'value'=>function ($model, $key, $index, $widget) { 
            //         return $model->situacaoCandidato->sitcan_descricao;
            //     },
            //     'filterType'=>GridView::FILTER_SELECT2,
            //     'filter'=>ArrayHelper::map(SituacaoCandidato::find()->orderBy('sitcan_descricao')->asArray()->all(), 'sitcan_id', 'sitcan_descricao'), 
            //     'filterWidgetOptions'=>[
            //         'pluginOptions'=>['allowClear'=>true],
            //     ],
            //         'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
            // ],

            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{imprimir} {classificar-admin} {desclassificar-admin}',
                        'contentOptions' => ['style' => 'width: 15%;'],
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

                        //CLASSIFICAR CANDIDATO
                        'classificar-admin' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> ', $url, [
                                        'class'=>'btn btn-success btn-xs',
                                        'title' => Yii::t('app', 'Classificar Candidato'),
                                         'data' => [
                                                   'confirm' => 'Você tem certeza que deseja <b style="color: green;">CLASSIFICAR</b> esse candidato?',
                                                   'method' => 'post',
                                                   ],
                            ]);
                        },
                        
                        //DESCLASSIFICAR CANDIDATO
                        'desclassificar-admin' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Desclassificar candidato'),
                                         'data' => [
                                                   'confirm' => 'Você tem certeza que deseja <b style="color: red;">DESCLASSIFICAR</b> esse candidato?',
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
                ['content'=>'Detalhes de Curriculos Pré-Aprovados', 'options'=>['colspan'=>13, 'class'=>'text-center warning']],
                ['content'=>'Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']],
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de curriculos pré-aprovados pelo GGP</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>




</div>

