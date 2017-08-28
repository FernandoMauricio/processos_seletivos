<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pedidos\AprovacoesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aprovações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aprovacoes-index">

<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'aprov_id',
            'aprov_descricao',
            'aprov_cargo',
            'aprov_observacao',
            'aprov_area',
            // 'aprov_status',

           ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
        ],
    ]); ?>
</div>
