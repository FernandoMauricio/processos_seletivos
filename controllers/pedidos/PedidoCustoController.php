<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\pedidos\PedidoCusto;
use app\models\pedidos\PedidocustoItens;
use app\models\pedidos\PedidoCustoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * PedidoCustoController implements the CRUD actions for PedidoCusto model.
 */
class PedidoCustoController extends Controller
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
     * Lists all PedidoCusto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-admin-curriculos';

        $searchModel = new PedidoCustoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoCusto model.
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
    public function actionGetContratacao($contratacaoId){

        $connection = Yii::$app->db;
        $command = $connection->createCommand('
             SELECT
            `contratacao`.`unidade`,
            `cargos`.`descricao` AS `cargo_area`,
            `contratacao`.`quant_pessoa`,
            `contratacao`.`periodo`,
            `contratacao`.`cargo_area`,
            `contratacao`.`cargo_chsemanal`,
            `contratacao`.`cargo_salario`,
            `contratacao`.`cargo_encargos`,
            `contratacao`.`cargo_valortotal`
            FROM
            `contratacao`
            INNER JOIN `cargos` ON `contratacao`.`cargo_id` = `cargos`.`idcargo` 
            WHERE `id`='.$contratacaoId.'
            ');
            $command->queryAll();

        $getContratacao = Contratacao::findOne($contratacaoId);
        echo Json::encode($getContratacao);
    }

    /**
     * Creates a new PedidoCusto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $model       = new PedidoCusto();
        $contratacao = new Contratacao();
        $modelsItens = [new PedidocustoItens];

        //1 => Em elaboração / 2 => Em correção pelo setor
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->orderBy('id')->all();

        $model->custo_responsavel = $session['sess_nomeusuario'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Inserir vários itens
            $modelsItens = Model::createMultiple(PedidocustoItens::classname());
            Model::loadMultiple($modelsItens, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();

            if ($valid ) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsItens as $modelItens) {
                            $modelItens->pedidocusto_id = $model->custo_id;
                            $modelItens->contratacao_id = $contratacao->id;
                            if (! ($flag = $modelItens->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                    if ($flag) {
                        $transaction->commit();
                            
                        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo Cadastrado!</strong>');
                        return $this->redirect(['view', 'id' => $model->custo_id]);
                    }
                }
                }  catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo Cadastrado!</strong>');

            return $this->redirect(['view', 'id' => $model->custo_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'contratacao' => $contratacao,
                'contratacoes' => $contratacoes,
                'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
            ]);
        }
    }

    /**
     * Updates an existing PedidoCusto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->custo_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PedidoCusto model.
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
     * Finds the PedidoCusto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PedidoCusto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PedidoCusto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
