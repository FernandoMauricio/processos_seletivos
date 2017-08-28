<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\PedidoCusto */

$this->title = $model->custo_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem Pedidos de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-custo-view">

<table width="100%" border="0">
  <tr> 
    <td width="20%"><img src="css/img/logo.png"></td>
    <td width="60%"><h4>SERVIÇO NACIONAL DE APRENDIZAGEM COMERCIAL - SENAC<br /><br />
                         DEPARTAMENTO REGIONAL NO AMAZONAS<br /><br />
                         GERÊNCIA DE GESTÃO DE PESSOAS</h4>
    </td>
    <td width="20%"><b>CC/RS/GGP  Nº </b> <?= $model->custo_id . '/' . date('Y') ?><br /><br />
    <?=  date('d/m/Y', strtotime($model->custo_data)); ?></td>
  </tr>
</table>

  <div class="panel-body">
    <div class="row">

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 1: Informações</th></tr>
            </thead>
            <tbody>
            <tr>
                  <th scope="row">Pedido de Custo:</th>
                  <td><?= $model->custo_id ?></td>
                  <th scope="row">Assunto:</th>
                  <td colspan="8"><?= $model->custo_assunto ?></td>
            </tr>
            <tr>
                  <th scope="row">Recursos:</th>
                  <td><?= $model->custo_recursos ?></td>
                  <th scope="row">Valor Total:</th>
                  <td colspan="3"><?= 'R$ ' . number_format($model->custo_valortotal, 2, ',', '.'); ?></td>
                  <th scope="row">Responsável:</th>
                  <td><?= $model->custo_responsavel ?></td>
            </tr>
            </tbody>
          </table>
                        <!--    IETNS DO PEDIDO DE CUSTO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Itens do Pedido</th></tr>
               <caption><b>Sr.(a) Gerente</b><br />                    
                  Segue para aprovação a planilha de custos visando processo seletivo para posterior contratação de pessoal, solicitados pelas unidades/setores acima em substituições de colaboradores, demandas administrativas e/ou de docência das unidades.
              </caption>
              <tr>
                <th>Solicitação</th>
                <th>Unidade</th>
                <th>Cargo</th>
                <th>QTD</th>
                <th>Tipo Contrato</th>
                <th>Área</th>
                <th>CH. Semanal</th>
                <th>Salário</th>
                <th>Encargos</th>
                <th>Total</th>
                <th>Justificativa</th>
                <th>Data Prevista Início</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php 
                $totalsalario  = 0; 
                $totalencargos = 0; 
                $totalsgeral   = 0; 
                foreach ($modelsItens as $i => $modelItens): ?>
                  <td><?= $modelItens->contratacao_id; ?></td>
                  <td><?= $modelItens->itemcusto_unidade; ?></td>
                  <td><?= $modelItens->itemcusto_cargo; ?></td>
                  <td><?= $modelItens->itemcusto_quantidade; ?></td>
                  <td><?= $modelItens->itemcusto_tipocontrato; ?></td>
                  <td><?= $modelItens->itemcusto_area; ?></td>
                  <td><?= $modelItens->itemcusto_chsemanal; ?></td>
                  <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcusto_salario, 2, ',', '.'); ?></td>
                  <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcusto_encargos, 2, ',', '.'); ?></td>
                  <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcusto_total, 2, ',', '.'); ?></td>
                  <td><?= $modelItens->itemcusto_justificativa; ?></td>
                  <td><?= $modelItens->itemcusto_dataingresso; ?></td>

                  <?php $totalsalario  += floatval($modelItens->itemcusto_salario); //Total de Salários ?>
                  <?php $totalencargos += floatval($modelItens->itemcusto_encargos); //Total de Encargos ?>
                  <?php $totalsgeral   += floatval($modelItens->itemcusto_total); //Total Geral ?>
            </tr>
              <?php endforeach; ?>

            </tbody>
            <tfoot>
              <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                 <th colspan="7">TOTAL </th>
                 <td style="color:red"><?= 'R$ ' . number_format($totalsalario, 2, ',', '.'); ?></td>
                 <td style="color:red"><?= 'R$ ' . number_format($totalencargos, 2, ',', '.'); ?></td>
                 <td colspan="3" style="color:red"><?= 'R$ ' . number_format($totalsgeral, 2, ',', '.'); ?></td>
              </tr>
            </tfoot>

          </table><br /><br /><br />
                                    <!-- CAIXA DE AUTORIZAÇÃO GERÊNCIA DO SETOR -->

  <table class="table table-condensed table-hover">
     <tbody>
        <?php if($model->custo_situacaoggp == 1){ ?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> <?= $model->custoSituacaoggp->situacao_descricao ?><br /><br /></td>
          <?php }else{?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>
            <?= $model->custoSituacaoggp->situacao_descricao ?></b><br /><br /><br /><br /><br />
            Assinado eletrônicamente por:<br />
            <b><?php echo $model->custo_aprovadorggp; ?></b><br />
            Gerente de Gestão de Pessoas<br />
            <?php echo date('d/m/Y à\s H:i', strtotime( $model->custo_dataaprovacaoggp )) ?>&nbsp;&nbsp;&nbsp;<br />
          </td>
          <?php }?>

        <?php if($model->custo_situacaodad == 1){ ?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> <?= $model->custoSituacaodad->situacao_descricao ?><br /><br /></td>
          <?php }else{?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>
            <?= $model->custoSituacaodad->situacao_descricao ?></b><br /><br /><br /><br /><br />
            Assinado eletrônicamente por:<br />
            <b><?php echo $model->custo_aprovadorggp; ?></b><br />
            Gerente da Divisão Administrativa<br />
            <?php echo date('d/m/Y à\s H:i', strtotime( $model->custo_dataaprovacaoggp )) ?>&nbsp;&nbsp;&nbsp;<br />
          </td>
          <?php }?>

          <td style="font-size: 12px; border-top: 0px solid">
            (&nbsp;&nbsp;&nbsp;) Aprovo a solicitação<br />
            (&nbsp;&nbsp;&nbsp;) Não aprovo a solicitação<br />
            (&nbsp;&nbsp;&nbsp;)  Ao Sr. Presidente do C.R para autorização<br /><br /><br /><br />
            <b>Silvana Maria Ferreira de Carvalho</b><br />
            Diretora Regional<br />
             ___/___/_____<br />
          </td>

          <td style="font-size: 12px; border-top: 0px solid">
           (&nbsp;&nbsp;&nbsp;) Autorizo<br />
           (&nbsp;&nbsp;&nbsp;) Não Autorizo<br /><br /><br /><br /><br />
            <b>José Roberto Tadros</b><br />
            Presidente do CR/AM<br />
             ___/___/_____<br />
          </td>
     </tbody>
 </table>

          <br /><br />

          <div class="row">
              <div class="col-md-12" style="font-size: 10px;">
                  CC/RS/GGP  Nº  <?= $model->custo_id . '/' . date('Y') ?><br />
                  <b>Serviço Nacional de Aprendizagem Comercial - Departamento Regional do Amazonas</b><br />
                  Rua Costa Azevedo, nº 09 Edificio Rio Madeira, 10º andar, Centro. Manaus/Amazonas  -  Telefones: (92)3216-5740 /3216-5769/ Fax: (92) 3216-5747<br />
              </div>

              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>
