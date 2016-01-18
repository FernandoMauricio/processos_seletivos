<?php

namespace app\controllers;

use Yii;
use app\models\ProcessoSeletivo;
use app\models\ProcessoSeletivoSearch;
use app\models\Edital;
use app\models\Anexos;
use app\models\Adendos;
use app\models\Resultados;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProcessoSeletivoController implements the CRUD actions for ProcessoSeletivo model.
 */
class ProcessoSeletivoController extends Controller
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
     * Lists all ProcessoSeletivo models.
     * @return mixed
     */
    public function actionIndex()
    {
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
        $model = new ProcessoSeletivo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    public function actionEdital($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect('http://localhost/contratacao/web/index.php?r=edital/index', [
             'model' => $model,
         ]);
    }

    public function actionAnexos($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect('http://localhost/contratacao/web/index.php?r=anexos/index', [
             'model' => $model,
         ]);
    }

    public function actionAdendos($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect('http://localhost/contratacao/web/index.php?r=adendos/index', [
             'model' => $model,
         ]);
    }

    public function actionResultados($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect('http://localhost/contratacao/web/index.php?r=resultados/index', [
             'model' => $model,
         ]);
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
