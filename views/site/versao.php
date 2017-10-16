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
                <div class="panel panel-primary">
                <div class="panel-heading"><i class="glyphicon glyphicon-star-empty"></i> Versão 1.9 - (ATUALMENTE) - Publicado em xx/08/2017</div>
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
                             <h5>- Rankeamento automático dos candidatos que estarão com a maior pontuação.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Cadastro de Reserva</b></h5>
                             <h5>- Inclusão de uma listagem de candidatos que ficaram como cadastro de reserva.</h5>
                             <h5>- Inclusão da validade de 1 ano para o candidato permanecer na listagem de cadastro de reserva a contar a partir da data de homologação do processo.</h5>
                             <h5>- Inclusão da data de expiração na listagem do cadastro de reserva.</h5>
        
                     <h5><i class="glyphicon glyphicon-tag"></i><b> Geração de Arquivos</b></h5>
                             <h5>- Poderá ser gerado arquivos em PDF contendo as informações dos classificados em cada etapa ou o resultado final para ser postado no site.</h5>
                </div>
           </div>

            <div class="panel panel-danger">
            <div class="panel-heading"><i class="glyphicon glyphicon-folder-close"></i> Versão 1.2 - Publicado em 19/04/2017</div>
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