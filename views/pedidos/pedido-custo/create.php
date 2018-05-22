<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocusto\PedidoCusto */

$this->title = 'Novo Pedido de Custo';
$this->params['breadcrumbs'][] = ['label' => 'Listagem Pedidos de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-custo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'contratacoes' => $contratacoes,
    	'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
    ]) ?>

</div>
