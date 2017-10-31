<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */

$this->title = $model->gerarq_id;
$this->params['breadcrumbs'][] = ['label' => 'Geração de Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geracao-arquivos-view">

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->gerarq_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->gerarq_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja deletar este item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['imprimir','id' => $model->gerarq_id, 'modelsItens' => $modelsItens], [
            'class'=>'btn pull-right btn-info', 
            'target'=>'_blank', 
            'data-toggle'=>'tooltip', 
            'title'=>' Clique aqui para gerar um arquivo PDF'
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gerarq_id',
            'processo.numeroEdital',
            'etapasprocesso.etapa_cargo',
            'gerarq_titulo',
            [
                'attribute'=>'gerarq_documentos', 
                'visible' => $model->gerarq_tipo == 0 ? true : false,
            ],
            [
                'attribute'=>'gerarq_emailconfirmacao', 
                'visible' => $model->gerarq_tipo == 0 ? true : false,
            ],
            [ 
             'attribute' => 'gerarq_datarealizacao',
             'value' => date("d/m/Y",  strtotime($model->gerarq_datarealizacao)),
            ],
            [ 
             'attribute' => 'gerarq_horarealizacao',
             'value' => date("H:i",  strtotime($model->gerarq_horarealizacao)),
            ],
            [
                'attribute'=>'gerarq_local', 
                'visible' => $model->gerarq_tipo == 0 ? true : false,
            ],
            [
                'attribute'=>'gerarq_endereco', 
                'visible' => $model->gerarq_tipo == 0 ? true : false,
            ],
            [
                'attribute'=>'gerarq_fase', 
                'visible' => $model->gerarq_tipo == 0 ? true : false,
            ],
            [
                'attribute'=>'gerarq_tempo', 
                'visible' => $model->gerarq_perfil == 1 ? true : false,
            ],
            'gerarq_responsavel',
        ],
    ]) ?>

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12"> Listagem de Candidatos</th></tr>
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
                  <td><?= $candidato->gerarqitens_horario; ?> </td>
                  <?php echo $model->gerarq_perfil == 1 ? '<td> '.$candidato->gerarqitens_tema.' </td>' : ''; ?>
            </tr>
              <?php endforeach; ?>
            </tbody>
           </table>

</div>
