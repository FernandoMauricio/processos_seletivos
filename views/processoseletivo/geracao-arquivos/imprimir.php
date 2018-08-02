<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\processoseletivo\geracaoarquivo\GeracaoArquivos */

$this->title = $model->gerarq_id;
$this->params['breadcrumbs'][] = ['label' => 'Geracao Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
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
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5><?= $model->gerarq_titulo ?></h5></td></tr>
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5><u>PS <?= $model->processo->numeroEdital ?></u></h5></td></tr>
    <tr><td width="5%"></td><td width="90%" style="text-align: center;"><h5 class="text-uppercase"><?= $model->gerarq_fase ?></h5></td></tr>
</table>

<table class="table table-condensed table-hover">
    <tr><td width="1%"><b>Data:</b></td><td width="99%" color="red"><?= date('d/m/Y', strtotime($model->gerarq_datarealizacao)) . strftime('(%A)', strtotime($model->gerarq_datarealizacao)); ?></td></tr>
    <tr><td width="1%"><b>Horário:</b></td><td color="red" width="99%">Vide abaixo</td></tr>
    <tr><td width="1%"><b>Local:</b></td><td width="99%"><?= $model->gerarq_local ?></td></tr>
    <tr><td width="1%"><b>Endereço:</b></td> <td width="99%"><?= $model->gerarq_endereco ?></td></tr>
    <tr><td width="1%"><b>Fase:</b></td><td width="99%"><?= $model->gerarq_fase ?></td></tr>
    <?= $model->gerarq_perfil == 1 ? '<tr><td width="1%"><b>Tempo:</b></td><td width="99%">'.$model->gerarq_tempo.'</td></tr>' : ''; ?>
    <tr><td width="1%"><b>Responsável:</b></td><td width="99%" class="text-capitalize"><?= $model->gerarq_responsavel ?></td></tr>
    <tr><td width="1%"><b>Observação:</b></td><td width="99%" class="text-capitalize"><?= $model->gerarq_observacao ?></td></tr>
</table>

<div><b color="red"><u>OBRIGATÓRIO:</u></b>
    <h5 style="margin-left: 25px"><b>1. APRESENTAR OS SEGUINTES DOCUMENTOS:</b></h5>
        <ul>
            <?php
                $array = explode(',', $model->gerarq_documentos);
                foreach ($array as $valores) {
                  echo '<li>' .$valores. ';</li>';
                }
            ?>
        </ul><br / >
    <h5 style="margin-left: 25px"><b>2. TODOS OS CANDIDATOS SELECIONADOS DEVEM ENVIAR E-MAIL CONFIRMANDO PRESENÇA PARA: </b><u color="#0000FF"><?= $model->gerarq_emailconfirmacao ?></u></h5>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th><font size="2">#</font></th>
      <th><font size="2">Nome Completo</font></th>
      <th><font size="2">Horario</font></th>
      <?php echo $model->gerarq_perfil == 1 ? '<th><font size="2"> Tema da Aula</font></th>' : ''; ?>
    </tr>
  </thead>
  <tbody>
     <?php foreach ($modelsItens as $i => $candidato): ?>
  <tr>
        <td><font size="2"><?= $i+=1;?></font></td>
        <td><font size="2" class="text-uppercase"><?= $candidato->gerarqitens_candidato; ?></font></td>
        <td><font size="2"><?= date('H:i', strtotime($candidato->gerarqitens_horario)) ?></font></td>
        <?php echo $model->gerarq_perfil == 1 ? '<td><font size="2"> '.$candidato->gerarqitens_tema.' </font></td>' : ''; ?>
  </tr>
    <?php endforeach; ?>
  </tbody>
 </table>

</div>
