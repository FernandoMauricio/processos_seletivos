<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

$this->title = 'Atualizar Etapas do Processo: ' . $model->etapa_id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Processos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->etapa_id, 'url' => ['view', 'id' => $model->etapa_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="etapas-processo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
   		<?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Retornar', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['view', 'id' => $model->etapa_id], ['class' => 'btn btn-info', 'target'=>'_blank']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'itens' => $itens,
        'selecionadores' => $selecionadores,
    ]) ?>

</div>
