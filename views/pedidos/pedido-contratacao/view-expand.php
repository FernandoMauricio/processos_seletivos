<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="pedido-contratacao-view">

  <div class="panel-body">
    <div class="row">
          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 1: Informações</th></tr>
            </thead>
            <tbody>
            <tr>
                  <th scope="row">Pedido de Custo:</th>
                  <td><?= $model->pedcontratacao_id ?></td>
                  <th scope="row">Unidade:</th>
                  <td colspan="8"> Pedido de contratação para atender a unidade/setor do: <b style="color: #0823f3;"><?= $model->pedcontratacao_assunto ?></b></td>
            </tr>
            <tr>
                  <th scope="row">Recursos:</th>
                  <td><?= $model->pedcontratacao_recursos ?></td>
                  <th scope="row">Valor Total:</th>
                  <td colspan="3"><?= 'R$ ' . number_format($model->pedcontratacao_valortotal, 2, ',', '.'); ?></td>
                  <th scope="row">Responsável:</th>
                  <td><?= $model->pedcontratacao_responsavel ?></td>
            </tr>
            </tbody>
          </table>
                        <!--    IETNS DO PEDIDO DE CUSTO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Itens do Pedido</th></tr>
               <caption><b>Sr.(a) Gerente</b><br />                    
                  Segue para aprovação o pedido de contratação de pessoal para atender as demandas da unidade de ensino e setor citados acima.
              </caption>
              <tr>
                <th>Solicitação</th>
                <th>Unidade</th>
                <th>Cargo</th>
                <th>Área</th>
                <th>Nome</th>
                <th>Nº da Autorização de Custo</th>
                <th>Tipo Contrato</th>
                <th>CH. Semanal</th>
                <th>Remuneração com Encargos</th>
                <th>Justificativa</th>
                <th>Data Admissão</th>
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
                  <td><?= $modelItens->itemcontratacao_unidade; ?></td>
                  <td><?= $modelItens->itemcontratacao_cargo; ?></td>
                  <td><?= $modelItens->itemcontratacao_area; ?></td>
                  <td><?= $modelItens->itemcontratacao_nome; ?></td>
                  <td><?= $modelItens->etapasProcesso->pedidocusto_id . '/'.date('Y', strtotime($model->pedcontratacao_data)); ?></td>
                  <td><?= $modelItens->itemcontratacao_tipocontrato; ?></td>
                  <td><?= $modelItens->itemcontratacao_chsemanal; ?></td>
                  <td style="width: 100px;"><?= 'R$ ' . number_format($modelItens->itemcontratacao_total, 2, ',', '.'); ?></td>
                  <td><?= $modelItens->itemcontratacao_justificativa; ?></td>
                  <td><?= $modelItens->itemcontratacao_dataingresso; ?></td>

                  <?php $totalsgeral   += floatval($modelItens->itemcontratacao_total); //Total Geral ?>
            </tr>
              <?php endforeach; ?>

            </tbody>
            <tfoot>
              <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                 <th colspan="8">TOTAL </th>
                 <td colspan="3" style="color:red"><?= 'R$ ' . number_format($totalsgeral, 2, ',', '.'); ?></td>
              </tr>
            </tfoot>

          </table><br /><br /><br />
                                    <!-- ÁREA DE APROVAÇÕES -->

  <table class="table table-condensed table-hover">
     <tbody>
        <?php if($model->pedcontratacao_situacaoggp == 1){ ?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> <?= $model->pedcontratacaoSituacaoggp->situacao_descricao ?><br /><br /></td>
          <?php }else{?>
          <?php echo $model->pedcontratacao_situacaoggp == 3 ? '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>' : '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>'; ?>
            <?= $model->pedcontratacaoSituacaoggp->situacao_descricao ?></b><br /><br /><br /><br /><br />
            Assinado eletrônicamente por:<br />

            <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'GGP'])->one(); ?>
            <b><?= $model->pedcontratacao_aprovadorggp; ?></b><br />
            <?= $query['aprov_cargo']; ?><br />
            <?= $query['aprov_observacao']; ?><br />
            <?php echo date('d/m/Y', strtotime( $model->pedcontratacao_dataaprovacaoggp )) ?>&nbsp;&nbsp;&nbsp;<br />
          </td>
          <?php }?>

        <?php if($model->pedcontratacao_situacaodad == 1){ ?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> <?= $model->pedcontratacaoSituacaodad->situacao_descricao ?><br /><br /></td>
          <?php }else{?>
          <?php echo $model->pedcontratacao_situacaodad == 3 ? '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>' : '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>'; ?>
            <?= $model->pedcontratacaoSituacaodad->situacao_descricao ?></b><br /><br /><br /><br /><br />
            Assinado eletrônicamente por:<br />
            
            <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'DAD'])->one(); ?>
            <b><?= $model->pedcontratacao_aprovadordad; ?></b><br />
            <?= $query['aprov_cargo']; ?><br />
            <?= isset($query['aprov_observacao']) ? $query['aprov_observacao'] . '<br />' : ''; ?>
            <?php echo date('d/m/Y', strtotime( $model->pedcontratacao_dataaprovacaodad )) ?>&nbsp;&nbsp;&nbsp;<br />
          </td>
          <?php }?>

          <td style="font-size: 12px; border-top: 0px solid">
            (&nbsp;&nbsp;&nbsp;) Aprovo a solicitação<br />
            (&nbsp;&nbsp;&nbsp;) Não aprovo a solicitação<br />
            (&nbsp;&nbsp;&nbsp;)  Ao Sr. Presidente do C.R para autorização<br /><br /><br /><br />

            <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'DIRETORIA REGIONAL'])->one(); ?>
            <b><?= $query['aprov_descricao']; ?></b><br />
            <?= $query['aprov_cargo']; ?><br />
            <?= isset($query['aprov_observacao']) ? $query['aprov_observacao'] . '<br />' : ''; ?>
             ___/___/_____<br />
          </td>

          <td style="font-size: 12px; border-top: 0px solid">
           (&nbsp;&nbsp;&nbsp;) Autorizo<br />
           (&nbsp;&nbsp;&nbsp;) Não Autorizo<br /><br /><br /><br /><br />

           <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'PRESIDÊNCIA'])->one(); ?>
            <b><?= $query['aprov_descricao']; ?></b><br />
           <?= $query['aprov_cargo']; ?><br />
           <?= isset($query['aprov_observacao']) ? $query['aprov_observacao'] . '<br />' : ''; ?>
             ___/___/_____<br />
          </td>
     </tbody>
 </table>

          <br /><br />

          <div class="row">
              <div class="col-md-12" style="font-size: 10px;">
                  CC/RS/GGP  Nº  <?= $model->pedcontratacao_id . '/' . date('Y', strtotime($model->pedcontratacao_data)) ?><br />
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
