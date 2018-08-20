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

	<p>        
		<?= Html::a('<span class="glyphicon glyphicon-refresh"></span> Atualizar Candidatos', ['atualizar-candidatos', 'id' => $model->homolog_id],[
                'class' => 'btn btn-success',
                'data' =>[
                            'confirm' => 'Você tem <b>certeza</b> que deseja <b>atualizar</b> as informações dos candidatos?',
                            'method' => 'post',
                        ]
            ]) ?>
	</p>
    <?= $this->render('_form', [
        'model' => $model,
        'contratacoes' => $contratacoes,
        'modelsItens' => $modelsItens,
    ]) ?>

</div>
