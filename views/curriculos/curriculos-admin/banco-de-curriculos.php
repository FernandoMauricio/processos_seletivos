<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Banco de Curriculos';
?>
<div class="curriculos-admin-index">

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
                    return Yii::$app->controller->renderPartial('view-expand', ['model'=>$model, 'curriculosEnderecos' => $model->curriculosEnderecos, 'curriculosFormacaos' => $model->curriculosFormacaos, 'curriculosComplementos' => $model->curriculosComplementos, 'curriculosEmpregos' => $model->curriculosEmpregos]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'], 
                'expandOneOnly'=>true
            ],

            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute'=>'edital',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'numeroInscricao',
            'options' => ['width' => '20px'],
            ],

            [
            'attribute'=>'cargo',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'nome',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'cpf',
            'options' => ['width' => '140px'],
            ],

            [
            'attribute'=>'idade',
            'options' => ['width' => '50px'],
            ],

            [
            'attribute'=>'email',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'emailAlt',
            'options' => ['width' => '300px'],
            ],

            [
            'attribute'=>'telefone',
            'options' => ['width' => '300px'],
            ],

            [
                'attribute' => 'sexo',
                'value' => function ($data) {
                                                if($data->sexo == 0)
                                                {
                                                    return 'Feminino';
                                                }else{
                                                    return 'Masculino';
                                                }
                                            },
            ],
 
            [
                'attribute' => 'classificado',
                'value' => 'situacaoCandidato.sitcan_descricao'
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
                ['content'=>'Detalhes de Curriculos Cadastrados', 'options'=>['colspan'=>13, 'class'=>'text-center warning']], 
            ],
        ]
    ],
        'hover' => true,
        'panel' => [
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Listagem do Banco de Curriculos</h3>',
        'persistResize'=>false,
    ],
]);
    ?>
    <?php Pjax::end(); ?>




</div>

