<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\Sistemas */

$this->title = $model->idsistema;
$this->params['breadcrumbs'][] = ['label' => 'Sistemas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sistemas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idsistema], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->idsistema], [
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
            'idsistema',
            'descricao',
            'status',
        ],
    ]) ?>

</div>
