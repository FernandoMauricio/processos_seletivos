<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pedidos\pedidocontratacao\PedidoContratacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido Contratacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-contratacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pedido Contratacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pedcontratacao_id',
            'pedcontratacao_assunto',
            'pedcontratacao_recursos',
            'pedcontratacao_valortotal',
            'pedcontratacao_data',
            // 'pedcontratacao_aprovadorggp',
            // 'pedcontratacao_situacaoggp',
            // 'pedcontratacao_dataaprovacaoggp',
            // 'pedcontratacao_aprovadordad',
            // 'pedcontratacao_situacaodad',
            // 'pedcontratacao_dataaprovacaodad',
            // 'pedcontratacao_responsavel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
