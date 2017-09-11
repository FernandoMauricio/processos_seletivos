<?php

namespace app\controllers\processoseletivo;

use Yii;
use app\models\processoseletivo\Cargos;
use app\models\processoseletivo\CargosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CargosController implements the CRUD actions for Cargos model.
 */
class CargosController extends Controller
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
     * Lists all Cargos models.
     * @return mixed
     */
    public function actionIndex()
    {
    $this->layout = 'main-full';
    $session = Yii::$app->session;
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $searchModel = new CargosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Cargos model.
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

        $model = new Cargos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->calculos == 1) { // Realiza os cálculos de Planejamento e Produtividade caso seja marcado a opção
            $model->salario_1sexto        = $model->salario / 6;
            $model->salario_produtividade = (($model->salario_valorhora * 45) / 100) * $model->ch_semana * 5;
            $model->salario_6horasfixas   = $model->salario_valorhora * 6;
            $model->salario_1sextofixas   = $model->salario_6horasfixas / 6;
            $model->salario_bruto         = $model->salario + $model->salario_1sexto + $model->salario_produtividade + $model->salario_6horasfixas + $model->salario_1sextofixas;
            $model->encargos              = ($model->salario_bruto * 32.7) / 100;
            $model->valor_total           = $model->salario + $model->encargos;
            $model->save();
        }else{
            $model->salario_valorhora     = 0;
            $model->salario_1sexto        = 0;  
            $model->salario_produtividade = 0; 
            $model->salario_6horasfixas   = 0; 
            $model->salario_1sextofixas   = 0;
            $model->salario_bruto         = $model->salario + $model->salario_1sexto + $model->salario_produtividade + $model->salario_6horasfixas + $model->salario_1sextofixas;
            $model->encargos              = ($model->salario_bruto * 32.7) / 100;
            $model->valor_total           = $model->salario + $model->encargos;
            $model->save();
        }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>O Cargo foi cadastrado!</strong>');
            
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cargos model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->calculos == 1) { // Realiza os cálculos de Planejamento e Produtividade caso seja marcado a opção
            $model->salario_1sexto        = $model->salario / 6;
            $model->salario_produtividade = (($model->salario_valorhora * 45) / 100) * $model->ch_semana * 5;
            $model->salario_6horasfixas   = $model->salario_valorhora * 6;
            $model->salario_1sextofixas   = $model->salario_6horasfixas / 6;
            $model->salario_bruto         = $model->salario + $model->salario_1sexto + $model->salario_produtividade + $model->salario_6horasfixas + $model->salario_1sextofixas;
            $model->encargos              = ($model->salario_bruto * 32.7) / 100;
            $model->valor_total           = $model->salario + $model->encargos;
            $model->save();
        }else{
            $model->salario_valorhora     = 0;
            $model->salario_1sexto        = 0;  
            $model->salario_produtividade = 0; 
            $model->salario_6horasfixas   = 0; 
            $model->salario_1sextofixas   = 0;
            $model->salario_bruto         = $model->salario + $model->salario_1sexto + $model->salario_produtividade + $model->salario_6horasfixas + $model->salario_1sextofixas;
            $model->encargos              = ($model->salario_bruto * 32.7) / 100;
            $model->valor_total           = $model->salario + $model->encargos;
            $model->save();
        }
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>O Cargo foi atualizado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cargos model.
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
     * Finds the Cargos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cargos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cargos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    public function AccessAllow()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    }
}

