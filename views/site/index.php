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
                    <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoGGP ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="https://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fggp-index" class="alert-link">clique aqui.</a>
                    </div>
                    <?php } ?>

                    <?php if($_SESSION['sess_codunidade'] == 7 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoGGP > 0) { ?>
                    <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoGGP ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="https://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fggp-index" class="alert-link">clique aqui.</a>
                    </div>
                    <?php } ?>

                    <!-- NOTIFICAÇÕES de Aprovações DAD - Pedido de Custo / Pedido de Contratação -->
                    <?php if($_SESSION['sess_codunidade'] == 8 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoCustoDAD > 0) { ?>
                    <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoDAD ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="https://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fdad-index" class="alert-link">clique aqui.</a>
                    </div>
                    <?php } ?>

                    <?php if($_SESSION['sess_codunidade'] == 8 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoDAD > 0) { ?>
                    <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoDAD ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="https://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fdad-index" class="alert-link">clique aqui.</a>
                    </div>

                    <?php } ?>
                </div>
            </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> O que há de novo? - Versão 2.4 - Publicado em 01/03/2019</div>
            <div class="panel-body">
            <h4><b style="color: #337ab7;">Implementações</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedidos de Contratação, Homologação, Custo e Etapas do Processo</b></h5>
                    <h5>- Ordenação decrescente dos pedidos de custo, homologação e contratacao e também das etapas do processo.</h5>
                    <h5>- Tela de Contratações Pendentes irão aparecer solicitações com a situação: <b style="color: #2980b9;">Recebido pelo GGP</b> e <b style="color: #2980b9;">Em correção pelo setor</b>.</h5>
                    <h5>- Tela de Contratações Encerradas irão aparecer também as <b style="color: #2980b9;">solicitações canceladas</b>.</h5>
                    <h5>- Incluido a informação na impressão da tela de Pedido de Contratação para contratações especiais.</h5>
                    <h5>- Incluído número do edital na tabela de pontuação geral das avaliação na tela de Etapas do Processo.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Geração de Arquivos</b></h5>
                <h5>- Retirado o requisito de cidade na busca por candidatos na Geração de Arquivos.</h5>
                <h5>- Implementado a opção para inserção de múltiplos e-emails na Geração de Arquivos.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Banco de Currículos</b></h5>
                    <h5>- Melhorias na filtragem do banco de currículos. </h5>
                <br/ >
            <h4><b style="color: #337ab7;">Correções</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Envio de Email</b></h5>
                    <h5>- Corrigido o problema de duplicidade no envio de e-mails ao GGP.</h5>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Etapas do Processo</b></h5>
                    <h5>- Melhoria na consulta de informações onde é mostrado as Etapas do Processo para os Gerentes.</h5>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Aprovações de Candidatos</b></h5>
                <h5>- As informação sobre a aprovação dos candidatos agora aparecerão antes de ser enviado para a gerência solicitante.</h5>

            <br/ ></div>
        </div>
    </div>
</div>