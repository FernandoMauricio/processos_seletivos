<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\PedidoCusto */

$this->title = 'Update Pedido Custo: ' . $model->custo_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Custos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->custo_id, 'url' => ['view', 'id' => $model->custo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-custo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
