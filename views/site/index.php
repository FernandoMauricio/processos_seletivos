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
            <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> O que há de novo? - Versão 2.3 - Publicado em 22/06/2018</div>
            <div class="panel-body">
              <h4><b style="color: #337ab7;">Implementações</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Etapas do Processo</b></h5>
                    <h5>- Incluido a coluna "Prática" para o tipo Administrativo.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Curriculos</b></h5>
                    <h5>- Implementado os campos <b style="color: #e74c3c;">não-obrigatórios</b> no cadastro de curriculos para que o candidato possa informar seu <b style="color: #2980b9;">Facebook</b> e <b style="color: #2980b9;">Linkedin.</b></h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Homologação</b></h5>
                    <h5>- Implementado o botão para homologar o pedido, para que o mesmo possar ser bloqueado para atualizações e/ou exclusões.</h5>
                    <h5>- Alterado o layout de impressão para paisagem.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Custos</b></h5>
                    <h5>- Implementado o botão para homologar o pedido de custo, para que o mesmo possar ser bloqueado para atualizações e/ou exclusões.</h5>
                    <h5>- Alterado o layout de impressão para paisagem.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Contratação</b></h5>
                    <h5>- Caso o cargo escolhido seja para docente, o campo nível ficará como <b style="color: #e74c3c;">obrigatório</b>.</h5><br/ >
            </div>
        </div>
    </div>
</div>