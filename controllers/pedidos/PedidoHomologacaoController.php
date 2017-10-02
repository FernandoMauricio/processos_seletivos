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

        $searchModel = new PedidoHomologacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $session = Yii::$app->session;
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
        $model->homolog_unidade     = $model->contratacao->unidade;
        $model->homolog_motivo      = $model->contratacao->motivo;
        $model->homolog_cargo       = $model->contratacao->cargo0->descricao;
        $model->homolog_salario     = $model->contratacao->cargo_salario;
        $model->homolog_encargos    = $model->contratacao->cargo_encargos;
        $model->homolog_total       = $model->contratacao->cargo_valortotal;
        $model->homolog_tipo        = $model->contratacao->periodo;
        $model->homolog_data        = date('Y-m-d');
        $model->homolog_responsavel = $session['sess_nomeusuario'];
        $model->homolog_validade    = 'O processo de seleção terá validade de 12 meses, podendo ser prorrogado por mais 12 meses, a valer da data de homologação.';
        $model->homolog_sintese     = 'Segue o processo de recrutamento e seleção para [CARGO], do [UNIDADE], em virtude da necessidade de acompanhamento nas turmas de saúde, especialmente os Técnicos em Estética e Podologia, conforme pedido no portal nº [SOLICITAÇÃO], em anexo. Para este processo foram recebidos 231 currículos, tendo sido selecionados 20 currículos, conforme as exigências do perfil solicitado pelo gerente da unidade. Ao finalizar o processo seletivo que teve a participação da Supervisora Pedagógica Daniele Lima, da Analista Administrativa Sra. Keila Neves e do Auxiliar Administrativo o Sr. Israel Galvão, o(a) candidato(a) classificado(a) com o melhor desempenho foi o(a) Sr.(ª) [CANDIDATO] conforme tabela de classificação ao lado. No total ficaram classificados no processo seletivo 03 candidatos, de acordo com a descrição ao lado. Com isso solicitamos homologação do processo de seleção para prosseguirmos os tramites de contratação dos candidatos.';
        $model->save();

        //Localiza somente os candidatos classificados nas etapas do processo
        $sqlCandidatos = '
            SELECT
            `curriculos`.`nome`,
            `etapas_itens`.`itens_classificacao`
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
            ORDER BY `etapas_itens`.`itens_pontuacaototal` DESC' ;

        $candidatos = EtapasItens::findBySql($sqlCandidatos)->all();

        foreach ($candidatos as $candidato) {
                //Inclui as informações dos candidatos classificados
                Yii::$app->db->createCommand()
                    ->insert('pedidohomologacao_itens', [
                             'pedidohomologacao_id'     => $model->homolog_id,
                             'pedhomolog_classificacao' => $candidato['itens_classificacao'],
                             'pedhomolog_candidato'     => $candidato['nome'],
                             ])
                    ->execute();
            $model->save();
        }
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
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        $modelsItens = $model->pedidohomologacaoItens;

        $model->homolog_situacaoggp = 1; //Aguardando Autorização GPP
        $model->homolog_situacaodad = 1; //Aguardando Autorização DAD
        $model->homolog_data        = date('Y-m-d');
        $model->homolog_responsavel = $session['sess_nomeusuario'];

        //1 => Em elaboração / 2 => Em correção pelo setor / 3 => Recebido pelo GGP
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->andWhere(['!=','situacao_id', 3])->orderBy('id')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

            PedidohomologacaoItens::deleteAll('pedidohomologacao_id = "'.$id.'"');
            $model->delete(); //Exclui o pedido de homologação
            Yii::$app->session->setFlash('success', '<b>SUCESSO! </b> Pedido de Homologação excluido!</b>');
            return $this->redirect(['index']);
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
}
