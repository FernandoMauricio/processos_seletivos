<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\processoseletivo\geracaoarquivo\GeracaoArquivosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geração de Arquivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geracao-arquivos-index">

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
    <h1><?= Html::encode($this->title) . ' <small>Resultados das Etapas / Resultados Finais</small>' ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Criar Geração de Arquivo', ['value'=> Url::to('index.php?r=processoseletivo/geracao-arquivos/create'), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>Geração de Arquivos</h4>',
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

            'gerarq_id',
            [
                'attribute' => 'processo_id',
                'value' => 'processo.numeroEdital',
            ],
            [
                'attribute' => 'etapasprocesso_id',
                'value' => 'etapasprocesso.etapa_cargo',
            ],
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
