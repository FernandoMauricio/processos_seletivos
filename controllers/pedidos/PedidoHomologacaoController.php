<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\pedidos\pedidohomologacao\PedidoHomologacao;
use app\models\pedidos\pedidohomologacao\PedidoHomologacaoSearch;
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
        $searchModel = new PedidoHomologacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoHomologacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Localiza os dados da contratação
    public function actionGetContratacaoCandidatosAprovados($contratacaoId){

        $connection = Yii::$app->db;
        $command = $connection->createCommand('
             SELECT
            `curriculos`.`nome`,
            `pedidocusto_itens`.`contratacao_id`,
            `contratacao`.`quant_pessoa`,
            `contratacao`.`periodo`,
            `contratacao`.`cargo_chsemanal`,
            `contratacao`.`cargo_salario`,
            `contratacao`.`cargo_encargos`,
            `contratacao`.`cargo_valortotal`,
            `contratacao`.`motivo`,
            `contratacao`.`data_ingresso_prevista`
            FROM
            `etapas_itens`
            INNER JOIN `etapas_processo` ON `etapas_itens`.`etapasprocesso_id` = `etapas_processo`.`etapa_id`
            INNER JOIN `curriculos` ON `etapas_itens`.`curriculos_id` = `curriculos`.`id`
            INNER JOIN `pedido_custo` ON `etapas_processo`.`pedidocusto_id` = `pedido_custo`.`custo_id`
            INNER JOIN `pedidocusto_itens` ON `etapas_processo`.`pedidocusto_id` = `pedidocusto_itens`.`pedidocusto_id`
            INNER JOIN `contratacao` ON `pedidocusto_itens`.`contratacao_id` = `contratacao`.`id`
            WHERE `pedidocusto_itens`.`contratacao_id` ='.$contratacaoId.'
            ');
        $queryResult = $command->queryAll();
        echo Json::encode($queryResult);

        // $connection = Yii::$app->db;
        // $command = $connection->createCommand('
            //  SELECT
            // `contratacao`.`unidade`,
            // `pedidocontratacao_itens`.`itemcontratacao_nome`,
            // `etapas_processo`.`etapa_local`,
            // `etapas_itens`.`itens_escrita`,
            // `cargos`.`descricao` AS `cargo_descricao`,
            // `contratacao`.`quant_pessoa`,
            // `contratacao`.`periodo`,
            // `contratacao`.`cargo_area`,
            // `contratacao`.`cargo_chsemanal`,
            // `contratacao`.`cargo_salario`,
            // `contratacao`.`cargo_encargos`,
            // `contratacao`.`cargo_valortotal`,
            // `contratacao`.`motivo`,
            // `contratacao`.`data_ingresso_prevista`
            // FROM
            // `contratacao`
            // INNER JOIN `cargos` ON `contratacao`.`cargo_id` = `cargos`.`idcargo`
            // INNER JOIN `pedidocontratacao_itens` ON `contratacao`.`id` = `pedidocontratacao_itens`.`contratacao_id`
            // INNER JOIN `etapas_processo` ON `pedidocontratacao_itens`.`etapasprocesso_id` = `etapas_processo`.`etapa_id`
            // INNER JOIN `etapas_itens` ON `etapas_processo`.`etapa_id` = `etapas_itens`.`etapasprocesso_id`
            // WHERE `contratacao`.`id`='.$contratacaoId.'

        //     ');
        // $queryResult = $command->queryOne();
        // echo Json::encode($queryResult);
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
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->andWhere(['!=','situacao_id', 3])->orderBy('id')->all();

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

            return $this->redirect(['view', 'id' => $model->homolog_id]);
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

        $model->homolog_situacaoggp = 1; //Aguardando Autorização GPP
        $model->homolog_situacaodad = 1; //Aguardando Autorização DAD
        $model->homolog_data        = date('Y-m-d');
        $model->homolog_responsavel = $session['sess_nomeusuario'];

        //1 => Em elaboração / 2 => Em correção pelo setor / 3 => Recebido pelo GGP
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->andWhere(['!=','situacao_id', 3])->orderBy('id')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->homolog_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'contratacoes' => $contratacoes,
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
        $this->findModel($id)->delete();

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
