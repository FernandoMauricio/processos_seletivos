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


$this->title = 'Listagem de Candidatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-index">

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}


?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Enviar Pré-Selecionados', ['value'=> Url::to('index.php?r=curriculos-admin/pre-selecionados'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Defina o edital a ser enviado os Curriculos Pré-Selecionados:</h4>',
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
                    return Yii::$app->controller->renderPartial('/curriculos-admin/view-expand', ['model'=>$model, 'curriculosEnderecos' => $model->curriculosEnderecos, 'curriculosFormacaos' => $model->curriculosFormacaos, 'curriculosComplementos' => $model->curriculosComplementos, 'curriculosEmpregos' => $model->curriculosEmpregos]);
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

            ['class' => 'yii\grid\ActionColumn',
                        'template' => '{imprimir} {aguardando-envio-gerencia-imediata} {desclassificar}',
                        'contentOptions' => ['style' => 'width: 7%;'],
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

                        //VISUALIZAR
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', $url, [
                                        'class'=>'btn btn-primary btn-xs',
                                        'title' => Yii::t('app', 'Visualizar candidato'),
                       
                            ]);
                        },

                        //CLASSIFICAR CANDIDATO
                        'aguardando-envio-gerencia-imediata' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> ', $url, [
                                        'class'=>'btn btn-success btn-xs',
                                        'title' => Yii::t('app', 'Aguardando Envio Gerência Imediata'),
                                         'data' => [
                                                   'method' => 'post',

                                                   ],
                            ]);
                        },
                        
                        //DESCLASSIFICAR CANDIDATO
                        'desclassificar' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span> ', $url, [
                                        'class'=>'btn btn-danger btn-xs',
                                        'title' => Yii::t('app', 'Desclassificar candidato'),
                                         'data' => [
                                                   //'confirm' => 'Você tem certeza que deseja ENVIAR PARA CORREÇÃO essa Solicitação de Contratação?',
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
    'rowOptions' =>function($model){
                if($model->classificado == '0') //Desclassificado
                {
                    return['class'=>'danger'];                        
                }elseif ($model->classificado == '1') {//Classificado
                    return['class'=>'success']; 
                }elseif ($model->classificado == '2') {//Pré-Selecionado pela Gerência Imediata
                    return['class'=>'success']; 
                }elseif ($model->classificado == '3') {//Aguardando Envio para Gerência Imediata
                    return['class'=>'warning']; 
                }elseif ($model->classificado == '4') {//Enviado para Gerência imediata
                    return['class'=>'info']; 
                }

    },
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
                ['content'=>'Ações', 'options'=>['colspan'=>1, 'class'=>'text-center warning']],
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

