<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\pedidos\pedidocusto\PedidoCusto;
use app\models\pedidos\pedidocusto\PedidocustoItens;
use app\models\pedidos\pedidocusto\PedidoCustoSearch;
use app\models\pedidos\pedidocusto\PedidoCustoAprovacaoGgpSearch;
use app\models\pedidos\pedidocusto\PedidoCustoAprovacaoDadSearch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

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
        $this->layout = 'main-full';

        $searchModel = new PedidoCustoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGgpIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoCustoAprovacaoGgpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('ggp-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDadIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoCustoAprovacaoDadSearch();
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

        //Classifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_custo` SET `custo_aprovadorggp` = '".$session['sess_nomeusuario']."', `custo_situacaoggp` = '2', `custo_dataaprovacaoggp` = ".date('"Y-m-d"')." WHERE `custo_id` = '".$model->custo_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo <strong> '.$model->custo_id.' </strong> foi Aprovado!</strong>');

        return $this->redirect(['ggp-index']);
    }
    
    public function actionAprovarDad($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Classifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_custo` SET `custo_aprovadordad` = '".$session['sess_nomeusuario']."', `custo_situacaodad` = '5', `custo_dataaprovacaodad` = ".date('"Y-m-d"')." WHERE `custo_id` = '".$model->custo_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo <strong> '.$model->custo_id.' </strong> foi Aprovado!</strong>');

        return $this->redirect(['dad-index']);
    }


    public function actionReprovarGgp($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Classifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_custo` SET `custo_aprovadorggp` = '".$session['sess_nomeusuario']."', `custo_situacaoggp` = '3', `custo_dataaprovacaoggp` = ".date('"Y-m-d"')." WHERE `custo_id` = '".$model->custo_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo <strong> '.$model->custo_id.' </strong> foi Reprovado!</strong>');

        return $this->redirect(['ggp-index']);
    }

    public function actionReprovarDad($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Classifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_custo` SET `custo_aprovadordad` = '".$session['sess_nomeusuario']."', `custo_situacaodad` = '3', `custo_dataaprovacaodad` = ".date('"Y-m-d"')." WHERE `custo_id` = '".$model->custo_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo <strong> '.$model->custo_id.' </strong> foi Reprovado!</strong>');

        return $this->redirect(['ggp-index']);
    }

    /**
     * Displays a single PedidoCusto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'main-imprimir';
        
        $model = $this->findModel($id);

        $modelsItens = $model->pedidocustoItens;

        return $this->render('view', [
            'model' => $model,
            'modelsItens' => $modelsItens,
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
        $session     = Yii::$app->session;
        $model       = new PedidoCusto();
        $modelsItens = [new PedidocustoItens];

        $model->custo_situacaoggp = 1; //Aguardando Autorização GPP
        $model->custo_situacaodad = 1; //Aguardando Autorização DAD
        $model->custo_data        = date('Y-m-d');
        $model->custo_responsavel = $session['sess_nomeusuario'];
        $model->custo_recursos    = 'PRÓPRIOS';

        //1 => Em elaboração / 2 => Em correção pelo setor
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->orderBy('id')->all();

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
                            if (! ($flag = $modelItens->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                    if ($flag) {
                            //Verifica se existe já a contratação inserida anterioemente em algum pedido de custo
                            foreach ($modelsItens as $i => $modelItens) {
                            if(PedidocustoItens::find()->where(['contratacao_id' => $_POST['PedidocustoItens'][$i]['contratacao_id']])->count() >= 2) {
                                Yii::$app->session->setFlash('danger', '<b>ERRO! </b>Solicitação <b>'.$_POST['PedidocustoItens'][$i]['contratacao_id'].'</b> já inserida no Pedido de Custo!</b>');
                                return $this->redirect(['update', 'id' => $model->custo_id]);
                                }
                            }
                    $model->save();
                    $transaction->commit();
                            
                        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo Cadastrado!</strong>');
                       return $this->redirect(['index']);
                    }
                }
                }  catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo Cadastrado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'modelsItens' => $modelsItens,
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
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        $modelsItens = $model->pedidocustoItens;

        $model->custo_situacaoggp = 1; //Aguardando Autorização GPP
        $model->custo_situacaodad = 1; //Aguardando Autorização DAD
        $model->custo_data = date('Y-m-d');
        $model->custo_responsavel = $session['sess_nomeusuario'];

        //1 => Em elaboração / 2 => Em correção pelo setor
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->orderBy('id')->all();

        if ($model->load(Yii::$app->request->post())) {

        //--------Itens do Pedido de Custo--------------
        $oldIDsItens = ArrayHelper::map($modelsItens, 'id', 'id');
        $modelsItens = Model::createMultiple(PedidocustoItens::classname(), $modelsItens);
        Model::loadMultiple($modelsItens, Yii::$app->request->post());
        $deletedIDsItens = array_diff($oldIDsItens, array_filter(ArrayHelper::map($modelsItens, 'id', 'id')));

        // validate all models
        $valid = $model->validate();
        $valid = (Model::validateMultiple($modelsItens) && $valid);

                        if ($valid) {
                            $transaction = \Yii::$app->db->beginTransaction();
                            try {
                                if ($flag = $model->save(false)) {
                                    if (! empty($deletedIDsItens)) {
                                        PedidocustoItens::deleteAll(['id' => $deletedIDsItens]);
                                    }
                                    foreach ($modelsItens as $modelItens) {
                                        $modelItens->pedidocusto_id = $model->custo_id;
                                        if (! ($flag = $modelItens->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }
                                }

                               if ($flag) {
                                    //Verifica se existe já a contratação inserida anterioemente em algum pedido de custo
                                    foreach ($modelsItens as $i => $modelItens) {
                                    if(PedidocustoItens::find()->where(['contratacao_id' => $_POST['PedidocustoItens'][$i]['contratacao_id']])->count() >= 2) {
                                        Yii::$app->session->setFlash('danger', '<b>ERRO! </b>Solicitação <b>'.$_POST['PedidocustoItens'][$i]['contratacao_id'].'</b> já inserida no Pedido de Custo!</b>');
                                        return $this->redirect(['update', 'id' => $model->custo_id]);
                                        }
                                    }
                        $model->save();
                        $transaction->commit();
                            
                        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo Atualizado!</strong>');
                       return $this->redirect(['index']);
                    }
                }catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Pedido de Custo Atualizado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'modelsItens' => (empty($modelsItens)) ? [new PedidocustoItens] : $modelsItens,
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
        $model = $this->findModel($id);
        PedidocustoItens::deleteAll('pedidocusto_id = "'.$id.'"');
        $model->delete(); //Exclui a etapa do processo

        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Pedido de Custo excluido!</strong>');

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
