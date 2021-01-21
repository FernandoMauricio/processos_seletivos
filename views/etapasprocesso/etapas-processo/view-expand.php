<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

?>
<div class="etapas-processo-view">

  <div class="panel-body">
    <div class="row">
          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 1: Informações</th></tr>
            </thead>
            <tbody>
            <tr>
                  <th scope="row">Documento de Abertura:</th> <td><?= $model->processo->numeroEdital ?></td>
                    
                  <th scope="row">Cargo:</th> <td colspan="2"><?= $model->etapa_cargo ?></td>
                    
                  <th scope="row">Atualizado por:</th>  <td colspan="2"><?= $model->etapa_atualizadopor ?></td>
                   
                  <th scope="row">Data Atualização:</th>  <td><?= date('d/m/Y à\s H:i', strtotime($model->etapa_dataatualizacao)); ?></td>
            </tr>
            <tr>
                  <th scope="row">Data da Realização:</th> <td colspan="2"><?= $model->etapa_datarealizacao ?></td>
                    
                  <th scope="row">Local:</th> <td><?= $model->etapa_local ?></td>
                    
                  <th scope="row">Cidade:</th> <td colspan="2"><?= $model->etapa_cidade ?></td>
                    
                  <th scope="row">Estado:</th> <td><?= $model->etapa_estado ?></td>
            </tr>
            <tr>
                  <th scope="row">Nome dos Selecionadores:</th> <td colspan="7"><?= $model->etapa_selecionadores ?></td>
                    
                  <th scope="row">Situação:</th> <td colspan="2"><?= $model->etapa_situacao ?></td>
            </tr>
            <tr>
                  <th scope="row">Cronograma das Etapas:</th> <td colspan="9"><textarea name="textarea" rows="3" cols="130" readonly><?= $model->etapa_observacao ?></textarea></td>
            </tr>

            </tbody>
          </table>
                        <!-- ITENS DOS CLASSIFICADOS E AS ETAPAS DO PROCESSO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Classificados / Etapas do Processo</th></tr>
              <tr>
                <th>Contato Confirmado?</th>
                 <th>Nº</th>
                <th>Inscrição</th>
                <th>Nome Completo</th>
                <th>Escrita</th>
                <th>Comportamental</th>
                <?php echo $model->etapa_perfil == 1 ? '<th>Didática</th>' : ''; ?>
                <th>Entrevista</th>
                <th>Prática</th>
                <th>Pontuação Total</th>
                <th>Classificação</th>
                <th>Destino</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php 
                  $cont = 1;
                foreach ($etapasItens as $i => $etapa): ?>
                  <td><?= $etapa->itens_confirmacaocontato == 1 ? ' <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #54c51b;"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: #a94442;"></span>'; ?></td>
                  <td><?php echo $cont++ ?></td>
                  <td><?= $etapa->curriculos->numeroInscricao; ?></td>
                  <td><span class="text-uppercase"><?= $etapa->curriculos->nome; ?></span></td>
                  <td style="width: 80px;"><?= $etapa->itens_escrita; ?></td>
                  <td style="width: 80px;"><?= $etapa->itens_comportamental; ?></td>
                  <?php echo $model->etapa_perfil == 1 ? '<td style="width: 80px;"> '.$etapa->itens_didatica.' </td>' : ''; ?>
                  <td style="width: 80px;"><?= $etapa->itens_entrevista; ?></td>
                  <td style="width: 80px;"><?= $etapa->itens_pratica; ?></td>
                  <td style="width: 80px;"><?= $etapa->itens_pontuacaototal; ?></td>
                  <td><?= $etapa->itens_classificacao; ?></td>
                  <td><?= $etapa->itens_localcontratacao; ?></td>
            </tr>
              <?php endforeach; ?>
            </tbody>
           </table>
    </div>
  </div>
</div>
