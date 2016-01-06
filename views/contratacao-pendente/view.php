<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contratacao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contratacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'data_solicitacao',
            'hora_solicitacao',
            'cod_colaborador',
            'colaborador',
            'cod_unidade_solic',
            'unidade',
            'quant_pessoa',
            'motivo:ntext',
            'subistituicao',
            'periodo',
            'tempo_periodo',
            'aumento_quadro',
            'nome_substituicao',
            'deficiencia',
            'obs_deficiencia:ntext',
            'data_ingresso',
            'fundamental_comp',
            'fundamento_inc',
            'medio_comp',
            'medio_inc',
            'tecnico_comp',
            'tecnico_inc',
            'tecnico_area',
            'superior_comp',
            'superior_inc',
            'superior_area',
            'pos_comp',
            'pos_inc',
            'pos_area',
            'dominio_atividade:ntext',
            'windows',
            'word',
            'excel',
            'internet',
            'experiencia',
            'experiencia_tempo',
            'experiencia_atividade',
            'jornada_horas',
            'jornada_obs:ntext',
            'principais_atividades:ntext',
            'recrutamento_id',
            'selec_curriculo',
            'selec_dinamica',
            'selec_prova',
            'selec_entrevista',
            'selec_teste',
            'situacao_id',
        ],
    ]) ?>

</div>
