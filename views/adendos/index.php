<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdendosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adendos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adendos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Adendos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'adendos',
            'processo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
