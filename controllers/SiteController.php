<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\pedidos\pedidocusto\PedidoCusto;
use app\models\pedidos\pedidocontratacao\PedidoContratacao;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        //$this->AccessAllow(); //Irá ser verificado se o usuário está logado no sistema

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $session = Yii::$app->session;

    //VERIFICA SE O COLABORADOR É GERENTE PARA REALIZAR A SOLICITAÇÃO
    if($session['sess_responsavelsetor'] == 0 && $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $countPedidoCustoGGP = PedidoCusto::find()->where(['custo_situacaoggp' => 1])->count();
        $countPedidoCustoDAD = PedidoCusto::find()->where(['custo_situacaoggp' => 4])->andWhere(['custo_situacaodad' => 1])->count();
        $countPedidoCustoDRG = PedidoCusto::find()->where(['custo_situacaoggp' => 4])->andWhere(['custo_situacaodad' => 4])->andWhere(['custo_situacaodrg' => 1])->count();

        $countPedidoContratacaoGGP = PedidoContratacao::find()->where(['pedcontratacao_situacaoggp' => 1])->count();
        $countPedidoContratacaoDAD = PedidoContratacao::find()->where(['pedcontratacao_situacaoggp' => 4])->andWhere(['pedcontratacao_situacaodad' => 1])->count();
        $countPedidoContratacaoDRG = PedidoContratacao::find()->where(['pedcontratacao_situacaoggp' => 4])->andWhere(['pedcontratacao_situacaodad' => 4])->andWhere(['pedcontratacao_situacaodrg' => 1])->count();

        return $this->render('index',
        [
            'countPedidoCustoGGP' => $countPedidoCustoGGP,
            'countPedidoCustoDAD' => $countPedidoCustoDAD,
            'countPedidoCustoDRG' => $countPedidoCustoDRG,
            'countPedidoContratacaoGGP' => $countPedidoContratacaoGGP,
            'countPedidoContratacaoDAD' => $countPedidoContratacaoDAD,
            'countPedidoContratacaoDRG' => $countPedidoContratacaoDRG,
        ]);
    }

    public function actionVersao()
    {
        return $this->render('versao');
    }

}
