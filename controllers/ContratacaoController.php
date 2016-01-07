<?php

namespace app\controllers;

use Yii;
use app\models\Contratacao;
use app\models\ContratacaoSearch;
use app\models\SituacaoContratacao;
use app\models\SituacaoContratacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratacaoController implements the CRUD actions for Contratacao model.
 */
class ContratacaoController extends Controller
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
        $searchModel = new ContratacaoSearch();
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

        $session = Yii::$app->session;
            $model->cod_colaborador     = $session['sess_codcolaborador'];
            $model->colaborador         = $session['sess_nomeusuario'];
            $model->cod_unidade_solic   = $session['sess_codunidade'];
            $model->unidade             = $session['sess_unidade'];
            $model->data_solicitacao    = date('Y-m-d');
            $model->hora_solicitacao    = date('h:m:s');
            $model->nomesituacao        = 'Em Elaboração';
            $model->situacao_id         = '1';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Quando a solicitação é enviada, atualiza a solicitação para RECEBIDO PELO GRH.
            $connection = Yii::$app->db;
            $command = $connection->createCommand(
            "UPDATE `processos_db`.`contratacao` SET `situacao_id` = '3' WHERE `id` = '".$model->id."' AND `cod_unidade_solic` =" . $session['sess_codunidade']);
            $command->execute();

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Processo Seletivo de código <strong>' .$model->id. '</strong> foi enviada para a Gerência de Recursos Humanos!</strong>');

            return $this->redirect(['index']);
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

        //USUÁRIOS APENAS IRÃO EDITAR AS SOLICITAÇÕES DE CONTRATAÇÃO COM STATUS DE 'EM ELABORAÇÃO' e 'EM CORREÇÃO'
        if($model->situacao_id != 1 && $model->situacao_id != 2 ){

        Yii::$app->session->setFlash('warning', '<strong>AVISO! </strong> Não é possível <strong>EDITAR</strong> a Solicitação de Contratação de código: ' . '<strong>' .$id. '</strong>' . ' pois a mesma está com status de  ' . '<strong>' . $model->situacao->descricao . '.</strong>');

        return $this->redirect(['index']);
        }

        $session = Yii::$app->session;
            $model->cod_colaborador     = $session['sess_codcolaborador'];
            $model->colaborador         = $session['sess_nomeusuario'];
            $model->cod_unidade_solic   = $session['sess_codunidade'];
            $model->unidade             = $session['sess_unidade'];
            $model->data_solicitacao    = date('Y-m-d');
            $model->hora_solicitacao    = date('h:m:s');
            $model->nomesituacao        = $model->situacao->descricao;
            

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Quando a solicitação é enviada, atualiza a solicitação para RECEBIDO PELO GRH.
            $connection = Yii::$app->db;
            $command = $connection->createCommand(
            "UPDATE `processos_db`.`contratacao` SET `situacao_id` = '3' WHERE `id` = '".$model->id."' AND `cod_unidade_solic` =" . $session['sess_codunidade']);
            $command->execute();


            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> A solicitação de Processo Seletivo de código <strong>' .$model->id. '</strong> foi enviada para a Gerência de Recursos Humanos!</strong>');
           
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contratacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        //USUÁRIOS APENAS IRÃO EXCLUIR AS SOLICITAÇÕES DE CONTRATAÇÃO COM STATUS DE 'EM ELABORAÇÃO' e 'EM CORREÇÃO'
        if($model->situacao_id != 1 && $model->situacao_id != 2 ){

        Yii::$app->session->setFlash('danger', '<strong>ERRO! </strong> Não é possível <strong>EXCLUIR</strong> a Solicitação de Contratação de código: ' . '<strong>' .$id. '</strong>' . ' pois a mesma está com status de  ' . '<strong>' . $model->situacao->descricao . '.</strong>');

        return $this->redirect(['index']);
        }
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
