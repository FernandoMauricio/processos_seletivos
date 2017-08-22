<?php
/* @var $this yii\web\View */
// namespace yii\bootstrap;
use yii\helpers\Html;
use app\models\Comunicacaointerna;
use app\models\Destinocomunicacao;
use yii\helpers\ArrayHelper;

$this->title = 'Processo Seletivo - Senac AM';

?>

<div class="site-index">
        <h1 class="text-center"> Histórico de Versões</h1>
            <div class="body-content">
                <div class="container">

                <div class="panel panel-primary">
                <div class="panel-heading">
                            <i class="glyphicon glyphicon-star-empty"></i> Versão 1.9 - (ATUALMENTE) - Publicado em xx/08/2017
                </div>
                    <div class="panel-body">
                      <h4><strong style="color: #337ab7;">Implementações</strong></h4>
                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Planos de Cursos</strong></h5>
                                <h5>- Inclusão do campo "Qnt de Alunos" no cadastro de Planos.</h5>
                                <h5>- Inclusão do campo "Nível de Docente" no cadastro de Planos.</h5>
                                <h5>- Realizado a inclusão do nível de docente igual a "Docente Nível Superior" via bando de dados, para todos os planos já criados, conforme acertado em reunião com DEP, GPO e DIF no mesmo dia desta publicação. Para novos planos, essa inclusão se fará normalmente no cadastro.</h5><br>

                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Planilhas de Precificação</strong></h5>
                                <h5>- Na criação das planilhas de precificações, o sistema trará "qnt de alunos" e "nível do docente" de forma automática no momento que for escolhido o plano a ser precificado.</h5><br>

                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Relatórios</strong></h5>
                                <h5>- Incluido na tela de relatórios DEP, o relatório em Excel que informa as planilhas de precificações criadas para as unidades, juntamente com a quantidade mínima de alunos.</h5>
                    </div>
                </div>

                <div class="panel panel-danger">
                <div class="panel-heading">
                            <i class="glyphicon glyphicon-folder-close"></i> Versão 1.2 - Publicado em 19/04/2017
                </div>
                    <div class="panel-body">
                      <h4><strong style="color: #337ab7;">Implementações</strong></h4>
                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Curriculos</strong></h5>
                                <h5>- Solicitação de confirmação no envio do curriculo.</h5><br>
                                
                      <h4><strong style="color: #337ab7;">Correções</strong></h4>
                        <h5><i class="glyphicon glyphicon-tag"></i><strong> Curriculos</strong></h5>
                                <h5>- Ajustes no layout de administração dos Curriculos.</h5>
                                <h5>- Correção nas rotas para não perder a filtragem quando o usuário classificava ou desclassificava os candidatos.</h5>
                                <h5>- Correção na ordenação dos curriculos</h5>
                    </div>
                </div>

            </div>
        </div>   
</div>