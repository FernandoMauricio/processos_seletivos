<?php
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
use app\models\Recrutamento;
use app\models\Contratacao;
use app\models\Sistemas;
use app\models\SistemasContratacao;

?>

<?php

$session = Yii::$app->session;

$id = $_GET['id'];

 $sql = 'SELECT * FROM contratacao WHERE id ='.$id.' ';
        $model = Contratacao::findBySql($sql)->one(); 


//RESGATANDO AS INFORMAÇÕES DA CONTRATAÇÃO
$id                    =  $model->id;
$data_solicitacao      =  $model->data_solicitacao;
$hora_solicitacao      =  $model->hora_solicitacao;
$cod_colaborador       =  $model->cod_colaborador;
$colaborador           =  $model->colaborador;
$cargo                 =  $model->cargo;
$cod_unidade_solic     =  $model->cod_unidade_solic;
$unidade               =  $model->unidade;
$quant_pessoa          =  $model->quant_pessoa;
$motivo                =  $model->motivo;
$substituicao          =  $model->substituicao;
$periodo               =  $model->periodo;
$tempo_periodo         =  $model->tempo_periodo;
$aumento_quadro        =  $model->aumento_quadro;
$obs_aumento           =  $model->obs_aumento;
$nome_substituicao     =  $model->nome_substituicao;
$deficiencia           =  $model->deficiencia;
$obs_deficiencia       =  $model->obs_deficiencia;
$data_ingresso         =  $model->data_ingresso;
$fundamental_comp      =  $model->fundamental_comp;
$fundamental_inc       =  $model->fundamental_inc;
$medio_comp            =  $model->medio_comp;
$medio_inc             =  $model->medio_inc;
$tecnico_comp          =  $model->tecnico_comp;
$tecnico_inc           =  $model->tecnico_inc;
$tecnico_area          =  $model->tecnico_area;
$superior_comp         =  $model->superior_comp;
$superior_inc          =  $model->superior_inc;
$superior_area         =  $model->superior_area;
$pos_comp              =  $model->pos_comp;
$pos_inc               =  $model->pos_inc;
$pos_area              =  $model->pos_area;
$dominio_atividade     =  $model->dominio_atividade;
$windows               =  $model->windows;
$word                  =  $model->word;
$excel                 =  $model->excel;
$internet              =  $model->internet;
$experiencia           =  $model->experiencia;
$experiencia_tempo     =  $model->experiencia_tempo;
$experiencia_atividade =  $model->experiencia_atividade;
$jornada_horas         =  $model->jornada_horas;
$jornada_obs           =  $model->jornada_obs;
$principais_atividades =  $model->principais_atividades;
$metodo_recrutamento   =  $model->recrutamento_id;
$selec_curriculo       =  $model->selec_curriculo;
$selec_dinamica        =  $model->selec_dinamica;
$selec_prova           =  $model->selec_prova;
$selec_entrevista      =  $model->selec_entrevista;
$selec_teste           =  $model->selec_teste;
$situacao_id           =  $model->situacao_id;
?>


<body>

<table width="100%" border="1" bordercolor="#ddd">
  <tr>
    <th align="center" width="21%" id="titulo"><div align="center"><img src="../web/css/img/logo.png" width="180" height="75" alt="logo" /></div></th> <!-- width="158" height="90" -->
    <th width="79%" height="92" bgcolor="#ddd" id="titulo"><div align="center"> DETALHES DA SOLICITAÇÃO DE CONTRATAÇÃO DE PESSOAL</div></th>
  </tr>
  </table>
