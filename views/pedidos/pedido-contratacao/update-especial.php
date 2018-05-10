<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidocontratacao\PedidoContratacao */

$this->title = 'Atualizar Pedido Contratação (Especial) : ' . $model->pedcontratacao_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem Pedidos de Contratação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pedcontratacao_id];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="pedido-contratacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('especial/_form', [
        'model' => $model,
    	'contratacoes' => $contratacoes,
    	'processo' => $processo,
    	'modelsItens' => (empty($modelsItens)) ? [new PedidocontratacaoItens] : $modelsItens,
    ]) ?>

</div>
