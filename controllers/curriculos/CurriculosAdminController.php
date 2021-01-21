<?php

namespace app\controllers\curriculos;

use Yii;

use app\models\Model;
use app\models\processoseletivo\Cargos;
use app\models\processoseletivo\CargosProcesso;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\curriculos\Unidades;
use app\models\curriculos\CurriculosAdmin;
use app\models\curriculos\CurriculosSearch;
use app\models\curriculos\CurriculosEndereco;
use app\models\curriculos\CurriculosFormacao;
use app\models\curriculos\CurriculosComplementos;
use app\models\curriculos\CurriculosEmpregos;
use app\models\curriculos\BancoDeCurriculosSearch;
use app\models\curriculos\AnaliseGerencialSearch;
use app\models\curriculos\AnaliseGerencialAdministradorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\helpers\Json;
use yii\db\Query;
use mPDF;

/**
 * CurriculosController implements the CRUD actions for Curriculos model.
 */
class CurriculosAdminController extends Controller
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
     * Lists all Curriculos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-full';
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $searchModel = new CurriculosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_ASC]];

        $session['query'] = $_SERVER['QUERY_STRING'];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBancoDeCurriculos()
    {
        $this->layout = 'main-full';
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }

        $searchModel = new BancoDeCurriculosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_ASC]];

        $session['query'] = $_SERVER['QUERY_STRING'];

        return $this->render('banco-de-curriculos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAnaliseGerencialAdministrador()
    {
        $this->layout = 'main-full';
        $session = Yii::$app->session;
        $searchModel = new AnaliseGerencialAdministradorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_ASC]];

        $session['query'] = $_SERVER['QUERY_STRING'];

        return $this->render('listar-analise-gerencial-administrador', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAnaliseGerencial()
    {
        $this->layout = 'main-full';

        $searchModel = new AnaliseGerencialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_ASC]];

        $session['query'] = $_SERVER['QUERY_STRING'];

        return $this->render('listar-analise-gerencial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImprimir($id) {
    {
        $this->layout = 'main-imprimir';
        $model = $this->findModel($id);
        $curriculosEndereco     = $model->curriculosEnderecos; //busca endereço
        $curriculosFormacao     = $model->curriculosFormacaos; //busca formação
        $curriculosComplementos = $model->curriculosComplementos; //busca cursos complementares
        $curriculosEmpregos     = $model->curriculosEmpregos; //busca empregos anteriores
             
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['imprimir', 'id' => $model->id]);
        } else {

        return $this->render('imprimir', [
            'model' => $this->findModel($id),
            'curriculosEndereco' => $curriculosEndereco,
            'curriculosFormacao' => $curriculosFormacao,
            'curriculosComplementos' => $curriculosComplementos,
            'curriculosEmpregos' => $curriculosEmpregos,
             ]);
            }
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
        $model = $this->findModel($id);
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
            $curriculosEndereco     = $model->curriculosEnderecos; //busca endereço
            $curriculosFormacao     = $model->curriculosFormacaos; //busca formação
            $curriculosComplementos = $model->curriculosComplementos; //busca cursos complementares
            $curriculosEmpregos     = $model->curriculosEmpregos; //busca empregos anteriores
         
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {

                return $this->render('view', [
                    'model' => $this->findModel($id),
                    'curriculosEndereco' => $curriculosEndereco,
                    'curriculosFormacao' => $curriculosFormacao,
                    'curriculosComplementos' => $curriculosComplementos,
                    'curriculosEmpregos' => $curriculosEmpregos,
                ]);
        }

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
        $modelsComplemento = [new CurriculosComplementos];
        $modelsEmpregos    = [new CurriculosEmpregos];

        if (isset($_COOKIE['PHPSESSID']) && !empty($_COOKIE['PHPSESSID'])) session_id($_COOKIE['PHPSESSID']);

        session_start();

        //session numero de edital e do id do processo
        $session = Yii::$app->session;
        $model->edital = $session["numeroEdital"];
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
            return $this->redirect('https://www.am.senac.br/trabsenac.php');
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
                    $modelsComplemento = Model::createMultiple(CurriculosComplementos::classname());
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
                                return $this->redirect('https://www.am.senac.br/trabsenac_success.php');
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }


            return $this->redirect('https://www.am.senac.br/trabsenac_success.php');
        } else {
            return $this->render('create', [
                'model' => $model,
                'cargos' => $cargos,
                'curriculosEndereco' => $curriculosEndereco,
                'curriculosFormacao' => $curriculosFormacao,
                'modelsComplemento' => (empty($modelsComplemento)) ? [new CurriculosComplementos] : $modelsComplemento,
                'modelsEmpregos' => (empty($modelsEmpregos)) ? [new CurriculosEmpregos] : $modelsEmpregos
            ]);
        }
    }
    

    public function actionAguardandoEnvioGerenciaImediata($id)
    {

        $session = Yii::$app->session;
        $model = $this->findModel($id);

        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`curriculos` SET `classificado` = '3', `aprovador_ggp` = '".$session['sess_nomeusuario']."', `dataaprovador_ggp` = '".date('Y-m-d H:i:s')."', `situacao_ggp` = 1 WHERE `id` = '".$model->id."'");
        $command->execute();

        $countCurriculos = CurriculosAdmin::find()->where(['classificado' => 3, 'edital' => $model->edital])->count();

        //Informação do Curriculo aguardando envio para gêrencia
        Yii::$app->session->setFlash('success', 'SUCESSO! Curriculo de <strong>' .$model->nome.'</strong> está aguardando envio para Gerência Imediata!</strong>');

        //Informação do quantitativo de curriculos já aprovados para envio para gerencia
        Yii::$app->session->setFlash('info', 'SUCESSO! <strong>' .$countCurriculos.' Curriculos</strong> Pré-Selecionados do edital <strong>'.$model->edital.'</strong> aguardando envio para Gerência Imediata!</strong>');

    return $this->redirect(Yii::$app->request->baseUrl. '/index.php?' . $session['query']);

    }   

    //Localiza os cargos vinculado ao Processo Seletivo
    public function actionCargosProcesso() {
                $out = [];
                if (isset($_POST['depdrop_parents'])) {
                    $parents = $_POST['depdrop_parents'];
                    if ($parents != null) {
                        $cat_id = $parents[0];
                        $out = CargosProcesso::getCargosProcessoSubCat($cat_id);
                        echo Json::encode(['output'=>$out, 'selected'=>'']);
                        return;
                    }
                }
                echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionPreSelecionados()
    {
        $session = Yii::$app->session;

        $model = new CurriculosAdmin();
        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();
        $unidades = Unidades::find()->where(['uni_codsituacao' => 1])->all();

        if ($model->load(Yii::$app->request->post())) {

        //Realiza a Contagem dos Curriculos pré-selecionados pelo GGP
        $countCurriculos = 0;
        //Busca o número do edital(númeroEdital) pelo código do processo(id)
        $numeroEdital = (new Query())->select('numeroEdital')->from('processo')->where(['id' => $model->edital]);
        $descricaoCargo = (new Query())->select('descricao')->from('cargos')->where(['idcargo' => $model->cargo]);
        $countCurriculos = CurriculosAdmin::find()->where(['classificado' => 3, 'edital' => $numeroEdital, 'cargo' => $descricaoCargo])->count();

         //Altera a situação de todos curriculos que foram pré-selecionados pelo GGP
        if($countCurriculos != 0){
                Yii::$app->db->createCommand()
                    ->update('curriculos', [
                             'classificado'      => 4, //Enviado para Gerência Imediata
                             'unidade_aprovador' => $model->unidade_aprovador,
                             ], [//------WHERE
                             'classificado' => 3,  //Aguardando envio para Gerência Imediata
                             'edital'       => $numeroEdital,
                             'cargo'        => $descricaoCargo,
                             ]) 
                    ->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Total de '.$countCurriculos.' Curriculos</strong> enviados para Análise da Gerência Imediata!</strong>');

        }else{
            Yii::$app->session->setFlash('warning', '<strong>AVISO! </strong> Não existem Curriculos para o edital a serem enviados para Análise da Gerência Imediata!</strong>');
        }

        return $this->redirect(['/curriculos/curriculos-admin/index']);

        }else{
            return $this->renderAjax('pre-selecionados', [
                'model' => $model,
                'processo' => $processo,
                'unidades' => $unidades,
            ]);
        }
    }

    public function actionClassificar($id)
    {

        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Classifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`curriculos` SET `classificado` = '1', `aprovador_solicitante` = '".$session['sess_nomeusuario']."', `dataaprovador_solicitante` = ".date('"Y-m-d H:i:s"').", `situacao_aprovadorsolicitante` = '1' WHERE `id` = '".$model->id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Candidato(a) <strong> '.$model->nome.' </strong> foi Classificado!</strong>');

        $countCurriculos = CurriculosAdmin::find()->where(['classificado' => 1, 'edital' => $model->edital])->count();

        //Informação do quantitativo de curriculos aguardando início das etapas do processo
        Yii::$app->session->setFlash('info', 'SUCESSO! <strong>' .$countCurriculos.' Curriculos</strong> Classificados do edital <strong>'.$model->edital.'</strong> aguardando início das Etapas do Processo!</strong>');

    return $this->redirect(['analise-gerencial']);

    }

    public function actionClassificarAdmin($id)
    {

        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Classifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`curriculos` SET `classificado` = '1', `aprovador_solicitante` = '".$session['sess_nomeusuario']."', `dataaprovador_solicitante` = ".date('"Y-m-d H:i:s"').", `situacao_aprovadorsolicitante` = '1' WHERE `id` = '".$model->id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Candidato(a) <strong> '.$model->nome.' </strong> foi Classificado!</strong>');

        $countCurriculos = CurriculosAdmin::find()->where(['classificado' => 1, 'edital' => $model->edital])->count();

        //Informação do quantitativo de curriculos aguardando início das etapas do processo
        Yii::$app->session->setFlash('info', 'SUCESSO! <strong>' .$countCurriculos.' Curriculos</strong> Classificados do edital <strong>'.$model->edital.'</strong> aguardando início das Etapas do Processo!</strong>');

    return $this->redirect(Yii::$app->request->baseUrl. '/index.php?' . $session['query']);

    }

    public function actionDesclassificar($id)
    {

        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Desclassifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`curriculos` SET `classificado` = '0', `aprovador_solicitante` = '".$session['sess_nomeusuario']."', `dataaprovador_solicitante` = ".date('"Y-m-d H:i:s"').", `situacao_aprovadorsolicitante` = '0' WHERE `id` = '".$model->id."'");
        $command->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Candidato(a) <strong> '.$model->nome.' </strong> foi Desclassificado!</strong>');
        
    return $this->redirect(['analise-gerencial']);

    }

    public function actionDesclassificarAdmin($id)
    {

        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Desclassifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`curriculos` SET `classificado` = '0', `aprovador_solicitante` = '".$session['sess_nomeusuario']."', `dataaprovador_solicitante` = ".date('"Y-m-d H:i:s"').", `situacao_aprovadorsolicitante` = '0' WHERE `id` = '".$model->id."'");
        $command->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Candidato(a) <strong> '.$model->nome.' </strong> foi Desclassificado!</strong>');
     
    return $this->redirect(Yii::$app->request->baseUrl. '/index.php?' . $session['query']);

    }
    public function actionDesclassificarggp($id)
    {

        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Desclassifica o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`curriculos` SET `classificado` = '0', `aprovador_ggp` = '".$session['sess_nomeusuario']."', `dataaprovador_ggp` = ".date('"Y-m-d H:i:s"').", `situacao_ggp` = '0' WHERE `id` = '".$model->id."'");
        $command->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO!</strong> Candidato(a) <strong> '.$model->nome.' </strong> foi Desclassificado!</strong>');
     
    return $this->redirect(Yii::$app->request->baseUrl. '/index.php?' . $session['query']);

    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

            CurriculosEndereco::deleteAll('curriculos_id = "'.$id.'"');
            CurriculosFormacao::deleteAll('curriculos_id = "'.$id.'"');
            CurriculosComplementos::deleteAll('curriculos_id = "'.$id.'"');
            CurriculosEmpregos::deleteAll('curriculos_id = "'.$id.'"');
            $model->delete(); //Exclui o pedido de custo
            Yii::$app->session->setFlash('success', '<b>SUCESSO! </b> CV EXCLUIDO!</b>');
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
        if (($model = CurriculosAdmin::findOne($id)) !== null) {
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
