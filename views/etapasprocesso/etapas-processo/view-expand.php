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
                  <th scope="row">Processo Seletivo:</th> <td><?= $model->processo->numeroEdital ?></td>
                    
                  <th scope="row">Cargo:</th> <td><?= $model->etapa_cargo ?></td>
                    
                  <th scope="row">Atualizado por:</th>  <td><?= $model->etapa_atualizadopor ?></td>
                   
                  <th scope="row">Data Atualização:</th>  <td><?= date('d/m/Y à\s H:i', strtotime($model->etapa_dataatualizacao)); ?></td>
            </tr>
            <tr>
                  <th scope="row">Data da Realização:</th> <td><?= $model->etapa_datarealizacao ?></td>
                    
                  <th scope="row">Local:</th> <td><?= $model->etapa_local ?></td>
                    
                  <th scope="row">Data da Realização:</th> <td><?= $model->etapa_cidade ?></td>
                    
                  <th scope="row">Local:</th> <td><?= $model->etapa_estado ?></td>
            </tr>
            </tbody>
          </table>
                        <!-- ITENS DOS CLASSIFICADOS E AS ETAPAS DO PROCESSO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Classificados / Etapas do Processo</th></tr>
              <tr>
                <th>Contato Confirmado?</th>
                <th>Inscrição</th>
                <th>Nome Completo</th>
                <th>Análise de Perfil</th>
                <th>Avaliação Comportamental</th>
                <th>Entrevista</th>
                <th>Pontuação Total</th>
                <th>Classificação</th>
                <th>Local Contratação</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php 
                foreach ($etapasItens as $i => $etapa): ?>
                  <td><?= $etapa->itens_confirmacaocontato == 1 ? ' <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #54c51b;"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: #a94442;"></span>'; ?></td>
                  <td><?= $etapa->curriculos->numeroInscricao; ?></td>
                  <td><?= $etapa->curriculos->nome; ?></td>
                  <td style="width: 80px;"><?= $etapa->itens_analisarperfil; ?></td>
                  <td style="width: 80px;"><?= $etapa->itens_comportamental; ?></td>
                  <td style="width: 80px;"><?= $etapa->itens_entrevista; ?></td>
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
