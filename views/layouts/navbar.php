<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\nav\NavX;

?>

<?php
        $session = Yii::$app->session;
            NavBar::begin([
                //'brandLabel' => 'Processo Seletivo - Senac AM',
                'brandLabel' => '<img src="css/img/logo_senac_topo.png"/>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            


if($session['sess_codunidade'] == 7 && $session['sess_coddepartamento'] == 82 ){  //TEM QUE SER DO GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO


echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],
                
    'items' => [
        ['label' => 'Administração', 'items' => [

            ['label' => 'Controle - Contração', 'items' => [
            '<li class="dropdown-header">Controle - Contração</li>',
                ['label' => 'Contratações Pendentes', 'url' => ['/contratacao-pendente/index']],
                ['label' => 'Contratações Em Andamento', 'url' => ['/contratacao-em-andamento/index']],
                ['label' => 'Contratações Encerradas', 'url' => ['/contratacao-encerrada/index']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Processos Seletivos', 'items' => [
            '<li class="dropdown-header">Administração do site</li>',
                ['label' => 'Processos Seletivos', 'url' => ['/processo-seletivo/index']],
                ['label' => 'Listagem de Candidatos', 'url' => ['/curriculos-admin/index']],
            ]],


            '<li class="divider"></li>',
            ['label' => 'Configuração', 'items' => [
            '<li class="dropdown-header">Cadastros</li>',
                ['label' => 'Cargos', 'url' => ['/cargos/index']],
                ['label' => 'Sistemas', 'url' => ['/sistemas/index']],

            ]],
        ]],
        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/index']],

        ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

    ]
]); 

}else
//OUTROS USUÁRIOS

echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],
                
    'items' => [
        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/index']],
        
        ['label' => 'Sair', 'url' => 'http://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

    ]
]); 


NavBar::end();
        ?>