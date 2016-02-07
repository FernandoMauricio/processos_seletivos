<?php

namespace app\controllers;

use Yii;

use app\models\Model;
use app\models\Cargos;
use app\models\CargosProcesso;
use app\models\Curriculos;
use app\models\CurriculosSearch;
use app\models\CurriculosEndereco;
use app\models\CurriculosFormacao;
use app\models\CurriculosComplemento;
use app\models\CurriculosEmpregos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



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
        $searchModel = new CurriculosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Curriculos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        //busca endereço
        $sql_endereco = 'SELECT * FROM curriculos_endereco WHERE curriculos_id ='.$id.' ';
        $curriculosEndereco = CurriculosEndereco::findBySql($sql_endereco)->one();  

        //busca formação
        $sql_formacao = 'SELECT * FROM curriculos_formacao WHERE curriculos_id ='.$id.' ';
        $curriculosFormacao = CurriculosFormacao::findBySql($sql_formacao)->one();  

        //busca cursos complementares
        $sql_complemento = 'SELECT * FROM curriculos_complemento WHERE curriculos_id ='.$id.' ';
        $curriculosComplemento = CurriculosComplemento::findBySql($sql_complemento)->all();  

        //busca empregos anteriores
        $sql_emprego = 'SELECT * FROM curriculos_empregos WHERE curriculos_id ='.$id.' ';
        $curriculosEmpregos = CurriculosEmpregos::findBySql($sql_emprego)->all();  


        return $this->render('view', [
            'model' => $this->findModel($id),
            'curriculosEndereco' => $curriculosEndereco,
            'curriculosFormacao' => $curriculosFormacao,
            'curriculosComplemento' => $curriculosComplemento,
            'curriculosEmpregos' => $curriculosEmpregos,
        ]);
    }


    public function actionWizard($step = null)
    {
        return $this->step($step);
    }

    public function actions()
    {
        return [
            'addressSearch' => 'yiibr\correios\CepAction'
        ];
    }

    /**
     * Creates a new Curriculos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $this->layout = 'main-curriculos';
        $model = new Curriculos();
        $curriculosEndereco = new CurriculosEndereco();
        $curriculosFormacao = new CurriculosFormacao();
        $modelsComplemento = [new CurriculosComplemento];
        $modelsEmpregos    = [new CurriculosEmpregos];


        //session numero de edital e do id do processo
        $session = Yii::$app->session;
        $model->edital = $session["numeroEdital"];
        $id = $session["id"];

        $model->data  = date('Y-m-d');

        //NÚMERO DE INSCRIÇÃO 'ANO CORRENTE + 000000 + ID DO CANDIDATO'
        $query_id = "SELECT max(id) as id FROM curriculos LIMIT 1";
        $last_id = Curriculos::findBySql($query_id)->all(); 
                foreach ($last_id as $value) 
                        {
                            $incremento = $value['id'];
                            $incremento++;
                         }
        $model->numeroInscricao = date('Y') . '00000' . $incremento;

        $curriculosEndereco->curriculos_id = $incremento; 
        $curriculosFormacao->curriculos_id = $incremento; 

        //localizando somente os cargos que fazem parte daquele edital
        $cargos = Cargos::find()
        ->innerJoinWith('cargosProcessos')
        ->where(['processo_id'=>$id])
        ->AndWhere('cargo_id = idcargo')
        ->all();

        //Caso não tenha puxado nenhum edital, será redirecionado para a página de processo seletivo
        if($model->edital == NULL){
            return $this->redirect('http://localhost/control_processos/');
        }

        if ($model->load(Yii::$app->request->post()) && $curriculosEndereco->load(Yii::$app->request->post()) && $curriculosFormacao->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $curriculosEndereco, $curriculosFormacao]) ) 
        {



        //Calcular a idade do candidato
        $datetime1 = new \DateTime($model->datanascimento, new \DateTimeZone('UTC'));
        $datetime2 = new \DateTime();
        $diff = $datetime1->diff($datetime2);
        $model->idade = $diff->y;


        $model->save(false); // skip validation as model is already validated
        $curriculosEndereco->curriculos_id = $model->id; 
        $curriculosFormacao->curriculos_id = $model->id; 

        $curriculosEndereco->save(false);
        $curriculosFormacao->save(false);



                    //Inserir vários cursos complementares
                    $modelsComplemento = Model::createMultiple(CurriculosComplemento::classname());
                    Model::loadMultiple($modelsComplemento, Yii::$app->request->post());

                     //Inserir vários emprgos anteriores
                    $modelsEmpregos = Model::createMultiple(CurriculosEmpregos::classname());
                    Model::loadMultiple($modelsEmpregos, Yii::$app->request->post());


                    // validate all models
                    $valid = $model->validate();
                    $valid = Model::validateMultiple($modelsComplemento) && $valid;

                    $valid2 = $model->validate();
                    $valid_empregos = Model::validateMultiple($modelsEmpregos) && $valid2;

                    if ($valid && $valid_empregos) {
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            if ($flag = $model->save(false)) {
                                foreach ($modelsComplemento as $modelComplemento) {//cursos complementares
                                    $modelComplemento->curriculos_id = $model->id;
                                    if (! ($flag = $modelComplemento->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                                foreach ($modelsEmpregos as $modelEmpregos) {//empregos anteriores
                                    $modelEmpregos->curriculos_id = $model->id;
                                    if (! ($flag = $modelEmpregos->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }

                            }
                            if ($flag) {
                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cargos' => $cargos,
                'curriculosEndereco' => $curriculosEndereco,
                'curriculosFormacao' => $curriculosFormacao,
                'modelsComplemento' => (empty($modelsComplemento)) ? [new CurriculosComplemento] : $modelsComplemento,
                'modelsEmpregos' => (empty($modelsEmpregos)) ? [new CurriculosEmpregos] : $modelsEmpregos
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
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
