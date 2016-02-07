<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Candidatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'edital',
            'numeroInscricao',
            'cargo',
            'nome',
            'cpf',
            //'datanascimento',
            'idade',
            // 'sexo',
            // 'email:email',
            // 'emailAlt:email',
            // 'telefone',
            // 'telefoneAlt',
            // 'data',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>

</div>
