<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcessoSeletivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Processos Seletivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-seletivo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Processo Seletivo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descricao',
            'data',
            'numeroEdital',
            'objetivo:ntext',
            // 'status',
            // 'situacao_id',
            // 'modalidade_id',
            // 'data_encer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
