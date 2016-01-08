<?php

namespace app\controllers;

use Yii;
use app\models\ProcessoSeletivo;
use app\models\ProcessoSeletivoSearch;
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
     * @param integer $modalidade_id
     * @return mixed
     */
    public function actionView($id, $modalidade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $modalidade_id),
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
            return $this->redirect(['view', 'id' => $model->id, 'modalidade_id' => $model->modalidade_id]);
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
     * @param integer $modalidade_id
     * @return mixed
     */
    public function actionUpdate($id, $modalidade_id)
    {
        $model = $this->findModel($id, $modalidade_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'modalidade_id' => $model->modalidade_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProcessoSeletivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $modalidade_id
     * @return mixed
     */
    public function actionDelete($id, $modalidade_id)
    {
        $this->findModel($id, $modalidade_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProcessoSeletivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $modalidade_id
     * @return ProcessoSeletivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $modalidade_id)
    {
        if (($model = ProcessoSeletivo::findOne(['id' => $id, 'modalidade_id' => $modalidade_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
