<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */

$this->title = $model->gerarq_id;
$this->params['breadcrumbs'][] = ['label' => 'Geracao Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geracao-arquivos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gerarq_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gerarq_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gerarq_id',
            'processo_id',
            'curriculos_id',
            'etapasprocesso_id',
            'gerarq_titulo',
            'gerarq_documentos:ntext',
            'gerarq_emailconfirmacao:email',
            'gerarq_datarealizacao',
            'gerarq_horarealizacao',
            'gerarq_local',
            'gerarq_endereco',
            'gerarq_fase:ntext',
            'gerarq_tempo',
            'gerarq_responsavel',
        ],
    ]) ?>

</div>
