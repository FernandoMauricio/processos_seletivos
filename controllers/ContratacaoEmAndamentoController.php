<?php

namespace app\controllers;

use Yii;
use app\models\Contratacao;
use app\models\ContratacaoEmAndamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratacaoEmAndamentoController implements the CRUD actions for Contratacao model.
 */
class ContratacaoEmAndamentoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contratacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContratacaoEmAndamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contratacao model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contratacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contratacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Contratacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionEncerrar($id)
    {

     $model = $this->findModel($id);

     //encerra a comunicacao que está em Circulação
     $session = Yii::$app->session;
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `processos_db`.`contratacao` SET `situacao_id` = '5' WHERE `id` = '".$model->id."' AND `cod_unidade_solic` =" . $session['sess_codunidade']);
    $command->execute();

Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Processo Seletivo <strong>ENCERRADO</strong>!</strong>');
     
return $this->redirect(['index']);

    }

    public function actionCorrecao($id)
    {

     $model = $this->findModel($id);

     //envia para correção a contratação que está em recebido pelo GRH
     $session = Yii::$app->session;
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `processos_db`.`contratacao` SET `situacao_id` = '2' WHERE `id` = '".$model->id."' AND `cod_unidade_solic` =" . $session['sess_codunidade']);
     $command->execute();

Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Contratação enviada <strong>PARA CORREÇÃO</strong>!</strong>');
     
return $this->redirect(['index']);

    }

    public function actionCancelar($id)
    {

     $model = $this->findModel($id);

     //envia para correção a contratação que está em recebido pelo GRH
     $session = Yii::$app->session;
     $connection = Yii::$app->db;
     $command = $connection->createCommand(
     "UPDATE `processos_db`.`contratacao` SET `situacao_id` = '6' WHERE `id` = '".$model->id."' AND `cod_unidade_solic` =" . $session['sess_codunidade']);
     $command->execute();

Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Contratação enviada <strong>CANCELADA</strong>!</strong>');
     
return $this->redirect(['index']);

    }



    /**
     * Deletes an existing Contratacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contratacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Contratacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contratacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
