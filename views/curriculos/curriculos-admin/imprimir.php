<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curriculos */
$this->title = $model->numeroInscricao;
?>

    <h1>Número de Inscrição: <?= Html::encode($this->title) ?></h1>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Ficha de Inscrição: <span class="text-uppercase"> <?= $model->nome ?></span></h3>
  </div>

  <div class="panel-body">
    <div class="row">

      <?php
        $attributes = [
            [
              'group'=>true,
              'label'=>'SEÇÃO 1: Informações Pessoais',
              'rowOptions'=>['class'=>'info']
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'id',
                        'displayOnly'=>true,
                        'labelColOptions'=>['style'=>'width:0%'],
                        ],

                        [
                        'attribute' => 'edital',
                        'displayOnly'=>true,
                        'labelColOptions'=>['style'=>'width:0%'],
                        ],

                        [
                        'attribute' => 'numeroInscricao',
                        'displayOnly'=>true,
                        'labelColOptions'=>['style'=>'width:0%'],
                        ],

                        [
                        'attribute' => 'cargo',
                        'displayOnly'=>true,
                        'labelColOptions'=>['style'=>'width:0%'],
                        ],

                    ],
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'nome',
                        'displayOnly'=>true,
                        'labelColOptions'=>['style'=>'width:0%'],
                        ],

                        [
                        'attribute' => 'idade',
                        'displayOnly'=>true,
                        'labelColOptions'=>['style'=>'width:0%'],
                        ],

                        [
                            'attribute' => 'datanascimento',
                            'format' => ['date', 'php:d/m/Y'],
                            'displayOnly'=>true,
                            'labelColOptions'=>['style'=>'width:0%'],
                        ],
                        
                        [
                            'attribute'=>'sexo', 
                            'label'=>'Sexo',
                            'format'=>'raw',
                            'value'=>$model->sexo ? 'Masculino' : 'Feminino',
                            'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'cpf',
                        'displayOnly'=>true,
                        ],
                        [
                        'attribute' => 'identidade',
                        'displayOnly'=>true,
                        ],
                        [
                        'attribute' => 'orgao_exped',
                        'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [

                        [
                        'attribute' => 'email',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute' => 'emailAlt',
                        'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'telefone',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute' => 'telefoneAlt',
                        'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [
                        [
                        'attribute' => 'classificado',
                        'value' => $model->situacaoCandidato->sitcan_descricao,
                        'displayOnly'=>true,
                        ],

                        [
                            'attribute' => 'data',
                            //'format'=>['datetime', 'php:d/m/Y H:i:s'],
                            'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [
                        [
                            'attribute'=>'curriculo_lattes', 
                            'label'=>'Link Lattes',
                            'format'=>'raw',
                            'value'=>Html::a($model->curriculo_lattes, $model->curriculo_lattes, ['class'=>'kv-author-link']),
                            'displayOnly'=>true,
                        ],
                    ],
            ],

            [
              'columns' => [

                        [
                        'attribute' => 'deficiencia',
                        'label'=>'Pessoa com Deficiência?',
                        'format'=>'raw',
                        'value'=>$model->deficiencia_cid ? 'Sim' : 'Não',
                        'displayOnly'=>true,
                        ],

                        [
                        'attribute'=>'deficiencia_cid', 
                        'displayOnly'=>true,
                        ],
                    ],
            ],
            
            [
              'columns' => [

                        [
                        'attribute' => 'marketing',
                        'label'=>'Como ficou sabendo da vaga?',
                        'format'=>'raw',
                        'value'=>$model->marketing,
                        'displayOnly'=>true,
                        ],
                    ],
            ],
        ];

    echo DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'attributes'=> $attributes,
    ]);
