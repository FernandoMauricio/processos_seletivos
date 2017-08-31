<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

?>
<div class="etapas-processo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->etapa_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->etapa_id], [
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
            'etapa_id',
            'processo_id',
            'etapa_cargo',
            'etapa_data',
            'etapa_atualizadopor',
            'etapa_dataatualizacao',
            'etapa_situacao',
        ],
    ]) ?>

</div>
