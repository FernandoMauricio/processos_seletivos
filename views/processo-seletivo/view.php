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
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'descricao',
            [
                'attribute' => 'data',
                'format' => ['date', 'php:d/m/Y'],
            ],
            [
                'attribute' => 'data_encer',
                'format' => ['date', 'php:d/m/Y'],
            ],
            'numeroEdital',
            'objetivo:ntext',
            [
            'label' => 'Situação',
            'attribute' => 'situacao.descricao',
            ],

            [
            'label' => 'Modalidade',
            'attribute' => 'modalidade.descricao',
            ],

            [
            'label' => 'Publicação no site',
            'attribute' => 'status.descricao',
            ],
     
        ],
    ]) ?>

        <?= $this->render('pdf', [
        'model' => $model,
        ]) ?>

</div>
