<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\pedidos\pedidohomologacao\PedidohomologacaoItens;
use app\models\pedidos\pedidohomologacao\PedidoHomologacao;
use app\models\pedidos\pedidohomologacao\PedidoHomologacaoSearch;
use app\models\pedidos\pedidohomologacao\PedidoHomologacaoAprovacaoGgpSearch;
use app\models\pedidos\pedidohomologacao\PedidoHomologacaoAprovacaoDadSearch;
use app\models\etapasprocesso\EtapasItens;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\db\Expression;

/**
 * PedidoHomologacaoController implements the CRUD actions for PedidoHomologacao model.
 */
class PedidoHomologacaoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $this->AccessAllow(); //Irá ser verificado se o usuário está logado no sistema
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PedidoHomologacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-full';
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $searchModel = new PedidoHomologacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {
                // instantiate your PedidoHomologacao model for saving
                $pedidoHomologacaoId = Yii::$app->request->post('editableKey');
                $model = PedidoHomologacao::findOne($pedidoHomologacaoId);

                // store a default json response as desired by editable
                $out = Json::encode(['output'=>'', 'message'=>'']);

                $posted = current($_POST['PedidoHomologacao']);
                $post = ['PedidoHomologacao' => $posted];

                // load model like any single model validation
                if ($model->load($post)) {
                    
                    //Atualiza a Data de Expiração 
                    $data_expiracao = new Expression('DATE_ADD("'.$model->homolog_datahomologacao.'", INTERVAL 1 YEAR)');

                    Yii::$app->db->createCommand()
                            ->update('pedidohomologacao_itens', [
                                     'pedhomolog_expiracao' => $data_expiracao, //Atualiza a Data de Expiração de acordo com a Data de Homologação
                                     ], [//------WHERE
                                     'pedidohomologacao_id' => $model->homolog_id,
                                     ]) 
                            ->execute();

                // can save model or do something before saving model
                $model->save(false);

                $output = '';

                $out = Json::encode(['output'=>$output, 'message'=>'']);
                }
                // return ajax json encoded response and exit
                echo $out;
                return $this->redirect(['index']);
            }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGgpIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoHomologacaoAprovacaoGgpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('ggp-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDadIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoHomologacaoAprovacaoDadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dad-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAprovarGgp($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Aprova o Pedido de Homologação
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_homologacao` SET `homolog_aprovadorggp` = '".$session['sess_nomeusuario']."', `homolog_situacaoggp` = '4', `homolog_dataaprovacaoggp` = ".date('"Y-m-d"')." WHERE `homolog_id` = '".$model->homolog_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Homologação <b> '.$model->homolog_id.' </b> foi Aprovado!</b>');

        return $this->redirect(['ggp-index']);
    }

    public function actionAprovarDad($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Aprovado o Pedido de Custo
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_homologacao` SET `homolog_aprovadordad` = '".$session['sess_nomeusuario']."', `homolog_situacaodad` = '4', `homolog_dataaprovacaodad` = ".date('"Y-m-d"')." WHERE `homolog_id` = '".$model->homolog_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Homologação <b> '.$model->homolog_id.' </b> foi Aprovado!</b>');

        return $this->redirect(['dad-index']);
    }


    public function actionReprovarGgp($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Reprova o Pedido de Homologação
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_homologacao` SET `homolog_aprovadorggp` = '".$session['sess_nomeusuario']."', `homolog_situacaoggp` = '3', `homolog_dataaprovacaoggp` = ".date('"Y-m-d"')." WHERE `homolog_id` = '".$model->homolog_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Homologação <b> '.$model->homolog_id.' </b> foi Reprovado!</b>');

        return $this->redirect(['ggp-index']);
    }

    public function actionReprovarDad($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Reprova o Pedido de Homologação
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_homologacao` SET `homolog_aprovadordad` = '".$session['sess_nomeusuario']."', `homolog_situacaodad` = '3', `homolog_dataaprovacaodad` = ".date('"Y-m-d"')." WHERE `homolog_id` = '".$model->homolog_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Homologação <b> '.$model->homolog_id.' </b> foi Reprovado!</b>');

        return $this->redirect(['dad-index']);
    }
    
    /**
     * Displays a single PedidoHomologacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'main-imprimir';
        setlocale(LC_ALL, "pt_BR", "pt_BR.ISO-8859-1", "pt_BR.UTF-8", "portuguese");

        $model = $this->findModel($id);
        $modelsItens = $model->pedidohomologacaoItens;

        return $this->render('view', [
            'model' => $model,
            'modelsItens' => $modelsItens,
        ]);
    }

    /**
     * Creates a new PedidoHomologacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PedidoHomologacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->homolog_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

        public function actionGerarPedidoHomologacao()
    {
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $model = new PedidoHomologacao();

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        $model->homolog_situacaoggp = 1; //Aguardando Autorização GPP
        $model->homolog_situacaodad = 1; //Aguardando Autorização DAD

        //1 => Em elaboração / 2 => Em correção pelo setor / 3 => Recebido pelo GGP / 5 - Finalizado
        $subQuery = PedidoHomologacao::find()->select('contratacao_id')->all();
        $contratacoes = Contratacao::find()
        ->innerJoinWith('pedidocustoItens', `pedidocusto_itens.contratacao_id` == `contratacao.id`)
        ->where(['NOT IN','situacao_id', [1, 2, 3, 5]])
        ->andWhere(['NOT IN','contratacao_id', $subQuery])
        ->orderBy('id')
        ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        $model->homolog_unidade         = $model->contratacao->unidade;
        $model->homolog_motivo          = $model->contratacao->motivo;
        $model->homolog_cargo           = $model->contratacao->cargo0->descricao;
        $model->homolog_salario         = $model->contratacao->cargo_salario;
        $model->homolog_encargos        = $model->contratacao->cargo_encargos;
        $model->homolog_total           = $model->contratacao->cargo_valortotal;
        $model->homolog_tipo            = $model->contratacao->periodo;
        $model->homolog_data            = date('Y-m-d');
        $model->homolog_datahomologacao = date('Y-m-d');
        $model->homolog_responsavel     = $session['sess_nomeusuario'];
        $model->homolog_validade        = 'O processo de seleção terá validade de 12 meses, podendo ser prorrogado por mais 12 meses, a valer da data de homologação.';
        $model->homolog_sintese         = 'Finalizado o processo de recrutamento e seleção para o [CARGO], do(a) [UNIDADE/SETOR], [MOTIVO DA CONTRATAÇÃO], conforme pedido no portal nº [SOLICITAÇÃO], em anexo. Para este processo foram recebidos [000] inscrições, tendo sido selecionados [000] inscrições, conforme as exigências do perfil solicitado pelo gerente da unidade/setor. Ao finalizar o processo seletivo que teve a participação do(a) [CARGO/SETOR, NOME DOS PARTICIPANTES], o(a) candidato(a) classificado(a) com o melhor desempenho foi o(a) Sr.(ª) [CANDIDATO]. No total ficaram classificados no processo seletivo [00] candidatos, de acordo com a tabela abaixo. Com isso solicitamos homologação do processo de seleção para prosseguirmos os tramites de contratação dos candidatos.';
        $model->save();

        //Localiza somente os candidatos classificados nas etapas do processo
        $sqlCandidatos = '
            SELECT
            `curriculos`.`edital`,
            `curriculos`.`numeroInscricao`,
            `curriculos`.`nome`,
            `etapas_itens`.`itens_classificacao`,
            `etapas_itens`.`curriculos_id`,
            `etapas_itens`.`itens_localcontratacao`,
            `etapas_itens`.`etapasprocesso_id`,
            `etapas_processo`.`etapa_cargo`
            FROM
            `etapas_itens`
            INNER JOIN `etapas_processo` ON `etapas_itens`.`etapasprocesso_id` = `etapas_processo`.`etapa_id`
            INNER JOIN `curriculos` ON `etapas_itens`.`curriculos_id` = `curriculos`.`id`
            INNER JOIN `pedido_custo` ON `etapas_processo`.`pedidocusto_id` = `pedido_custo`.`custo_id`
            INNER JOIN `pedidocusto_itens` ON `etapas_processo`.`pedidocusto_id` = `pedidocusto_itens`.`pedidocusto_id`
            INNER JOIN `contratacao` ON `pedidocusto_itens`.`contratacao_id` = `contratacao`.`id`
            WHERE `etapas_itens`.`itens_classificacao` NOT LIKE "%Desclassificado(a)%"
            AND `etapas_itens`.`itens_classificacao` NOT LIKE ""
            AND `pedidocusto_itens`.`contratacao_id` = '.$model->contratacao_id.'
            AND `curriculos`.`cargo` = "'.$model->homolog_cargo.'"
            AND `curriculos`.`edital` = "'.$model->edital.'"
            ORDER BY `etapas_itens`.`itens_pontuacaototal` DESC';

        $candidatos = EtapasItens::findBySql($sqlCandidatos)->all();

        //Calcula a data de expiração para 1 ano depois
        $data_expiracao = new Expression('DATE_ADD(NOW(), INTERVAL 1 YEAR)');

        foreach ($candidatos as $candidato) {
                //Inclui as informações dos candidatos classificados
                Yii::$app->db->createCommand()
                    ->insert('pedidohomologacao_itens', [
                             'pedidohomologacao_id'        => $model->homolog_id,
                             'curriculos_id'               => $candidato['curriculos_id'],
                             'pedhomolog_docabertura'      => $candidato['curriculos']['edital'],
                             'pedhomolog_numeroInscricao'  => $candidato['numeroInscricao'],
                             'pedhomolog_candidato'        => $candidato['nome'],
                             'pedhomolog_classificacao'    => $candidato['itens_classificacao'],
                             'pedhomolog_localcontratacao' => $candidato['itens_localcontratacao'],
                             'pedhomolog_cargo'            => $model->homolog_cargo,
                             'pedhomolog_data'             => $model->homolog_data,
                             'pedhomolog_expiracao'        => $data_expiracao,
                             'etapa_id'                    => $candidato['etapasprocesso_id'],
                            ])
                    ->execute();
            $model->save();
        }

        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Homologação Cadastrado!</b>');

            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('gerar-pedido-homologacao', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'processo' => $processo,
            ]);
        }
    }

    /**
     * Updates an existing PedidoHomologacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $model = $this->findModel($id);
        $modelsItens = $model->pedidohomologacaoItens;

        $model->homolog_situacaoggp = 1; //Aguardando Autorização GPP
        $model->homolog_situacaodad = 1; //Aguardando Autorização DAD
        $model->homolog_responsavel = $session['sess_nomeusuario'];

        //[4,7,8,9,10,11,12,13,14] -> Situações EM ANDAMENTO
        $contratacoes = Contratacao::find()->where(['IN','situacao_id', [4,7,8,9,10,11,12,13,14,15,16,17]])->orderBy('id')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Inclui os niveis de cada candidato
            foreach ($modelsItens as $i => $modelItens) {
            $modelItens->pedidohomologacao_id = $model->homolog_id;
            $modelItens->pedhomolog_nivel     = $_POST['PedidohomologacaoItens'][$i]['pedhomolog_nivel'];
            $modelItens->update(false); // skipping validation as no user input is involved
            }
            //Atualiza a Data de Expiração 
            $data_expiracao = new Expression('DATE_ADD("'.$model->homolog_datahomologacao.'", INTERVAL 1 YEAR)');

            Yii::$app->db->createCommand()
                    ->update('pedidohomologacao_itens', [
                             'pedhomolog_expiracao' => $data_expiracao, //Atualiza a Data de Expiração de acordo com a Data de Homologação
                             ], [//------WHERE
                             'pedidohomologacao_id' => $model->homolog_id,
                             ]) 
                    ->execute();

            Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Homologação Atualizado!</b>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'modelsItens' => $modelsItens,
            ]);
        }
    }

    /**
     * Deletes an existing PedidoHomologacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        //Verifica se já existe algum pedido de Contratação criado
        if(isset($model->pedidocontratacaoItens->contratacao_id)) {
            Yii::$app->session->setFlash('danger', '<b>ERRO! </b> Não é possível <b>EXCLUIR</b> pois já existe <b>Pedido de Contratação</b> criado para esse Pedido de Homologação.');
            return $this->redirect(['index']);
        }else{
            PedidohomologacaoItens::deleteAll('pedidohomologacao_id = "'.$id.'"');
            $model->delete(); //Exclui o pedido de custo
            Yii::$app->session->setFlash('success', '<b>SUCESSO! </b> Pedido de Homologação excluido!</b>');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the PedidoHomologacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PedidoHomologacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PedidoHomologacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function AccessAllow()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) 
            && !isset($session['sess_codcolaborador']) 
            && !isset($session['sess_codunidade']) 
            && !isset($session['sess_nomeusuario']) 
            && !isset($session['sess_coddepartamento']) 
            && !isset($session['sess_codcargo']) 
            && !isset($session['sess_cargo']) 
            && !isset($session['sess_setor']) 
            && !isset($session['sess_unidade']) 
            && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    }

    public function AccessoAdministrador()
    {
            $this->layout = 'main-acesso-negado';
            return $this->render('/site/acesso_negado');
    }
}
