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

                    <!-- NOTIFICAÇÕES de Aprovações DRG - Pedido de Custo / Pedido de Contratação -->
                    <?php if($_SESSION['sess_codunidade'] == 3 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoCustoDRG > 0) { ?>
                    <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoDRG ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="https://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fdrg-index" class="alert-link">clique aqui.</a>
                    </div>
                    <?php } ?>

                    <?php if($_SESSION['sess_codunidade'] == 3 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoDRG > 0) { ?>
                    <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoDRG ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="https://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fdrg-index" class="alert-link">clique aqui.</a>
                    </div>

                    <?php } ?>
                </div>
            </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> O que há de novo? - Versão 2.5 - Publicado em 22/01/2021</div>
            <div class="panel-body">
            <h4><b style="color: #337ab7;">Implementações</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedidos de Contratação e Pedidos de Custo</b></h5>
                    <h5>- Incluído a Direção Regional para assinaturas eletrônicas.</h5>
                    <h5>- Retirado a área de assintura do Presidente.</h5>
                <br />
                <h5><i class="glyphicon glyphicon-tag"></i><b> Curriculos e Processo Seletivo </b></h5>
                    <h5>- Implementado novas posições de candidatos aprovados.</h5>
                    <h5>- Incluido novas cidades para escolha da selação de candidatos.</h5>
                    <h5>- Incluido a permissão de tipos .ppt para inclusão do Processo Seletivo.</h5>
                    <h5>- Implementado a exclusão de curriculos dos candidatos.</h5>
                    <br/ >
            <h4><b style="color: #337ab7;">Correções</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Curriculos, Processos Seletivos, Envio de Email</b></h5>
                    <h5>- Alterado algumas nomenclaturas no envio de e-mail.</h5>
                    <h5>- Corrigido o endereçamento de arquivos do Processo Seletivo.</h5>
                    <h5>- Corrigido campo de pesquisa dos candidatos.</h5>
                    <h5>- Corrigido os tipos de contratos dos Docentes.</h5>
                    <h5>- Retirado a área de assinatura do Presidente.</h5>
            <br/ ></div>
        </div>
    </div>
</div>