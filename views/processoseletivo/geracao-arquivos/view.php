<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */

$this->title = $model->gerarq_id;
$this->params['breadcrumbs'][] = ['label' => 'Geracao Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geracao-arquivos-view">

<?php
    echo Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['imprimir','id' => $model->gerarq_id, 'modelsItens' => $modelsItens], [
            'class'=>'btn pull-right btn-info btn-lg', 
            'target'=>'_blank', 
            'data-toggle'=>'tooltip', 
            'title'=>' Clique aqui para gerar um arquivo PDF'
    ]);
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gerarq_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gerarq_id], [
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
            'gerarq_id',
            'processo_id',
            'etapasprocesso_id',
            'gerarq_titulo',
            'gerarq_documentos:ntext',
            'gerarq_emailconfirmacao:email',
            'gerarq_datarealizacao',
            'gerarq_horarealizacao',
            'gerarq_local',
            'gerarq_endereco',
            'gerarq_fase:ntext',
            'gerarq_tempo',
            'gerarq_responsavel',
        ],
    ]) ?>

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Candidatos</th></tr>
              <tr>
                <th>#</th>
                <th>Nome Completo</th>
                <th>Horario</th>
                <?php echo $model->gerarq_perfil == 1 ? '<th>Tema da Aula</th>' : ''; ?>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php
                foreach ($modelsItens as $i => $candidato): ?>
                  <td><?= $i+=1;?></td>
                  <td><span class="text-uppercase"><?= $candidato->gerarqitens_candidato; ?></span></td>
                  <td><?= $candidato->gerarqitens_horario; ?></td>
                  <?php echo $model->gerarq_perfil == 1 ? '<td> '.$candidato->gerarqitens_tema.' </td>' : ''; ?>
            </tr>
              <?php endforeach; ?>
            </tbody>
           </table>

</div>
