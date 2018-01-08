<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\processoseletivo\CargosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cargos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargos-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Cargo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php

$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            'descricao',
            [
                'label' => 'Níveis',
                'encodeLabel' => false,
                'attribute' => 'areasLabel',
                'width'=>'5%',
                'value' => function($model) {
                        return implode(', ', \yii\helpers\ArrayHelper::map($model->areasCargos, 'id', 'area.descricao'));
                    },
            ],
            'ch_semana',
            [
                'format' => 'Currency',
                'attribute' => 'salario_valorhora',
            ],
            [
                'format' => 'Currency',
                'attribute' => 'salario',
            ],
            [
                'format' => 'Currency',
                'attribute' => 'salario_1sexto',
            ],
            // [
            //     'format' => 'Currency',
            //     'attribute' => 'salario_produtividade',
            // ],
            [
                'format' => 'Currency',
                'attribute' => 'salario_6horasfixas',
            ],
            [
                'format' => 'Currency',
                'attribute' => 'salario_1sextofixas',
            ],
            [
                'format' => 'Currency',
                'attribute' => 'salario_bruto',
            ],
            [
                'format' => 'Currency',
                'attribute' => 'encargos',
            ],
            [
                'format' => 'Currency',
                'attribute' => 'valor_total',
            ],
            'descricao_cargo:ntext',
            'homologacao',
            [
                'attribute' => 'data_homologacao',
                'format' => ['datetime', 'php:d/m/Y'],
                'width' => '190px',
                'hAlign' => 'center',
                'filter'=> DatePicker::widget([
                'model' => $searchModel, 
                'attribute' => 'data_homologacao',
                'pluginOptions' => [
                     'autoclose'=>true,
                     'format' => 'yyyy-mm-dd',
                    ]
                ])
            ],
            [
            
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status', 
                'vAlign'=>'middle'
            ], 
                        
            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {homologar}',
                        'contentOptions' => ['style' => 'width: 7%;'],
                        'buttons' => [

                        //VISUALIZAR/IMPRIMIR
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url, [
                                        'class'=>'btn btn-default btn-xs',
                                        'title' => Yii::t('app', 'Atualizar'),
                       
                            ]);
                        },

                        //HOMOLOGAR - Acesso somente para o Gerente do GGP 7 - ggp / 1 - responsavel setor
                        'homologar' => function ($url, $model) {
                            $session = Yii::$app->session;
                           return  $session['sess_codunidade'] == 7 && $session['sess_responsavelsetor'] == 1  ?  Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                         'class'=>'btn btn-success btn-xs',
                                         'title' => Yii::t('app', 'Homologar Cargo'),
                                         'data' =>  [
                                                         'confirm' => 'Você tem CERTEZA que deseja <b>HOMOLOGAR</b> esse item?',
                                                         'method' => 'post',
                                                    ],
                                        ])
                                     : 
                                    '';
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
                ['content'=>'Detalhes de Cargos Cadastrados', 'options'=>['colspan'=>16, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Cargos</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>
