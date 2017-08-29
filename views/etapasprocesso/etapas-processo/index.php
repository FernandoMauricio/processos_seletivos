<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\etapasprocesso\EtapasProcessoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Etapas Processos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-processo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Criar Etapas do Processo', ['value'=> Url::to('index.php?r=etapasprocesso/etapas-processo/create'), 'class' => 'btn btn-primary', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Geração de Etapas do Processo</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'etapa_id',
            'processo_id',
            'etapa_cargo',
            'etapa_data',
            'etapa_atualizadopor',
            // 'etapa_dataatualizacao',
            // 'etapa_situacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
