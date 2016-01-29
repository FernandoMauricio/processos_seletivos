<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosEnderecoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Curriculos Enderecos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-endereco-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Curriculos Endereco', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'endereco',
            'numero_end',
            'bairro',
            'cep',
            // 'cidade',
            // 'estado',
            // 'curriculos_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
