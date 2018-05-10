<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocusto\PedidoCusto */

$this->title = 'Atualizar Pedido Custo: ' . $model->custo_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem Pedidos de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->custo_id];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="pedido-custo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'contratacoes' => $contratacoes,
    	'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
    ]) ?>

</div>
