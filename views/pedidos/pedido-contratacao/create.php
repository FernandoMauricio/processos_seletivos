<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocontratacao\PedidoContratacao */

$this->title = 'Novo Pedido de Contratação';
$this->params['breadcrumbs'][] = ['label' => 'Listagem Pedidos de Contratação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-contratacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'contratacoes' => $contratacoes,
    	'processo' => $processo,
    	'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
    ]) ?>

</div>
