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

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoGGP ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="http://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fggp-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>

                        <?php if($_SESSION['sess_codunidade'] == 7 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoGGP > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoGGP ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="http://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fggp-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>

                        <!-- NOTIFICAÇÕES de Aprovações DAD - Pedido de Custo / Pedido de Contratação -->
                        <?php if($_SESSION['sess_codunidade'] == 8 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoCustoDAD > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoCustoDAD ?> Pedido de Custo aguardando aprovação. Para visualizar, <a href="http://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-custo%2Fdad-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>

                        <?php if($_SESSION['sess_codunidade'] == 8 && $_SESSION['sess_responsavelsetor'] == 1 && $countPedidoContratacaoDAD > 0) { ?>

                        <div class="alert alert-danger" role="alert"> Você tem <?php echo $countPedidoContratacaoDAD ?> Pedido de Contratação aguardando aprovação. Para visualizar, <a href="http://portalsenac.am.senac.br/contratacao/web/index.php?r=pedidos%2Fpedido-contratacao%2Fdad-index" class="alert-link">clique aqui.</a>
                        </div>

                        <?php } ?>
                </div>
            </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> O que há de novo? - Versão 2.2 - Publicado em 11/04/2018</div>
            <div class="panel-body">
              <h4><b style="color: #337ab7;">Implementações</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Curriculos</b></h5>
                        <h5>- Incluído o campo "Estado Civil" e sua obrigatoriedade no cadastro do currículo.</h5>
                        <h5>- Incluído os campos de locais e data de conclusão para as formações: técnico, superior, pós-graduação, mestrado e doutorado.</h5>
                        <h5>- Incluído validações de obrigatoriedade caso o candidato marque como concluído as formações de técnico, superior, pós-graduação, mestrado e doutorado.</h5>
                        <h5>- Incluído os campos de local e carga horária na área de cadastro dos cursos complementares.</h5>
                        <h5>- Incluido validações de obrigatoriedade dos campos da área de empregos anteriores, caso o candidato escolha inserir essas informações.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Cargos</b></h5>
                        <h5>- Alterado o cálculo dos Cargos: CH Semanal passou a ser CH Mensal.</h5>
                        <h5>- Botão para inativação do cargo foi inserido na área de ações da listagem de cargos.</h5>
                        <h5>- Ocultado alguns campos na listagem de cargo: valor hora/aula, produtividade, 06 horas fixas, 1/6 fixas.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Etapas do Processo</b></h5>
                        <h5>- Permitido a escolha de várias cidades ao gerar as Etapas do Processo.</h5>
                        <h5>- Adicionado um botão que atualizará todos os candidatos selecionados após a criação das etapas do processo</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Homologação</b></h5>
                        <h5>- Data de expiração do cadastro de reserva será atualizada ao atualizar a data da homologação pela listagem dos Pedidos de Homologação. </h5><br />


              <h4><b style="color: #337ab7;">Correções</b></h4>
                <h5><i class="glyphicon glyphicon-tag"></i><b> Etapas do Processo</b></h5>
                        <h5>- Pequena correção na busca por código da contratação e pelo código do Pedido de Custo.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Pedido de Homologação</b></h5>
                        <h5>- Resolvido o problema na limitação de caracteres(255) do campo "motivo" do Pedido de Homologações.</h5>
                        <h5>- Data de expiração do cadastro de reserva será atualizada ao atualizar a data da homologação pelo index. </h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Etapas do Processo</b></h5>
                        <h5>- Pequena correção na busca por código da contratação e pelo código do Pedido de Custo.</h5>

                <h5><i class="glyphicon glyphicon-tag"></i><b> Contratações</b></h5>
                        <h5>- Retirado a duplicação do capo "motivo" na visualização da contratação.</h5><br />

                        <p><a href="index.php?r=site/versao" class="btn btn-warning" role="button">Histórico de Versões</a></p>
            </div>
        </div>
    </div>
</div>