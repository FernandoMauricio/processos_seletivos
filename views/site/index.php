<?php
/* @var $this yii\web\View */
$this->title = 'Processo Seletivo - Senac AM';
$session = Yii::$app->session;
$nome_user    = $session['sess_nomeusuario'];
?>
<div class="site-index">
        <h1 class="text-center">Contratação / Processo Seletivo</h1>
            <div class="body-content">
                <div class="container">
                    <h3>Bem vindo(a), <?php echo $nome_user = utf8_encode(ucwords(strtolower($nome_user)))?>!</h3>

                        <!-- NOTIFICAÇÕES de Aprovações GGP - Pedido de Custo / Pedido de Contratação -->
                        <?php if($_SESSION['sess_codunidade'] == 7 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoCustoGGP > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoGGP ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="http://localhost/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fggp-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>

                        <?php if($_SESSION['sess_codunidade'] == 7 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoGGP > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoGGP ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="http://localhost/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fggp-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>

                        <!-- NOTIFICAÇÕES de Aprovações DAD - Pedido de Custo / Pedido de Contratação -->
                        <?php if($_SESSION['sess_codunidade'] == 8 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoCustoDAD > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoDAD ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="http://localhost/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fdad-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>

                        <?php if($_SESSION['sess_codunidade'] == 8 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoDAD > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoDAD ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="http://localhost/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fdad-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>
                </div>
            </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> O que há de novo? - Versão 2.1 - Publicado em 24/11/2017</div>
            <div class="panel-body">
              <h4><b style="color: #337ab7;">Implementações</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Geração de Arquivos</b></h5>
                        <h5>- Retirada dos segundos na listagem de candidatos da tela de Geração de Arquivos.</h5>
                        <h5>- Campo "Responsável" na geração de arquivos está editável (municípios os usuários colocam os nomes dos gerentes ou supervisoras). </h5>
                        <h5>- Perfis de formulários administrativos terão horários individuais.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Listagem de Candidatos</b></h5>
                        <h5>- Alterado para ordem crescente a listagem dos candidatos.</h5>
                        <h5>- Contagem de classificados quando o gerente for aprovando os curriculos.</h5>
                        <h5>- Ensino Médio inserido na busca avançada.</h5>
                        <h5>- Coluna com informações sobre "PCD" incluída na listagem dos candidatos.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Contratações</b></h5>
                        <h5>- Ao executar a ação "Iniciar Processo" na tela de Contratações Pendentes fará com que a solicitação de contratação fique com o status de "Pedido Recebido".</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Custo</b></h5>
                        <h5>- Apareceção somente Solicitações que ainda não foram criadas o Pedido de Custo.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Homologação</b></h5>
                        <h5>- Incluido o campo Nivel nos Itens do Pedido de Homologacao.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Contratação</b></h5>
                        <h5>- Incluido a possibilidade de criar Pedidos de Contratação Especiais.</h5><br />

              <h4><b style="color: #337ab7;">Correções</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Geração de Arquivos</b></h5>
                        <h5>- Corrigido o nome do dia da semana que estava saindo em inglês.</h5>
                        <h5>- Os horários específicos para cada candidato não estavam aparecendo no arquivo.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Notificações</b></h5>
                        <h5>- Corrigido o link das notificações de Aprovação dos Pedidos de Custo, Homologação e Contratação.</h5><br />

                        <p><a href="index.php?r=site/versao" class="btn btn-warning" role="button">Histórico de Versões</a></p>
            </div>
        </div>
    </div>
</div>