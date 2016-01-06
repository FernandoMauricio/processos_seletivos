<?php

namespace app\controllers;

use Yii;
use app\models\Curriculos;
use app\models\CurriculosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * CurriculosController implements the CRUD actions for Curriculos model.
 */
class CurriculosController extends Controller
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
     * Lists all Curriculos models.
     * @return mixed
     */
    public function actionIndex()
    {
    $session = Yii::$app->session;
     $codunidade   = $session['sess_codunidade'];
     $session->close();
     if($codunidade == 7){
        $searchModel = new CurriculosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else{
        $this->layout = 'main-acesso-negado';
        return $this->render('../site/acesso_negado');
        }
    }
    /**
     * Displays a single Curriculos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    $session = Yii::$app->session;
     $codunidade   = $session['sess_codunidade'];
     $session->close();
     if($codunidade == 7){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }else{
        $this->layout = 'main-acesso-negado';
        return $this->render('../site/acesso_negado');
        }
    }

    /**
     * Creates a new Curriculos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Curriculos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cv_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Curriculos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cv_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionImprimir($id) {

            $model = $this->findModel($id);

            $cv_id = $model->cv_id;
            $cv_numeroEdital = $model->cv_numeroEdital;
            $cv_cargo = $model->cv_cargo;
            $cv_nome = $model->cv_nome;
            $cv_datanascimento = $model->cv_datanascimento;
            $cv_email = $model->cv_email;
            $cv_telefone = $model->cv_telefone;
            $cv_resumocv = $model->cv_resumocv;
            $cv_data = $model->cv_data;
            $cv_email2 = $model->cv_email2;
            $cv_telefone2 = $model->cv_telefone2;

            //BUSCA NO BANCO SE EXISTE DESTINOS PARA A CI
             $curriculos = Curriculos::find()
                ->where(['cv_id' => $_GET])
                ->all();



            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                
                'content' => $this->renderPartial('imprimir'),
                'options' => [
                    'title' => 'Processos Seletivos - Senac AM',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                ],
                'methods' => [
                    'SetHeader' => ['PROCESSOS SELETIVOS - SENAC AM||Gerado em: ' . date("d/m/Y - H:i:s")],
                    'SetFooter' => ['Gerência de Informática Corporativa - GIC||Página {PAGENO}'],
                ]
            ]);

        return $pdf->render('imprimir', [
            'model' => $this->findModel($id),
        ]);
        }


    /**
     * Deletes an existing Curriculos model.
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
     * Finds the Curriculos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Curriculos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Curriculos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
