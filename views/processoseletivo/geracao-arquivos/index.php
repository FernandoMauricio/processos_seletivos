<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\processoseletivo\GeracaoArquivosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geracao Arquivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geracao-arquivos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Geracao Arquivos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'gerarq_id',
            'processo_id',
            'curriculos_id',
            'etapasprocesso_id',
            'gerarq_titulo',
            // 'gerarq_documentos:ntext',
            // 'gerarq_emailconfirmacao:email',
            // 'gerarq_datarealizacao',
            // 'gerarq_horarealizacao',
            // 'gerarq_local',
            // 'gerarq_endereco',
            // 'gerarq_fase:ntext',
            // 'gerarq_tempo',
            // 'gerarq_responsavel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
