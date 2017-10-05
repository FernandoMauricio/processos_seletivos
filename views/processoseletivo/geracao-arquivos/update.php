<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */

$this->title = 'Update Geracao Arquivos: ' . $model->gerarq_id;
$this->params['breadcrumbs'][] = ['label' => 'Geracao Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gerarq_id, 'url' => ['view', 'id' => $model->gerarq_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="geracao-arquivos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
