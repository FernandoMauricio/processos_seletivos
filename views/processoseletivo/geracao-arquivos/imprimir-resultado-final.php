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

<table class="table table-condensed table-hover">
    <tr> 
      <td width="5%"><img width="20%" src="css/img/logo.png"></td>
      <td width="90%" style="text-align: center;">
          <h5><b>SERVIÇO NACIONAL DE APRENDIZAGEM COMERCIAL - SENAC</b></h5>
          <h5><b>DEPARTAMENTO REGIONAL DO AMAZONAS – DR/AM</b></h5>
          <h5>GERÊNCIA DE GESTÃO DE PESSOAS – GGP</h5>
      </td>
    </tr>
</table><br /><br />

<table class="table table-condensed table-hover">
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5><b><?= $model->gerarq_titulo ?></b></h5></td></tr>
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5 class="text-uppercase"><b>PARA <?= $model->etapasprocesso->etapa_cargo ?></b></h5></td></tr>
</table>

<table class="table table-condensed table-hover">
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5 class="text-uppercase"><u>PROCESSO SELETIVO <?= $model->processo->numeroEdital ?></u></h5></td></tr>
</table><br /><br />

<table class="table table-condensed table-hover">
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5><b> LISTA DE CANDIDATOS CLASSIFICADOS</b></h5></td></tr>
</table>

<table class="table table-bordered">
  <thead>
    <tr>
      <th><font size="2">#</font></th>
      <th><font size="2">CANDIDATOS</font></th>
      <th><font size="2">CLASSIFICAÇÃO</font></th>
    </tr>
  </thead>
  <tbody>
     <?php foreach ($modelsItens as $i => $candidato): ?>
  <tr>
        <td><font size="2"><?= $i+=1;?></font></td>
        <td><font size="2" class="text-uppercase"><?= $candidato->gerarqitens_candidato; ?></font></td>
        <td><font size="2" class="text-uppercase"><?= $candidato->gerarqitens_classificacao; ?></font></td>
  </tr>
    <?php endforeach; ?>
  </tbody>
 </table><br /><br />

<h5 style="margin-left: 25px">A contratação dos(as) candidatos(as) aprovados(as) dependerá da disponibilidade de
vagas no quadro do SENAC/AM. (Item 1.5 do PS <?= $model->processo->numeroEdital ?>).</h5>
<h5 style="margin-left: 25px">Por ocasião da Contratação, o(a) candidato(a) deverá entregar a documentação
relacionada no <b>item 11.4</b> do mesmo Documento.</h5>

</div>
