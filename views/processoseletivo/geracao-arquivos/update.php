<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */

$this->title = 'Atualizar Resultado das Etapas: ' . $model->gerarq_id;
$this->params['breadcrumbs'][] = ['label' => 'Geração de Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gerarq_id];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="geracao-arquivos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('resultado-etapas/_form', [
        'model' => $model,
        'modelsItens' => $modelsItens,
    ]) ?>

</div>
