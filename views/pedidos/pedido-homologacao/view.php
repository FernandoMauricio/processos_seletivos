<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacao */

$this->title = $model->homolog_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Homologacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-homologacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->homolog_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->homolog_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'homolog_id',
            'contratacao_id',
            'homolog_cargo',
            'homolog_salario',
            'homolog_encargos',
            'homolog_total',
            'homolog_tipo',
            'homolog_unidade',
            'homolog_motivo',
            'homolog_sintese:ntext',
            'homolog_validade',
            'homolog_aprovadorggp',
            'homolog_situacaoggp',
            'homolog_dataaprovacaoggp',
            'homolog_aprovadordad',
            'homolog_situacaodad',
            'homolog_dataaprovacaodad',
            'homolog_responsavel',
        ],
    ]) ?>

</div>
