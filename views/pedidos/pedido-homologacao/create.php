<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacao */

$this->title = 'Novo Pedido de Homologação';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos de Homologações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-homologacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contratacoes' => $contratacoes,
        'processo' => $processo,
    ]) ?>

</div>
