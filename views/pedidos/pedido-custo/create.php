<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\pedidos\PedidoCusto */

$this->title = 'Create Pedido Custo';
$this->params['breadcrumbs'][] = ['label' => 'Pedido Custos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-custo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contratacao' => $contratacao,
    	'contratacoes' => $contratacoes,
    	'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
    ]) ?>

</div>
