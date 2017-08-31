<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\etapasprocesso\EtapasProcesso */

$this->title = $model->etapa_id;
$this->params['breadcrumbs'][] = ['label' => 'Etapas Processos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-processo-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <div class="panel-body">
    <div class="row">
          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 1: Informações</th></tr>
            </thead>
            <tbody>
            <tr>
                  <th scope="row">Cód:</th>
                  <td><?= $model->etapa_id ?></td>
                  <th scope="row">Unidade:</th>
            </tr>
            <tr>
                  <th scope="row">Recursos:</th>
                  <td><?= $model->processo_id ?></td>
                  <th scope="row">Valor Total:</th>
                  <td colspan="3"><?= $model->etapa_cargo ?></td>
                  <th scope="row">Responsável:</th>
                  <td><?= $model->etapa_atualizadopor ?></td>
            </tr>
            </tbody>
          </table>
                        <!-- ITENS DOS CLASSIFICADOS E AS ETAPAS DO PROCESSO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Classificados / Etapas do Processo</th></tr>
              <tr>
                <th>Inscrição</th>
                <th>Nome Completo</th>
                <th>Análise de Perfil</th>
                <th>Avaliação Comportamental</th>
                <th>Entrevista</th>
                <th>Pontuação Total</th>
                <th>Classificação</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php 
                foreach ($itens as $i => $etapa): ?>
                  <td><?= $etapa->curriculos->numeroInscricao; ?></td>
                  <td><?= $etapa->curriculos->nome; ?></td>
                  <td><?= $etapa->itens_analisarperfil; ?></td>
                  <td><?= $etapa->itens_comportamental; ?></td>
                  <td><?= $etapa->itens_entrevista; ?></td>
                  <td><?= $etapa->itens_pontuacaototal; ?></td>
                  <td><?= $etapa->itens_classificacao; ?></td>
            </tr>
              <?php endforeach; ?>

            </tbody>
           </table>

    </div>
  </div>
</div>
