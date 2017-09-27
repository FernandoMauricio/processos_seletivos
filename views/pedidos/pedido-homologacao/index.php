<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pedidos\pedidohomologacao\PedidoHomologacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos de Homologações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-homologacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Novo Pedido de Homologação', ['value'=> Url::to('index.php?r=pedidos/pedido-homologacao/gerar-pedido-homologacao'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Geração do Processo de Homologação</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'homolog_id',
            'contratacao_id',
            'homolog_cargo',
            'homolog_salario',
            'homolog_encargos',
            // 'homolog_total',
            // 'homolog_tipo',
            // 'homolog_unidade',
            // 'homolog_motivo',
            // 'homolog_sintese:ntext',
            // 'homolog_validade',
            // 'homolog_aprovadorggp',
            // 'homolog_situacaoggp',
            // 'homolog_dataaprovacaoggp',
            // 'homolog_aprovadordad',
            // 'homolog_situacaodad',
            // 'homolog_dataaprovacaodad',
            // 'homolog_responsavel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
