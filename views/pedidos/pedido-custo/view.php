<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\PedidoCusto */

$this->title = $model->custo_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Custos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-custo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->custo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->custo_id], [
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
            'custo_id',
            'custo_assunto',
            'custo_recursos',
            'custo_valortotal',
            'custo_data',
            'custo_aprovadorggp',
            'custo_situacaoggp',
            'custo_dataaprovacaoggp',
            'custo_aprovadordad',
            'custo_situacaodad',
            'custo_dataaprovacaodad',
            'custo_responsavel',
        ],
    ]) ?>

</div>
