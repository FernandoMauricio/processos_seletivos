<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
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

                // fetch the first entry in posted data (there should only be one entry 
                // anyway in this array for an editable submission)
                // - $posted is the posted data for PedidoHomologacao without any indexes
                // - $post is the converted array for single model validation
                $posted = current($_POST['PedidoHomologacao']);
                $post = ['PedidoHomologacao' => $posted];

                // load model like any single model validation
                if ($model->load($post)) {
                // can save model or do something before saving model
                $model->save(false);

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if data was posted for the PedidoHomologacao model
                // if (isset($posted['data'])) {
                // $output = Yii::$app->formatter->asDecimal($model->data, 2);
                // }

                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = Json::encode(['output'=>$output, 'message'=>'']);
                }
                // return ajax json encoded response and exit
                echo $out;
                return;

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

        $model->homolog_situacaoggp = 1; //Aguardando Autorização GPP
        $model->homolog_situacaodad = 1; //Aguardando Autorização DAD

        //1 => Em elaboração / 2 => Em correção pelo setor / 3 => Recebido pelo GGP
        $subQuery = PedidoHomologacao::find()->select('contratacao_id')->all();
        $contratacoes = Contratacao::find()
        ->innerJoinWith('pedidocustoItens', `pedidocusto_itens.contratacao_id` == `contratacao.id`)
        ->where(['!=','situacao_id', 1])
        ->andWhere(['!=','situacao_id', 2])
        ->andWhere(['!=','situacao_id', 3])
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
        $model->homolog_sintese         = 'Segue o processo de recrutamento e seleção para [CARGO], do [UNIDADE], em virtude da necessidade de acompanhamento nas turmas de saúde, especialmente os Técnicos em Estética e Podologia, conforme pedido no portal nº [SOLICITAÇÃO], em anexo. Para este processo foram recebidos 231 currículos, tendo sido selecionados 20 currículos, conforme as exigências do perfil solicitado pelo gerente da unidade. Ao finalizar o processo seletivo que teve a participação da Supervisora Pedagógica Daniele Lima, da Analista Administrativa Sra. Keila Neves e do Auxiliar Administrativo o Sr. Israel Galvão, o(a) candidato(a) classificado(a) com o melhor desempenho foi o(a) Sr.(ª) [CANDIDATO] conforme tabela de classificação ao lado. No total ficaram classificados no processo seletivo 03 candidatos, de acordo com a descrição ao lado. Com isso solicitamos homologação do processo de seleção para prosseguirmos os tramites de contratação dos candidatos.';
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