<table width="100%" border="1" bordercolor="#ddd">
  <tr>
    <td width="21%" height="45" id="linhas">Código:</td>
    <td height="45" colspan="2" id="linhas">&nbsp; <?php echo $id ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Solicitante:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $colaborador ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Unidade:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $unidade ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Quantidade de pessoas a ser contratada:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $quant_pessoa ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Motivo da contratação:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $motivo ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Substituição:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($substituicao == 1) echo "X"; ?>) Sim (<?php if($substituicao == 0) echo "X"; ?>) Não</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Nome do servidor a ser substituído:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $nome_substituicao ?></td>
  </tr>
    <tr>
    <td height="45" id="linhas">Período Indeterminado::</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($periodo == 1) echo "X"; ?>) Sim (<?php if($periodo == 0) echo "X"; ?>) Não</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Período em meses:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $tempo_periodo ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Necessidade de aumento do quadro e pessoal:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($aumento_quadro == 1) echo "X"; ?>) Sim (<?php if($aumento_quadro == 0) echo "X"; ?>) Não</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Justificativa do aumento do quadro:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $obs_aumento ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Data prevista do ingresso do futuro contratado(a):</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $data_ingresso  ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Pode ser recrutado e selecionado candidato portador de algum tipo de deficiência:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($deficiencia == 1) echo "X"; ?>) Sim (<?php if($deficiencia == 0) echo "X"; ?>) Não</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Observação:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $obs_deficiencia ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Ensino Fundamental:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($fundamental_comp == 1) echo "X"; ?>) Completo (<?php if($fundamental_inc == 1) echo "X"; ?>) Incompleto</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Ensino Médio:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($medio_comp == 1) echo "X"; ?>) Completo (<?php if($medio_inc == 1) echo "X"; ?>) Incompleto</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Ensino Técnico:</td>
    <td height="45" id="linhas">&nbsp;(<?php if($tecnico_comp == 1) echo "X"; ?>) Completo (<?php if($tecnico_inc == 1) echo "X"; ?>) Incompleto</td>
    <td height="45" id="linhas">&nbsp;Área:&nbsp;<?php echo $tecnico_area  ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Ensino Superior:</td>
    <td height="45" id="linhas">&nbsp;(<?php if($superior_comp == 1) echo "X"; ?>) Completo (<?php if($superior_inc == 1) echo "X"; ?>) Incompleto</td>
    <td height="45" id="linhas">&nbsp;Área:&nbsp;<?php echo $superior_area  ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Pós-Graduação</td>
    <td height="45" id="linhas">&nbsp;(<?php if($pos_comp == 1) echo "X"; ?>) Completo (<?php if($pos_inc == 1) echo "X"; ?>) Incompleto</td>
    <td height="45" id="linhas">&nbsp;Área:&nbsp;<?php echo $pos_area  ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Domínio de alguma atividade ou conhecimento específico:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $dominio_atividade ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Domínio de Informática:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($windows == 1) echo "X"; ?>)Windows&nbsp;(<?php if($word == 1) echo "X"; ?>)Word&nbsp;(<?php if($excel == 1) echo "X"; ?>)Excel&nbsp;(<?php if($internet == 1) echo "X"; ?>)Internet</td>
      <tr>
    <td height="45" id="linhas">Grau de experiência comprovada:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($experiencia == 1) echo "X"; ?>) Sim (<?php if($experiencia == 0) echo "X"; ?>) Não</td>
  </tr>
  <tr>
    <td height="45" id="linhas">Tempo:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $experiencia_tempo ?></td>
      <tr>
    <td height="45" id="linhas">Em qual atividade:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $experiencia_atividade ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Disponibilidade para jornada de 8 horas de segunda-feira a sexta-feira:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;(<?php if($jornada_horas == 1) echo "X"; ?>) Sim (<?php if($jornada_horas == 0) echo "X"; ?>) Não</td>
  <tr>
    <td height="45" id="linhas">Observações:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $jornada_obs; ?></td>
  </tr>
  <tr>
    <td height="45" id="linhas">Principais atividades a serem desenvolvidas pelo servidor a ser contratado:</td>
    <td height="45" colspan="2" id="linhas">&nbsp;<?php echo $principais_atividades; ?></td>

  <tr>
    <td height="45" id="linhas">Métodos de seleção indicados, considerando um ou mais dos seguintes processos:</td>
    <td height="45" colspan="2" id="linhas"><p>&nbsp;(<?php if($selec_curriculo == 1) echo "X"; ?>) Análise de Currículo</p>
    <p>&nbsp;(<?php if($selec_dinamica == 1) echo "X"; ?>) Dinâmica de Grupo</p>
    <p>&nbsp;(<?php if($selec_prova == 1) echo "X"; ?>) Provas gerais ou técnicas</p>
    <p>&nbsp;(<?php if($selec_entrevista == 1) echo "X"; ?>) Entrevista</p>
    <p>&nbsp;(<?php if($selec_teste == 1) echo "X"; ?>) Testes Psicológicos</p></td>
    </tr>
    <tr>
    <td height="45" id="linhas">Sistemas para cadastro de colaborador:</td>
    <td height="45" colspan="2" id="linhas">
   <?php

  $query_sistemas = "SELECT descricao FROM sistemas, sistemas_contratacao WHERE contratacao_id = '".$id."' AND sistema_id = idsistema";
  $sistema = Sistemas::findBySql($query_sistemas)->all(); 
  foreach ($sistema as $sistemas) {

   $Sistemas = $sistemas["descricao"];

    echo $Sistemas.' / ' ;
  }

    ?>

    </td>
    </tr>
      <tr>
        <td height="45" align="center" colspan="3" id="linhas2"><p>Assinado eletrônicamente por:<br />
        <?php echo $colaborador; ?><br />
        <?php echo $cargo; ?><br />
        <?php echo date('d/m/Y', strtotime($data_solicitacao)); ?> às <?php echo date('H:i:s', strtotime($hora_solicitacao)); ?>&nbsp;&nbsp;&nbsp;<br /></p></td>
      </tr>
      <tr>
        <td height="45" align="center" colspan="3" id="linhas2">Obs.: Este instrumento atende as exigências contidas na Resolução nº 1.018/2015 do CN do Senac.</td>
      </tr>
      </table>
</body>
</html>