?>
                        <!--    ENDEREÇO  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 2: Endereço</th></tr>
      <tr>
        <th>Endereço</th>
        <th>Número</th>
        <th>Bairro</th>
        <th>Complemento</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>CEP</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($curriculosEndereco as $curriculoEndereco): ?>
          <td><?= $curriculoEndereco->endereco; ?></td>
          <td><?= $curriculoEndereco->numero_end; ?></td>
          <td><?= $curriculoEndereco->bairro; ?></td>
          <td><?= $curriculoEndereco->complemento; ?></td>
          <td><?= $curriculoEndereco->cidade; ?></td>
          <td><?= $curriculoEndereco->estado; ?></td>
          <td><?= $curriculoEndereco->cep; ?></td>
      <?php endforeach; ?>
    </tbody>
  </table>
                        <!--   FORMAÇÃO ESCOLAR  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="13">SEÇÃO 3: Formação Escolar</th></tr>
      <tr>
        <th>Nível Escolar</th>
        <th>Situação</th>
        <th>Área</th>
        <th>Local</th>
        <th>Ano de Conclusão</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($curriculosFormacao as $curriculoFormacao): ?>
          <tr>
            <td>Ensino Fundamental</td>
            <td><?= $curriculoFormacao->fundamental_comp ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Ensino Médio</td>
            <td><?= $curriculoFormacao->medio_comp ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Ensino Técnico</td>
            <td><?= $curriculoFormacao->tecnico ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td><?= $curriculoFormacao->tecnico_area; ?></td>
            <td><?= $curriculoFormacao->tecnico_local; ?></td>
            <td><?= $curriculoFormacao->tecnico_anoconclusao; ?></td>
            <td></td>
          </tr>
          <tr>
            <td>Ensino Superior</td>
            <td><?= $curriculoFormacao->superior_comp ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td><?= $curriculoFormacao->superior_area; ?></td>
            <td><?= $curriculoFormacao->superior_local; ?></td>
            <td><?= $curriculoFormacao->superior_anoconclusao; ?></td>
          </tr>
          <tr>
            <td>Pós-Graduação</td>
            <td><?= $curriculoFormacao->pos ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td><?= $curriculoFormacao->pos_area; ?></td>
            <td><?= $curriculoFormacao->pos_local; ?></td>
            <td><?= $curriculoFormacao->pos_anoconclusao; ?></td>
          </tr>
          <tr>
            <td>Mestrado</td>
            <td><?= $curriculoFormacao->mestrado ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td><?= $curriculoFormacao->mestrado_area; ?></td>
            <td><?= $curriculoFormacao->mestrado_local; ?></td>
            <td><?= $curriculoFormacao->mestrado_anoconclusao; ?></td>
          </tr>
          <tr>
            <td>Doutorado</td>
            <td><?= $curriculoFormacao->doutorado ? '<span style="color:#27cc27"><b>Completo</b></span>' : '<span style="color:#ff2b2b"><b>Incompleto</b></span>'; ?></td>
            <td><?= $curriculoFormacao->doutorado_area; ?></td>
            <td><?= $curriculoFormacao->doutorado_local; ?></td>
            <td><?= $curriculoFormacao->doutorado_anoconclusao; ?></td>
          </tr>
          <tr>
            <td>Estuda Atualmente?</td>
            <td><?= $curriculoFormacao->estuda_curso ? 'Sim' : 'Não'; ?></td>
            <td><?= $curriculoFormacao->estuda_local ?></td>
            <td></td>
            <td><?php echo $curriculoFormacao->estuda_turno_mat ? '[X] Matutino' : '' ?>
                <?php echo $curriculoFormacao->estuda_turno_vesp ? '[X] Vespertino' : '' ?>
                <?php echo $curriculoFormacao->estuda_turno_not ? '[X] Noturno' : '' ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
                        <!--    CURSOS COMPLEMENTARES  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="13">SEÇÃO 4: Cursos Complementares</th></tr>
      <tr>
        <th>Tem Certificado?</th>
        <th>Curso Complementar</th>
        <th>Local</th>
        <th>Carga Horária</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($curriculosComplementos as $curriculosComplemento): ?>
      <td><?= $curriculosComplemento->certificado ? 'Sim' : 'Não'; ?></td>
      <td><?= $curriculosComplemento->cursos ?></td>
      <td><?= $curriculosComplemento->local ?></td>
      <td><?= $curriculosComplemento->carga_horaria ?></td>
    <?php endforeach; ?>
    </tbody>
  </table>
                        <!--    EMPREGOS ANTERIORES  -->
                        
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="13">SEÇÃO 5: Empregos Anteriores</th></tr>
      <tr>
        <th>Empresa</th>
        <th>Cidade</th>
        <th>Cargo</th>
        <th>Salário</th>
        <th>Início</th>
        <th>Término</th>
        <th>Atividades Desenvolvidas</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <?php foreach ($curriculosEmpregos as $curriculosEmprego): ?>
       <td><?= $curriculosEmprego->empresa; ?></td>
       <td><?= $curriculosEmprego->cidade; ?></td>
       <td><?= $curriculosEmprego->cargo; ?></td>
       <td><?= $curriculosEmprego->ultimo_salario; ?></td>
       <td><?= $curriculosEmprego->inicio; ?></td>
       <td><?= $curriculosEmprego->termino; ?></td>
       <td><?= $curriculosEmprego->atividades; ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
                        <!--   APROVAÇÕES  -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 6: Aprovações/Reprovações</th></tr>
        <th>Responsável</th>
        <th>Data/Hora</th>
        <th>Situação</th>
    </thead>
    <tbody>
        <tr>
          <td><?= $model->aprovador_ggp; ?></td>
          <td><?= $model->dataaprovador_ggp != NULL ? date('d/m/Y H:i:s', strtotime($model->dataaprovador_ggp)) : ''; ?></td>
          <td>
            <?php if(isset($model->situacao_ggp)) { ?>
              <?= $model->situacao_ggp == 1 ? '<span style="color:#27cc27"><b>Classificado</b></span>' : '<span style="color:#ff2b2b"><b>Desclassificado</b></span>'; ?>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td><?= $model->aprovador_solicitante; ?></td>
          <td><?= $model->dataaprovador_solicitante != NULL ? date('d/m/Y H:i:s', strtotime($model->dataaprovador_solicitante)) : ''; ?></td>
          <td>
            <?php if(isset($model->situacao_aprovadorsolicitante)) { ?>
              <?= $model->situacao_aprovadorsolicitante  == 1 ? '<span style="color:#27cc27"><b>Classificado</b></span>' : '<span style="color:#ff2b2b"><b>Desclassificado</b></span>'; ?>
            <?php } ?>
          </td>
        </tr>
    </tbody>
  </table><br>

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 7: Termos de Aceite</th></tr>
    </thead>
  </table>

  <P style="text-align: center;"><b>DECLARAÇÃO</b></P>
  <p style="margin: 0px 30px 10px"><i class="glyphicon glyphicon-ok"></i> Li o Documento de Abertura e concordo em participar do processo de seleção desta instituição de acordo com o que foi estabelecido e proposto pelo mesmo.</p>

  <p style="margin: 0px 30px 10px"><i class="glyphicon glyphicon-ok"></i> Declaro para os devidos fins, que <?= $model->parentesco ? '<span style="color:#ff2b2b"><b>SIM</b></span>' : '<span style="color:#27cc27"><b>NÃO</b></span>'; ?> tenho parentes que sejam servidores do SESC ou do SENAC, que sejam membros, efetivos ou suplentes, dos Conselhos Nacional, Fiscal e do Conselho Regional neste Estado, bem como que sejam dirigentes de entidades sindicais ou civis, do comércio, patronais ou de empregados.</p>

  <p style="margin: 0px 30px 10px"><i class="glyphicon glyphicon-ok"></i> Declaro que todas as informações contidas nesse formulário e no meu currículo constituem a expressão da verdade, e sobre as quais assumo total responsabilidade. Ficando V.S.ª autorizada a efetuar qualquer confirmação que achar necessária, e que a inexatidão das informações ou irregularidades nos documentos, verificadas a qualquer tempo, acarretará a nulidade da Contratação, com todas as suas decorrências, sem prejuízo das demais medidas de ordem administrativa, civil ou criminal.</p><br><br>


  <table width="100%" border="0">
          <tr><td align="right" style="padding-right: 40px;">______________________________________</td></tr>
          <tr><td align="right" style="padding-right: 40px;" class="text-uppercase"><?= $model->nome ?></td></tr>
          <tr><td align="right" style="padding-right: 40px;"><?= $model->cpf ?></td></tr>
  </table>

     </div>
    </div>
  </div>
</div>
