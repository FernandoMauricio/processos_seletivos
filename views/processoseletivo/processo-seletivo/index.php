<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use app\models\processoseletivo\Situacao;


/* @var $this yii\web\View */
/* @var $searchModel app\models\processoseletivo\ProcessoSeletivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Processos Seletivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-seletivo-index">


<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Processo Seletivo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php

$gridColumns = [

            'numeroEdital',
            'descricao',
            'objetivo:ntext',

            [
                'attribute'=>'situacao_id', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->situacao->descricao;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Situacao::find()->orderBy('descricao')->asArray()->all(), 'descricao', 'descricao'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                    'filterInputOptions'=>['placeholder'=>'Selecione a Situação'],
            ],

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status_id',
                'vAlign'=>'middle'
            ], 


                                ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {edital} {anexos} {adendos} {resultados}',
                                'contentOptions' => ['style' => 'width: 40%'],
                                'buttons' => [


                                //VISUALIZAR
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },

                                //EDITAR
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> ', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },


                                //EDITAIS
                                'edital' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Editais', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                               
                                    ]);
                                },


                                //ANEXOS
                                'anexos' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Anexos', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                                    ]);
                                },

                                //ADENDOS
                                'adendos' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Adendos', $url, [
                                                'class'=>'btn btn-primary btn-xs',
                                    ]);
                                },

                                //RESULTADOS
                                'resultados' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-plus"></span> Resultados', $url, [
                                                'class'=>'btn btn-primary btn-xs',
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
                ['content'=>'Detalhes do Processo Seletivo', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
                ['content'=>'Área de Ações', 'options'=>['colspan'=>8, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Processos Seletivos</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

