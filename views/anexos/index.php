<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnexosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anexos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anexos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anexos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'anexo',
            'processo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
