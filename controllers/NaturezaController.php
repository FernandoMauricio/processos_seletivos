<?php

namespace app\controllers;

use Yii;
use app\models\Natureza;
use app\models\NaturezaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NaturezaController implements the CRUD actions for Natureza model.
 */
class NaturezaController extends Controller
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
     * Lists all Natureza models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NaturezaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Natureza model.
     * @param string $nat_codcontrato
     * @param string $nat_codtipo
     * @return mixed
     */
    public function actionView($nat_codcontrato, $nat_codtipo)
    {
        return $this->render('view', [
            'model' => $this->findModel($nat_codcontrato, $nat_codtipo),
        ]);
    }

    /**
     * Creates a new Natureza model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Natureza();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nat_codcontrato' => $model->nat_codcontrato, 'nat_codtipo' => $model->nat_codtipo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Natureza model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nat_codcontrato
     * @param string $nat_codtipo
     * @return mixed
     */
    public function actionUpdate($nat_codcontrato, $nat_codtipo)
    {
        $model = $this->findModel($nat_codcontrato, $nat_codtipo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nat_codcontrato' => $model->nat_codcontrato, 'nat_codtipo' => $model->nat_codtipo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Natureza model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nat_codcontrato
     * @param string $nat_codtipo
     * @return mixed
     */
    public function actionDelete($nat_codcontrato, $nat_codtipo)
    {
        $this->findModel($nat_codcontrato, $nat_codtipo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Natureza model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nat_codcontrato
     * @param string $nat_codtipo
     * @return Natureza the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nat_codcontrato, $nat_codtipo)
    {
        if (($model = Natureza::findOne(['nat_codcontrato' => $nat_codcontrato, 'nat_codtipo' => $nat_codtipo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
