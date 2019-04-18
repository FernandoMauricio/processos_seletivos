<?php

namespace app\controllers\processoseletivo;

use Yii;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\processoseletivo\ProcessoSeletivoSearch;
use app\models\processoseletivo\Edital;
use app\models\processoseletivo\Anexos;
use app\models\processoseletivo\Adendos;
use app\models\processoseletivo\Resultados;
use app\models\processoseletivo\Cargos;
use app\models\processoseletivo\CargosProcesso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProcessoSeletivoController implements the CRUD actions for ProcessoSeletivo model.
 */
class ProcessoSeletivoController extends Controller
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionEncerrarProcessoAutomatico()
    {
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $connection = Yii::$app->db;
        $connection->createCommand()
            ->update('processo', [
                'situacao_id' => 2, //Situação Em Processo
            ], 
            [
                'situacao_id' => 1,
                'data_encer' => date('Y-m-d')
            ])->execute();
            
    }

    public function actionAberturaProcessoAutomatico()
    {
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $connection = Yii::$app->db;
        $connection->createCommand()
            ->update('processo', [
                'situacao_id' => 1, //Situação Processo Aberto
                'status_id' => 1, //Situação Visualização site
            ], 
            [
                'situacao_id' => 1,
                'data' => date('Y-m-d')
            ])->execute();
            
    }

    /**
     * Lists all ProcessoSeletivo models.
     * @return mixed
     */
    public function actionIndex()
    {
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else
        $this->layout = 'main-full';

        $searchModel = new ProcessoSeletivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProcessoSeletivo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProcessoSeletivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $model = new ProcessoSeletivo();

        $cargos = Cargos::find()->where(['status' => 1])->andWhere(['!=','homologacao', ''])->orderBy('descricao')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>O Processo Seletivo do edital <strong>'.$model->numeroEdital. '</strong> foi cadastrado no site!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cargos' => $cargos,
            ]);
        }
    }

    /**
     * Updates an existing ProcessoSeletivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else
        $model = $this->findModel($id);
        //CARGOS
        $cargos = Cargos::find()->orderBy(['descricao' => SORT_ASC])->where(['status' => 1])->all();
        //Retrieve the stored checkboxes
        $model->permissions = \yii\helpers\ArrayHelper::getColumn(
            $model->getCargosProcesso()->asArray()->all(),
            'cargo_id'
        );

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>O Processo Seletivo do edital <strong>' .$model->numeroEdital. '</strong> foi atualizado no site!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cargos' => $cargos,
            ]);
        }
    }

    public function actionEdital($id) 
    {
        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=processoseletivo/edital/index');
    }

    public function actionAnexos($id) 
    {

        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=processoseletivo/anexos/index');
    }

    public function actionAdendos($id) 
    {

        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=processoseletivo/adendos/index');
    }

    public function actionResultados($id) 
    {

        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=processoseletivo/resultados/index');
    }

    public function actionAtualizaProcessoSeletivoAutomaticamente() 
    {
        $this->layout = 'main-imprimir';
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE processo SET situacao_id = 2 WHERE situacao_id = 1 AND data_encer = ".date('"Y-m-d"')." ");
        $command->execute();
    }

    /**
     * Deletes an existing ProcessoSeletivo model.
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
     * Finds the ProcessoSeletivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProcessoSeletivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProcessoSeletivo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
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
           return $this->redirect('https://portalsenac.am.senac.br');
        }
    }
}
