<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */

$this->title = 'Detalhes ';
$this->params['breadcrumbs'][] = ['label' => 'Curriculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculos-view">

    <h1><?= Html::encode($this->title) . '<small>Informações do Candidato</small>'  ?></h1>

<?php
    echo Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['/curriculos/imprimir','id' => $model->cv_id], [
    'class'=>'btn btn-info', 
    'target'=>'_blank',
    'data-pjax' => 0, 
    'data-toggle'=>'tooltip', 
    'title'=>' Clique aqui para gerar um arquivo PDF'
]);

?>
<p></p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cv_id',
            'cv_numeroEdital:ntext',
            'cv_cargo:ntext',
            'cv_nome:ntext',
            [
                'attribute' => 'cv_datanascimento',
                'format' => ['date', 'php:d/m/Y'],
            ],
            'cv_email:ntext',
            'cv_telefone',
            //'cv_resumocv:ntext',
            [
                'attribute' => 'cv_data',
                'format' => ['date', 'php:d/m/Y'],
            ],
            'cv_email2:ntext',
            'cv_telefone2',
        ],
    ]) ?>

        <?= $this->render('/curriculos/pdf', [
        'model' => $model,
    ]) ?>


</div>
