<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pedidos\pedidohomologacao\PedidoHomologacao */

?>
<div class="pedido-homologacao-view">

<table width="100%" border="0">
  <tr> 
    <td width="20%"><img src="css/img/logo.png"></td>
    <td width="60%"><h4>PEDIDO DE HOMOLOGAÇÃO PROCESSO SELETIVO Nº 55/2017<br /><br />
                        Homologação Nº <?= $model->homolog_id . '/' . date('Y', strtotime($model->homolog_data)) ?><br /><br />
                        <?php 
                          setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                          date_default_timezone_set('America/Manaus'); 
                          echo strftime('%A, %d de %B de %Y', strtotime('today'));
                        ?>
                      </h4>
    </td>
  </tr>
</table>

  <div class="panel-body">
    <div class="row">
          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 1: Dados da Solicitação</th></tr>
            </thead>
            <tbody>
            <tr>
                  <th scope="row">Cargo:</th>
                  <td><?= $model->homolog_cargo ?></td>
                  <th scope="row">Unidade:</th>
                  <td colspan="6"><?= $model->homolog_unidade ?></td>
            </tr>
            <tr>
                  <th scope="row">Remuneração:</th>
                  <td><?= 'R$ ' . number_format($model->homolog_salario, 2, ',', '.'); ?></td>
                  <th scope="row">Encargos:</th>
                  <td><?= 'R$ ' . number_format($model->homolog_encargos, 2, ',', '.'); ?></td>
                  <th scope="row">Total:</th>
                  <td><?= 'R$ ' . number_format($model->homolog_total, 2, ',', '.'); ?></td>
                  <th scope="row">Tipo de Contrato:</th>
                  <td><?= $model->homolog_tipo == 0 ? 'Indeterminado' : 'Determinado';  ?></td>
                  <th scope="row">Solicitação:</th>
                  <td  colspan="5"><?= $model->contratacao_id ?></td>
            </tr>
            </tbody>
          </table>

                        <!--    SÍNTESE DO PROCESSO SELETIVO -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 2: Síntese do Processo Seletivo</th></tr>
            </thead>
            <tbody>
                  <tr><td><?= $model->homolog_sintese ?></td></tr>
            </tbody>
          </table>

                        <!--   FASES REALIZADAS NO PROCESSO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 3: Fases Realizadas no Processo Seletivo</th></tr>
            </thead>
            <tbody>
              <?php
                 $array = explode(',', $model->homolog_fases);
                   foreach ($array as $valores) {
                     echo '<tr><td>' .$valores. '</tr></td>';
                   }
              ?>
            </tbody>
          </table>

                        <!--    VALIDADE DO PROCESSO  -->

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 4: Validade do Processo</th></tr>
            </thead>
            <tbody>
                <tr><td><?= $model->homolog_validade ?></td></tr>
            </tbody>
          </table>

          <table class="table table-condensed table-hover">
            <thead>
            <tr class="info"><th colspan="12">SEÇÃO 5: Candidatos Aprovados</th></tr>
              <tr>
                <th>Classificação</th>
                <th>Candidatos</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <?php foreach ($modelsItens as $i => $modelItens): ?>
                  <td><?= $modelItens->pedhomolog_classificacao; ?></td>
                  <td><span class="text-uppercase"><?= $modelItens->pedhomolog_candidato; ?></span></td>
            </tr>
              <?php endforeach; ?>

          </table><br /><br /><br />

                                    <!-- ÁREA DE APROVAÇÕES -->

  <table class="table table-condensed table-hover">
     <tbody>
        <?php if($model->homolog_situacaoggp == 1){ ?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> <?= $model->homologSituacaoggp->situacao_descricao ?><br /><br /></td>
          <?php }else{?>
          <?php echo $model->homolog_situacaoggp == 3 ? '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>' : '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>'; ?>
            <?= $model->homologSituacaoggp->situacao_descricao ?></b><br /><br /><br /><br /><br />
            Assinado eletrônicamente por:<br />

            <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'GGP'])->one(); ?>
            <b><?= $model->homolog_aprovadorggp; ?></b><br />
            <?= $query['aprov_cargo']; ?><br />
            <?= $query['aprov_observacao']; ?><br />
            <?php echo date('d/m/Y', strtotime( $model->homolog_dataaprovacaoggp )) ?>&nbsp;&nbsp;&nbsp;<br />
          </td>
          <?php }?>

        <?php if($model->homolog_situacaodad == 1){ ?>
          <td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> <?= $model->homologSituacaodad->situacao_descricao ?><br /><br /></td>
          <?php }else{?>
          <?php echo $model->homolog_situacaodad == 3 ? '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>' : '<td style="font-size: 12px; border-top: 0px solid"><b><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>'; ?>
            <?= $model->homologSituacaodad->situacao_descricao ?></b><br /><br /><br /><br /><br />
            Assinado eletrônicamente por:<br />
            
            <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'DAD'])->one(); ?>
            <b><?= $model->homolog_aprovadordad; ?></b><br />
            <?= $query['aprov_cargo']; ?><br />
            <?= isset($query['aprov_observacao']) ? $query['aprov_observacao'] . '<br />' : ''; ?>
            <?php echo date('d/m/Y', strtotime( $model->homolog_dataaprovacaodad )) ?>&nbsp;&nbsp;&nbsp;<br />
          </td>
          <?php }?>

          <td style="font-size: 12px; border-top: 0px solid">
            (&nbsp;&nbsp;&nbsp;) Aprovo o processo. Ao Sr. Presidente do C.R. sugerindo a homologação.<br />
            (&nbsp;&nbsp;&nbsp;) Não Aprovo o processo.<br /><br /><br /><br /><br />

            <?php $query = (new \yii\db\Query())->select('aprov_descricao, aprov_cargo, aprov_observacao')->from('db_processos.aprovacoes')->where(['aprov_area' => 'DIRETORIA REGIONAL'])->one(); ?>
            <b><?= $query['aprov_descricao']; ?></b><br />
            <?= $query['aprov_cargo']; ?><br />
            <?= isset($query['aprov_observacao']) ? $query['aprov_observacao'] . '<br />' : ''; ?>
             ___/___/_____<br />
          </td>

          <td style="font-size: 12px; border-top: 0px solid">
           (&nbsp;&nbsp;&nbsp;) Homologo o resultado deste processo de seleção de pessoal.<br />
           (&nbsp;&nbsp;&nbsp;) Não homologo.<br /><br /><br /><br /><br />

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
                  CC/RS/GGP  Nº  <?= $model->homolog_id  ?><br />
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

