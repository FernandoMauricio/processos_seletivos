<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Candidatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<?php

$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            'edital',
            'numeroInscricao',
            'cargo',
            'nome',
            'cpf',
            //'datanascimento',
            'idade',
            [
                'class'=>'kartik\grid\BooleanColumnCurriculos',
                'attribute'=>'classificado',
                'vAlign'=>'middle'
            ], 

// [
//     'attribute' => 'classificado',
//     'format' => 'raw',
//     'value' => function ($model, $index, $widget) {
//         return Html::checkbox('classificado[]', $model->classificado, ['value' => $index]);
//     },
// ],
            // 'sexo',
            // 'email:email',
            // 'emailAlt:email',
            // 'telefone',
            // 'telefoneAlt',
            // 'data',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
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
                ['content'=>'Detalhes de Curriculos Cadastrados', 'options'=>['colspan'=>9, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem de Curriculos</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>

</div>

