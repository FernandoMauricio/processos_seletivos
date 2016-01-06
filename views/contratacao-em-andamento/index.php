<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'data_solicitacao',
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
            // 'subistituicao',
            // 'periodo',
            // 'tempo_periodo',
            // 'aumento_quadro',
            // 'nome_substituicao',
            // 'deficiencia',
            // 'obs_deficiencia:ntext',
            // 'data_ingresso',
            // 'fundamental_comp',
            // 'fundamento_inc',
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
            'contentOptions' => ['style' => 'width: 320px;'],
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
                return Html::a('<span class="glyphicon glyphicon-remove"></span> Enviar para Correção', $url, [
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

        ],
    ]); ?>

</div>
