<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContratacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitação de Contratação';
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>
<div class="contratacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Contratação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_solicitacao',
            'colaborador',
            'unidade',
            [
                'attribute' => 'situacao_id',
                'value' => 'situacao.descricao',
            ],
            // 'quant_pessoa',
            // 'motivo:ntext',
            // 'subistituicao',
            // 'periodo',
            // 'tempo_periodo',
            // 'aumento_quadro',
            // 'nome_substituicao',
            // 'data_ingresso',
            // 'deficiencia',
            // 'obs_deficiencia:ntext',
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
            // 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
