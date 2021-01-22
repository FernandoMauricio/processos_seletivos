<?php

// use yii\bootstrap\Nav;
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

if($session['sess_codunidade'] == 7 && $session['sess_coddepartamento'] == 82 && $session['sess_responsavelsetor'] == 1) { //ACESSOS GERENTE - GGP

echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],

    'items' => [
        ['label' => 'Administração', 'items' => [

            ['label' => 'Contrações', 'items' => [
            '<li class="dropdown-header">Administração das Contrações</li>',
                ['label' => 'Contratações Pendentes', 'url' => ['/contratacao/contratacao-pendente/index']],
                ['label' => 'Contratações Em Andamento', 'url' => ['/contratacao/contratacao-em-andamento/index']],
                ['label' => 'Contratações Encerradas', 'url' => ['/contratacao/contratacao-encerrada/index']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Processos Seletivos', 'items' => [
            '<li class="dropdown-header">Administração do Site</li>',
                ['label' => 'Processos Seletivos', 'url' => ['/processoseletivo/processo-seletivo/index']],
                ['label' => 'Geração de Arquivos', 'url' => ['/processoseletivo/geracao-arquivos/index']],
            ]],


            '<li class="divider"></li>',
            ['label' => 'Curriculos', 'items' => [
            '<li class="dropdown-header">Administração dos Curriculos</li>',
                ['label' => 'Listagem de Candidatos', 'url' => ['/curriculos/curriculos-admin/index']],
                ['label' => 'Análise de Curriculos (Administrador)', 'url' => ['/curriculos/curriculos-admin/analise-gerencial-administrador']],
                ['label' => 'Banco de Curriculos', 'url' => ['/curriculos/curriculos-admin/banco-de-curriculos']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Pedidos', 'items' => [
                '<li class="dropdown-header">Administração dos Pedidos</li>',
                ['label' => 'Pedidos de Custo', 'url' => ['/pedidos/pedido-custo/index']],
                ['label' => 'Pedidos de Homologação', 'url' => ['/pedidos/pedido-homologacao/index']],
                ['label' => 'Pedidos de Contratação', 'url' => ['/pedidos/pedido-contratacao/index']],

            ]],

            '<li class="divider"></li>',
            ['label' => 'Etapas do Processo', 'items' => [
            '<li class="dropdown-header">Administração das Etapas do Processo</li>',
                ['label' => 'Etapas do Processo', 'url' => ['/etapasprocesso/etapas-processo/index']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Parâmetros', 'items' => [
            '<li class="dropdown-header">Cadastros</li>',
                ['label' => 'Cargos', 'url' => ['/processoseletivo/cargos/index']],
                ['label' => 'Sistemas', 'url' => ['/processoseletivo/sistemas/index']],
                ['label' => 'Aprovadores', 'url' => ['/pedidos/aprovacoes/index']],

            ]],
        ]
    ],

    ['label' => 'Aprovações GGP', 'items' => [

        '<li class="dropdown-header">Aprovações Pendentes GGP</li>',
        ['label' => 'Pedido de Custo', 'url' => ['/pedidos/pedido-custo/ggp-index']],
        ['label' => 'Pedido de Homologação', 'url' => ['/pedidos/pedido-homologacao/ggp-index']],
        ['label' => 'Pedido de Contratação', 'url' => ['/pedidos/pedido-contratacao/ggp-index']],

        ],
    ],

    ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/index']],

    ['label' => 'Cadastro de Reserva', 'url' => ['/curriculos/cadastro-de-reserva/index']],

    [
        'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
        'items' => [
                    '<li class="dropdown-header">Área Usuário</li>',
                        //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                        ['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                        ['label' => 'Sair', 'url' => 'https://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
               ],
        ],

    ]
]);

} elseif($session['sess_codunidade'] == 7 && $session['sess_coddepartamento'] == 82 ){  //TEM QUE SER DO GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO


echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],

    'items' => [
        ['label' => 'Administração', 'items' => [

            ['label' => 'Contrações', 'items' => [
            '<li class="dropdown-header">Administração das Contrações</li>',
                ['label' => 'Contratações Pendentes', 'url' => ['/contratacao/contratacao-pendente/index']],
                ['label' => 'Contratações Em Andamento', 'url' => ['/contratacao/contratacao-em-andamento/index']],
                ['label' => 'Contratações Encerradas', 'url' => ['/contratacao/contratacao-encerrada/index']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Processos Seletivos', 'items' => [
            '<li class="dropdown-header">Administração do Site</li>',
                ['label' => 'Processos Seletivos', 'url' => ['/processoseletivo/processo-seletivo/index']],
                ['label' => 'Geração de Arquivos', 'url' => ['/processoseletivo/geracao-arquivos/index']],
            ]],


            '<li class="divider"></li>',
            ['label' => 'Curriculos', 'items' => [
            '<li class="dropdown-header">Administração dos Curriculos</li>',
                ['label' => 'Listagem de Candidatos', 'url' => ['/curriculos/curriculos-admin/index']],
                ['label' => 'Análise de Curriculos (Administrador)', 'url' => ['/curriculos/curriculos-admin/analise-gerencial-administrador']],
                ['label' => 'Banco de Curriculos', 'url' => ['/curriculos/curriculos-admin/banco-de-curriculos']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Pedidos', 'items' => [
                '<li class="dropdown-header">Administração dos Pedidos</li>',
                ['label' => 'Pedidos de Custo', 'url' => ['/pedidos/pedido-custo/index']],
                ['label' => 'Pedidos de Homologação', 'url' => ['/pedidos/pedido-homologacao/index']],
                ['label' => 'Pedidos de Contratação', 'url' => ['/pedidos/pedido-contratacao/index']],

            ]],

            '<li class="divider"></li>',
            ['label' => 'Etapas do Processo', 'items' => [
            '<li class="dropdown-header">Administração das Etapas do Processo</li>',
                ['label' => 'Etapas do Processo', 'url' => ['/etapasprocesso/etapas-processo/index']],
            ]],

            '<li class="divider"></li>',
            ['label' => 'Parâmetros', 'items' => [
            '<li class="dropdown-header">Cadastros</li>',
                ['label' => 'Cargos', 'url' => ['/processoseletivo/cargos/index']],
                ['label' => 'Sistemas', 'url' => ['/processoseletivo/sistemas/index']],
                ['label' => 'Aprovadores', 'url' => ['/pedidos/aprovacoes/index']],

            ]],
        ]
    ],
//-------------------------------------------------------------
    // ['label' => 'Aprovações GGP', 'items' => [

    //     '<li class="dropdown-header">Aprovações Pendentes GGP</li>',
    //     ['label' => 'Pedido de Custo', 'url' => ['/pedidos/pedido-custo/ggp-index']],
    //     ['label' => 'Pedido de Homologação', 'url' => ['/pedidos/pedido-homologacao/ggp-index']],
    //     ['label' => 'Pedido de Contratação', 'url' => ['/pedidos/pedido-contratacao/ggp-index']],

    //     ],
    // ],

    // ['label' => 'Aprovações DAD', 'items' => [

    //     '<li class="dropdown-header">Aprovações Pendentes DAD</li>',
    //     ['label' => 'Pedido de Custo', 'url' => ['/pedidos/pedido-custo/dad-index']],
    //     ['label' => 'Pedido de Homologação', 'url' => ['/pedidos/pedido-homologacao/dad-index']],
    //     ['label' => 'Pedido de Contratação', 'url' => ['/pedidos/pedido-contratacao/dad-index']],

    //     ],
    // ],
//-------------------------------------------------------------
        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/index']],

        ['label' => 'Cadastro de Reserva', 'url' => ['/curriculos/cadastro-de-reserva/index']],

        [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                ['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'https://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                        ],
        ],

    ]
]);

}elseif($session['sess_codunidade'] == 8 && $session['sess_responsavelsetor'] == 1) { //ACESSOS GERENTE - DAD
    echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],

    'items' => [

        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/index']],

        ['label' => 'Análise de Curriculos', 'url' => ['/curriculos/curriculos-admin/analise-gerencial']],

        ['label' => 'Aprovações Pendentes DAD', 'items' => [

            '<li class="dropdown-header">Aprovações Pendentes DAD</li>',
            ['label' => 'Pedido de Custo', 'url' => ['/pedidos/pedido-custo/dad-index']],
            ['label' => 'Pedido de Homologação', 'url' => ['/pedidos/pedido-homologacao/dad-index']],
            ['label' => 'Pedido de Contratação', 'url' => ['/pedidos/pedido-contratacao/dad-index']],

            ],
        ],

        ['label' => 'Cadastro de Reserva', 'url' => ['/curriculos/cadastro-de-reserva/index']],

        [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                ['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'https://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                        ],
        ],

    ]
]);

}elseif($session['sess_codunidade'] == 3 && $session['sess_coddepartamento'] == 5 && $session['sess_responsavelsetor'] == 1) { //ACESSOS GERENTE - DRG
    echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],

    'items' => [

        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/index']],

        ['label' => 'Análise de Curriculos', 'url' => ['/curriculos/curriculos-admin/analise-gerencial']],


        ['label' => 'Aprovações DRG', 'items' => [

            '<li class="dropdown-header">Aprovações Pendentes DRG</li>',
            ['label' => 'Pedido de Custo', 'url' => ['/pedidos/pedido-custo/drg-index']],
            //['label' => 'Pedido de Homologação', 'url' => ['/pedidos/pedido-homologacao/drg-index']],
            ['label' => 'Pedido de Contratação', 'url' => ['/pedidos/pedido-contratacao/drg-index']],

            ],
        ],

        ['label' => 'Cadastro de Reserva', 'url' => ['/curriculos/cadastro-de-reserva/index']],

        [
            'label' => 'Usuário (' . utf8_encode(ucwords(strtolower($session['sess_nomeusuario']))) . ')',
            'items' => [
                         '<li class="dropdown-header">Área Usuário</li>',
                                //['label' => 'Alterar Senha', 'url' => ['usuario-usu/update', 'id' => $sess_codusuario]],
                                ['label' => 'Versões Anteriores', 'url' => ['/site/versao']],
                                ['label' => 'Sair', 'url' => 'https://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],
                        ],
        ],

    ]
]);

}else
//OUTROS USUÁRIOS

echo NavX::widget([

'options' => ['class' => 'navbar-nav navbar-right'],

    'items' => [
        ['label' => 'Solicitação de Contratação', 'url' => ['/contratacao/contratacao/index']],

        ['label' => 'Análise de Curriculos', 'url' => ['/curriculos/curriculos-admin/analise-gerencial']],

        ['label' => 'Cadastro de Reserva', 'url' => ['/curriculos/cadastro-de-reserva/index']],

        ['label' => 'Sair', 'url' => 'https://portalsenac.am.senac.br/portal_senac/control_base_vermodulos/control_base_vermodulos.php'],

    ]
]);


NavBar::end();

?>
