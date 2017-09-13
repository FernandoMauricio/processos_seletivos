<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocontratacao\PedidoContratacao */

$this->title = $model->pedcontratacao_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Contratacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-contratacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pedcontratacao_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pedcontratacao_id], [
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
            'pedcontratacao_id',
            'pedcontratacao_assunto',
            'pedcontratacao_recursos',
            'pedcontratacao_valortotal',
            'pedcontratacao_data',
            'pedcontratacao_aprovadorggp',
            'pedcontratacao_situacaoggp',
            'pedcontratacao_dataaprovacaoggp',
            'pedcontratacao_aprovadordad',
            'pedcontratacao_situacaodad',
            'pedcontratacao_dataaprovacaodad',
            'pedcontratacao_responsavel',
        ],
    ]) ?>

</div>
