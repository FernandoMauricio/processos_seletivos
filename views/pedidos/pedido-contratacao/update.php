<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocontratacao\PedidoContratacao */

$this->title = 'Update Pedido Contratacao: ' . $model->pedcontratacao_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Contratacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pedcontratacao_id, 'url' => ['view', 'id' => $model->pedcontratacao_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-contratacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
