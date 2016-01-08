<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProcessoSeletivo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Processo Seletivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-seletivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id, 'modalidade_id' => $model->modalidade_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id, 'modalidade_id' => $model->modalidade_id], [
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
            'id',
            'descricao',
            'data',
            'data_encer',
            'numeroEdital',
            'objetivo:ntext',
            'status_id',
            'situacao_id',
            'modalidade_id',
            
        ],
    ]) ?>

</div>
