<?php

namespace app\controllers\contratacao;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\contratacao\ContratacaoEncerradaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

use mPDF;

/**
 * ContratacaoEncerradaController implements the CRUD actions for Contratacao model.
 */
class ContratacaoEncerradaController extends Controller
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

    /**
     * Lists all Contratacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }

        $searchModel = new ContratacaoEncerradaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionImprimir($id) {

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'content' => $this->renderPartial('imprimir'),
                'options' => [
                    'title' => 'Recrutamento e Seleção - Senac AM',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                ],
                'methods' => [
                    'SetHeader' => ['SOLICITAÇÃO DE CONTRATAÇÃO - SENAC AM||Gerado em: ' . date("d/m/Y - H:i:s")],
                    'SetFooter' => ['Recrutamento e Seleção - GRH||Página {PAGENO}'],
                ]
            ]);

        return $pdf->render('imprimir', [
            'model' => $this->findModel($id),

        ]);
        }

    /**
     * Displays a single Contratacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }

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
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contratacao model.
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
     * Finds the Contratacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contratacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contratacao::findOne($id)) !== null) {
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

    public function AccessoAdministrador()
    {
            $this->layout = 'main-acesso-negado';
            return $this->render('/site/acesso_negado');
    }
}
