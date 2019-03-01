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
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> Versão 2.3 - Publicado em 22/06/2018</div>
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
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> Versão 2.2 - Publicado em 11/04/2018</div>
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
                            <h5>- Retirado a duplicação do capo "motivo" na visualização da contratação.</h5>
                </div>
            </div>

            <div class="panel panel-danger">
                <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> Versão 2.1 - Publicado em 24/11/2017</div>
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
                </div>
           </div>

            <div class="panel panel-danger">
                <div class="panel-heading"><i class="glyphicon glyphicon-folder-close"></i> Versão 2.0 - Publicado em 01/11/2017</div>
                 <div class="panel-body">
                   <h4><b style="color: #337ab7;">Implementações</b></h4>
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Contratações</b></h5>
                             <h5>- Inclusão das informações de cargos (Descrição do cargo, Nivel, CH Semanal, Salário, Encargos, Valor Total).</h5>
                             <h5>- Inclusão da Data de Admissão na listagem de Contratação. </h5>
                             <h5>- Visualização dos candidatos na listagem de Contratação com suas respectivas notas, informações pessoais e cronogramas em cada Etapa do Processo.</h5>
                             <h5>- Reformulação no cadastro dos Cargos, incluindo agora as informações de: salário, nível, Ch Semanal, Valor Hora, 1/6 RSR, Produtividade, 06h Fixas, 1/6 Fixas, Salário Bruto e Valor Total.</h5>
                             <h5>- Os cargos somente aparecerão na solicitação de contratação caso estejam homologados pelo gerente do GGP.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Análise de Currículos / Análise de Currículos(Administrador)</b></h5>
                             <h5>- Inclusão da tela para gerência solicitante de análise dos candidatos pré-selecionados pelo GGP.</h5>
                             <h5>- Caso a gerência solicitante não possa aprovar os candidatos, criamos uma tela para que o GGP também possa aprovar como gerência solicitante.</h5>
                             <h5>- Registros de Aprovações/Reprovações dos candidatos ficarão na ficha do mesmo.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Candidatos</b></h5>
                             <h5>- Melhorias no layout da ficha de inscrição na área de cursos complementares, empregos anteriores. </h5>
                             <h5>- Inclusão de 3 Termos de Declaração (De acordo, Declaração de Parentesco, Declaração de veracidade das informações).</h5>
                             <h5>- Inclusão do campo de assinatura para o candidato na impressão da ficha.</h5>
                             <h5>- Inclusão do histórico das Aprovações/Reprovações do GGP e da Gerência solicitante na ficha do candidato.</h5>
                             <h5>- Pesquisa avançada dos candidatos e melhoria na busca por situações, gêneros, bairros, formações, etc...</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Pedidos (Custo, Homologação e Contratação) </b></h5>
                             <h5>- Inclusão de novas regras de negóco.</h5>
                             <h5>- Aprovações/Reprovações eletrônicas do GGP e DAD para os 3 tipos de pedido.</h5>
                             <h5>- Ao homologar um Pedido de Contratação, o sistema automaticamente desclassificará todos que não estiverem no cadastro de reserva. E para o 1º colocado, o mesmo ficará como contratado.</h5>
                             <h5>- Caso o Pedido de Contratação for homologado, o mesmo não poderá mais ser excluído.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Etapas do Processo</b></h5>
                             <h5>- Inclusão de informações (local da realização do processo, data da realização, notas, classificação, destino, etc...) dos candidatos selecionados pelo GGP e Gerência solicitante</h5>
                             <h5>- ranqueamento automático dos candidatos que estarão com a maior pontuação.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Cadastro de Reserva</b></h5>
                             <h5>- Inclusão de uma listagem de candidatos que ficaram como cadastro de reserva.</h5>
                             <h5>- Inclusão da validade de 1 ano para o candidato permanecer na listagem de cadastro de reserva a contar a partir da data de homologação do processo.</h5>
                             <h5>- Inclusão da data de expiração na listagem do cadastro de reserva.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Geração de Arquivos</b></h5>
                             <h5>- Poderá ser gerado arquivos em PDF contendo as informações dos classificados em cada etapa ou o resultado final para ser postado no site.</h5>
                </div>
            </div>
            
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="glyphicon glyphicon-folder-close"></i> Versão 1.1 - Publicado em 19/04/2017</div>
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