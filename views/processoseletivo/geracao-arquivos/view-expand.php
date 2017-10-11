<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="geracao-arquivos-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gerarq_id',
            'processo.numeroEdital',
            'etapasprocesso.etapa_cargo',
            'gerarq_titulo',
            'gerarq_documentos:ntext',
            'gerarq_emailconfirmacao:email',
             [ 
              'attribute' => 'gerarq_datarealizacao',
              'value' => date("d/m/Y",  strtotime($model->gerarq_datarealizacao)),
             ],
             [ 
              'attribute' => 'gerarq_horarealizacao',
              'value' => date("H:i",  strtotime($model->gerarq_horarealizacao)),
             ],
            'gerarq_local',
            'gerarq_endereco',
            'gerarq_fase',
            'gerarq_tempo',
            'gerarq_responsavel',
        ],
    ]) ?>

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12"> Listagem de Candidatos</th></tr>
              <tr>
                <th>#</th>
                <th>Nome Completo</th>
                <?php echo $model->gerarq_perfil == 1 ? '<th>Horario</th>' : ''; ?>
                <?php echo $model->gerarq_perfil == 1 ? '<th>Tema da Aula</th>' : ''; ?>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php
                foreach ($modelsItens as $i => $candidato): ?>
                  <td><?= $i+=1;?></td>
                  <td><span class="text-uppercase"><?= $candidato->gerarqitens_candidato; ?></span></td>
                  <?php echo $model->gerarq_perfil == 1 ? '<td> '.$candidato->gerarqitens_horario.' </td>' : ''; ?>
                  <?php echo $model->gerarq_perfil == 1 ? '<td> '.$candidato->gerarqitens_tema.' </td>' : ''; ?>
            </tr>
              <?php endforeach; ?>
            </tbody>
           </table>

</div>
