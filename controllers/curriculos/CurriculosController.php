<?php

namespace app\controllers\curriculos;

use Yii;

use app\models\Model;
use app\models\processoseletivo\Cargos;
use app\models\processoseletivo\CargosProcesso;
use app\models\curriculos\Curriculos;
use app\models\curriculos\CurriculosSearch;
use app\models\curriculos\CurriculosEndereco;
use app\models\curriculos\CurriculosFormacao;
use app\models\curriculos\CurriculosComplementos;
use app\models\curriculos\CurriculosEmpregos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

use mPDF;



/**
 * CurriculosController implements the CRUD actions for Curriculos model.
 */
class CurriculosController extends Controller
{
    /**
     * @inheritdoc
     */
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
    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else
        $searchModel = new CurriculosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        ini_set('session.cookie_domain','am.senac.br');

        $this->layout = 'main-curriculos';
        $model = new Curriculos();
        $curriculosEndereco = new CurriculosEndereco();
        $curriculosFormacao = new CurriculosFormacao();
        $modelsComplementos = [new CurriculosComplementos];
        $modelsEmpregos    = [new CurriculosEmpregos];

        if (isset($_COOKIE['PHPSESSID']) && !empty($_COOKIE['PHPSESSID'])) session_id($_COOKIE['PHPSESSID']);

        session_start();

        //session numero de edital e do id do processo
        $session = Yii::$app->session;
        $model->edital = $session["numeroEdital"];
        $model->classificado = 5; //Inscrito
        $id = $session["id"];

        $model->data  = date('Y-m-d H:i:s');

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

        //localizando somente os cargos que fazem parte do edital selecionado
        $cargos = Cargos::find()
        ->innerJoinWith('cargosProcessos')
        ->where(['processo_id'=>$id])
        ->AndWhere('cargo_id = idcargo')
        ->all();

        //Caso não tenha puxado nenhum edital, será redirecionado para a página de processo seletivo
        if($model->edital == NULL){
            return $this->redirect('http://www.am.senac.br/trabsenac.php');
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

        //ENVIA E-MAIL DA INSCRIÇÃO PARA O CANDIDATO
                     Yii::$app->mailer->compose()
                            ->setFrom(['contratacao@am.senac.br' => 'Processo Seletivo - Senac AM'])
                            ->setTo($model->email)
                            ->setSubject('Inscrição para o Edital: ' . $model->edital)
                            ->setTextBody('Prezado Candidato, confirmamos o envio de seu currículo para concorrer a vaga de ' .$model->cargo. ' para o Edital ' .$model->edital.' ')
                            ->setHtmlBody("Prezado Senhor(a), <strong>".$model->nome."</strong><br><br>".
                     "Recebemos a sua inscrição em nosso processo de seleção com sucesso para o Edital: <strong>".$model->edital." </strong>e pedimos que acompanhe em nosso site o resultado das próximas etapas.<br><br>".    
                     
                         "<strong><font color='red'><center>NÃO RESPONDA A ESSE E-MAIL!!!!</center></font></strong><br><br>".

                     "<strong>INFORMAÇÕES GERAIS</STRONG><br><br>".
                     "<strong>Número de Inscrição: </strong><font color='red'>".$model->numeroInscricao ."</font><br><br>".
                     "<strong>Data do envio: </strong> ".$model->data ."<br>".
                     "<strong>Processo Seletivo: </strong> ".$model->edital ."<br>".
                     "<strong>Cargo: </strong> ".$model->cargo ."<br><br>")
                            ->send();

                    //Inserir vários cursos complementares
                    $modelsComplementos = Model::createMultiple(CurriculosComplementos::classname());
                    Model::loadMultiple($modelsComplementos, Yii::$app->request->post());

                     //Inserir vários emprgos anteriores
                    $modelsEmpregos = Model::createMultiple(CurriculosEmpregos::classname());
                    Model::loadMultiple($modelsEmpregos, Yii::$app->request->post());


                    // validate all models
                    $valid = $model->validate();
                    $valid = Model::validateMultiple($modelsComplementos) && $valid;

                    $valid2 = $model->validate();
                    $valid_empregos = Model::validateMultiple($modelsEmpregos) && $valid2;

                    if ($valid && $valid_empregos) {
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            if ($flag = $model->save(false)) {
                                foreach ($modelsComplementos as $modelComplemento) {//cursos complementares
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
                                return $this->redirect('http://www.am.senac.br/trabsenac_success.php');
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }


            return $this->redirect('http://www.am.senac.br/trabsenac_success.php');
        } else {
            return $this->render('create', [
                'model' => $model,
                'cargos' => $cargos,
                'curriculosEndereco' => $curriculosEndereco,
                'curriculosFormacao' => $curriculosFormacao,
                'modelsComplementos' => (empty($modelsComplementos)) ? [new CurriculosComplementos] : $modelsComplementos,
                'modelsEmpregos' => (empty($modelsEmpregos)) ? [new CurriculosEmpregos] : $modelsEmpregos
            ]);
        }
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
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

}

