<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnexosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$session = Yii::$app->session;
$processo_id = $session['sess_processo'];

$this->title = 'Anexos';
$this->params['breadcrumbs'][] = ['label' => 'Processos Seletivos', 'url' => ['processo-seletivo/index']];
$this->params['breadcrumbs'][] = ['label' => $processo_id, 'url' => ['processo-seletivo/view', 'id' => $processo_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="anexos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Inserir Anexo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                         'label'=>'Arquivos',
                         'format'=>'raw',
                         'value' => function($model, $key, $index){
                             $url = "http://localhost/contratacao/web/" . $model->anexo;
                             return Html::a($model->anexo, $url, ['target'=> '_blank']); 
                         }
            ],


            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
