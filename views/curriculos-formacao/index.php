<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosFormacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Curriculos Formacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-formacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Curriculos Formacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fundamental_comp',
            'medio_comp',
            'superior_comp',
            'superior_area',
            // 'pos',
            // 'pos_area',
            // 'mestrado',
            // 'mestrado_area',
            // 'doutorado',
            // 'doutorado_area',
            // 'estuda_atualmente',
            // 'estuda_curso',
            // 'estuda_turno_mat',
            // 'estuda_turno_vesp',
            // 'estuda_turno_not',
            // 'curriculos_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
