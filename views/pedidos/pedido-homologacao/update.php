<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacao */

$this->title = 'Atualizar Pedido de Homologação: ' . $model->homolog_id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos de Homologações', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->homolog_id, 'url' => ['view', 'id' => $model->homolog_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="pedido-homologacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contratacoes' => $contratacoes,
        'modelsItens' => $modelsItens,
    ]) ?>

</div>
