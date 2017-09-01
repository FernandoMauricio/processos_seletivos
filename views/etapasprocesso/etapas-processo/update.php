<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

$this->title = 'Update Etapas Processo: ' . $model->etapa_id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Processos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->etapa_id, 'url' => ['view', 'id' => $model->etapa_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="etapas-processo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itens' => $itens,
        'selecionadores' => $selecionadores,
    ]) ?>

</div>
