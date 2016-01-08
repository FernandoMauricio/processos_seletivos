<?php

namespace app\controllers;

use Yii;
use app\models\Resultados;
use app\models\ResultadosSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultadosController implements the CRUD actions for Resultados model.
 */
class ResultadosController extends Controller
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
     * Lists all Resultados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResultadosSerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resultados model.
     * @param integer $id
     * @param integer $processo_id
     * @return mixed
     */
    public function actionView($id, $processo_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $processo_id),
        ]);
    }

    /**
     * Creates a new Resultados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resultados();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'processo_id' => $model->processo_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Resultados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $processo_id
     * @return mixed
     */
    public function actionUpdate($id, $processo_id)
    {
        $model = $this->findModel($id, $processo_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'processo_id' => $model->processo_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Resultados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $processo_id
     * @return mixed
     */
    public function actionDelete($id, $processo_id)
    {
        $this->findModel($id, $processo_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resultados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $processo_id
     * @return Resultados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $processo_id)
    {
        if (($model = Resultados::findOne(['id' => $id, 'processo_id' => $processo_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
