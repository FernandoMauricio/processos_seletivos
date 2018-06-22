<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\etapasprocesso\EtapasProcesso;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\pedidos\pedidocontratacao\PedidocontratacaoItens;
use app\models\pedidos\pedidocontratacao\PedidoContratacao;
use app\models\pedidos\pedidocontratacao\PedidoContratacaoSearch;
use app\models\pedidos\pedidocontratacao\PedidoContratacaoAprovacaoGgpSearch;
use app\models\pedidos\pedidocontratacao\PedidoContratacaoAprovacaoDadSearch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * PedidoContratacaoController implements the CRUD actions for PedidoContratacao model.
 */
class PedidoContratacaoController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PedidoContratacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoContratacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGgpIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoContratacaoAprovacaoGgpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('ggp-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDadIndex()
    {
        $this->layout = 'main-full';

        $searchModel = new PedidoContratacaoAprovacaoDadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dad-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAprovarGgp($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Aprova o Pedido de Contratação
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_contratacao` SET `pedcontratacao_aprovadorggp` = '".$session['sess_nomeusuario']."', `pedcontratacao_situacaoggp` = '4', `pedcontratacao_dataaprovacaoggp` = ".date('"Y-m-d"')." WHERE `pedcontratacao_id` = '".$model->pedcontratacao_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação <b> '.$model->pedcontratacao_id.' </b> foi Aprovado!</b>');

        return $this->redirect(['ggp-index']);
    }
    
    public function actionAprovarDad($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Aprova o Pedido de Contratação
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_contratacao` SET `pedcontratacao_aprovadordad` = '".$session['sess_nomeusuario']."', `pedcontratacao_situacaodad` = '4', `pedcontratacao_dataaprovacaodad` = ".date('"Y-m-d"')." WHERE `pedcontratacao_id` = '".$model->pedcontratacao_id."'");
        $command->execute();

        //Atualiza a data do ingresso na Solicitação de Contratação
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`contratacao` 
        INNER JOIN `pedidocontratacao_itens` ON `pedidocontratacao_itens`.`contratacao_id` = `contratacao`.`id`
        INNER JOIN `pedido_contratacao` ON `pedido_contratacao`.`pedcontratacao_id` = `pedidocontratacao_itens`.`pedidocontratacao_id` 
        SET `data_ingresso` = `pedidocontratacao_itens`.`itemcontratacao_dataingresso` 
        WHERE `pedidocontratacao_itens`.`contratacao_id` = `contratacao`.`id` AND `pedido_contratacao`.`pedcontratacao_id` = ".$model->pedcontratacao_id." ");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação <b> '.$model->pedcontratacao_id.' </b> foi Aprovado!</b>');

        return $this->redirect(['dad-index']);
    }

    public function actionReprovarGgp($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Reprova o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_contratacao` SET `pedcontratacao_aprovadorggp` = '".$session['sess_nomeusuario']."', `pedcontratacao_situacaoggp` = '3', `pedcontratacao_dataaprovacaoggp` = ".date('"Y-m-d"')." WHERE `pedcontratacao_id` = '".$model->pedcontratacao_id."'");
        $command->execute();
        
        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação <b> '.$model->pedcontratacao_id.' </b> foi Reprovado!</b>');

        return $this->redirect(['ggp-index']);
    }

    public function actionReprovarDad($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        //Reprova o candidato
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
        "UPDATE `db_processos`.`pedido_contratacao` SET `pedcontratacao_aprovadordad` = '".$session['sess_nomeusuario']."', `pedcontratacao_situacaodad` = '3', `pedcontratacao_dataaprovacaodad` = ".date('"Y-m-d"')." WHERE `pedcontratacao_id` = '".$model->pedcontratacao_id."'");
        $command->execute();

        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação <b> '.$model->pedcontratacao_id.' </b> foi Reprovado!</b>');

        return $this->redirect(['dad-index']);
    }

    public function actionHomologarContratacao($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        $modelsItens = $model->pedidocontratacaoItens;

        //Se não existir as aprovações da GGP e DAD, não será possível homologar o processo
        if($model->pedcontratacao_situacaoggp != 4 || $model->pedcontratacao_situacaodad != 4) {
            Yii::$app->session->setFlash('danger', '<b>ERRO! </b>Solicitação sem aprovações!</b>');
            return $this->redirect(['index']);
            }
    if($model->pedcontratacao_tipo == 0) { //Somente se não for contratação especial
        foreach ($modelsItens as $modelItens) {
            //Desclassifica o restante dos candidatos que não foram selecionados
            $connection = Yii::$app->db;
            $command = $connection->createCommand(
            "UPDATE `curriculos`
                INNER JOIN `pedidohomologacao_itens` ON `pedidohomologacao_itens`.`curriculos_id` != `curriculos`.`id`
                INNER JOIN `etapas_itens` ON  `etapas_itens`.`curriculos_id` = `curriculos`.`id`
                INNER JOIN `etapas_processo` ON `etapas_processo`.`etapa_id` = `etapas_itens`.`etapasprocesso_id`
                INNER JOIN `pedidocusto_itens` ON `pedidocusto_itens`.`pedidocusto_id` = `etapas_processo`.`pedidocusto_id`
                SET `classificado` = 0
                WHERE `classificado` IN(0,3,4,5)
                AND `curriculos`.`edital` =  '".$modelItens->etapasProcesso->processo->numeroEdital."'
                AND `curriculos`.`cargo` = '".$modelItens->etapasProcesso->etapa_cargo."'");
            $command->execute();

            //Altera o Status do 1º colocado para CONTRATADO
            $connection = Yii::$app->db;
            $command = $connection->createCommand(
             "UPDATE `curriculos`
                INNER JOIN `pedidohomologacao_itens` ON `pedidohomologacao_itens`.`curriculos_id` != `curriculos`.`id`
                INNER JOIN `etapas_itens` ON  `etapas_itens`.`curriculos_id` = `curriculos`.`id`
                INNER JOIN `etapas_processo` ON `etapas_processo`.`etapa_id` = `etapas_itens`.`etapasprocesso_id`
                INNER JOIN `pedidocusto_itens` ON `pedidocusto_itens`.`pedidocusto_id` = `etapas_processo`.`pedidocusto_id`
                INNER JOIN `pedido_homologacao` ON `pedidohomologacao_itens`.`pedidohomologacao_id` = `pedido_homologacao`.`homolog_id`
                INNER JOIN `pedidocontratacao_itens` ON `pedido_homologacao`.`contratacao_id` = `pedidocontratacao_itens`.`contratacao_id`
                SET `classificado` = 6
                WHERE `curriculos`.`edital` =  '".$modelItens->etapasProcesso->processo->numeroEdital."'
                AND `curriculos`.`cargo` = '".$modelItens->etapasProcesso->etapa_cargo."'
                AND `curriculos`.`nome` = '".$modelItens->itemcontratacao_nome."'
                AND `curriculos`.`classificado` != 6 ");
            $command->execute();
        }
    }

        //Homologa o Pedido de Contratação
        $connection = Yii::$app->db;
        $command = $connection->createCommand(
         "UPDATE `db_processos`.`pedido_contratacao` 
          SET `pedcontratacao_homologador` = '".$session['sess_nomeusuario']."', `pedcontratacao_datahomologacao` = ".date('"Y-m-d"')." 
          WHERE `pedcontratacao_id` = '".$model->pedcontratacao_id."'");
        $command->execute();

        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação <b> '.$model->pedcontratacao_id.' </b> foi Homologado!</b>');

        return $this->redirect(['index']);
    }

    /**
     * Displays a single PedidoContratacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'main-imprimir';
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $model = $this->findModel($id);
        $modelsItens = $model->pedidocontratacaoItens;

        return $this->render('view', [
            'model' => $model,
            'modelsItens' => $modelsItens,
        ]);
    }

    //Localiza os Processo Seletivos
    public function actionGetCandidatosAprovados() {
                $out = [];
                if (isset($_POST['depdrop_parents'])) {
                    $parents = $_POST['depdrop_parents'];
                    if ($parents != null) {
                        $cat_id = $parents[0];
                        $out = PedidoContratacao::getCandidatosAprovadosSubCat($cat_id);
                        echo Json::encode(['output'=>$out, 'selected'=>'']);
                        return;
                    }
                }
                echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGerarPedidoContratacao()
    {
        $session = Yii::$app->session;
        $model = new PedidoContratacao();
        $model->pedcontratacao_situacaoggp = 1; //Aguardando Autorização GPP
        $model->pedcontratacao_situacaodad = 1; //Aguardando Autorização DAD
        $model->pedcontratacao_data        = date('Y-m-d');
        $model->pedcontratacao_responsavel = $session['sess_nomeusuario'];
        $model->pedcontratacao_recursos    = 'PRÓPRIOS';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->pedcontratacao_id]);
        } else {
            return $this->renderAjax('gerar-pedido-contratacao', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new PedidoContratacao model.
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
        $model       = new PedidoContratacao();
        $modelsItens = [new PedidocontratacaoItens];

        $model->pedcontratacao_situacaoggp = 1; //Aguardando Autorização GPP
        $model->pedcontratacao_situacaodad = 1; //Aguardando Autorização DAD
        $model->pedcontratacao_data        = date('Y-m-d');
        $model->pedcontratacao_responsavel = $session['sess_nomeusuario'];
        $model->pedcontratacao_recursos    = 'PRÓPRIOS';

        //[4,7,8,9,10,11,12,13,14] -> Situações EM ANDAMENTO
        $contratacoes = Contratacao::find()->where(['IN','situacao_id', [4,7,8,9,10,11,12,13,14,15,16,17]])->orderBy('id')->all();

        $processo = EtapasProcesso::find()->select(['etapa_id', new \yii\db\Expression("CONCAT(`processo`.`numeroEdital`, ' - ', `etapa_cargo`) as etapa_cargo")])->innerJoinWith('processo', `processo.id` == `etapasprocesso_id`)->where(['etapa_situacao' => 'Em Homologação'])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Inserir vários itens
            $modelsItens = Model::createMultiple(PedidocontratacaoItens::classname());
            Model::loadMultiple($modelsItens, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();

            if ($valid ) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsItens as $modelItens) {
                            $modelItens->pedidocontratacao_id = $model->pedcontratacao_id;
                            if (! ($flag = $modelItens->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                    if ($flag) {
                            foreach ($modelsItens as $i => $modelItens) {
                           //Verifica se é o mesmo cargo escolhido na solicitação de Contratação  
                           if($_POST['PedidocontratacaoItens'][$i]['itemcontratacao_cargo'] != $modelItens->etapasProcesso->etapa_cargo) {
                                Yii::$app->session->setFlash('danger', '<b>ERRO!</b> Cargo <b>'.$modelItens['etapasProcesso']['etapa_cargo'].'</b> diferente do informado na Solicitação <b>'.$_POST['PedidocontratacaoItens'][$i]['contratacao_id'].'</b>');
                                return $this->redirect(['update', 'id' => $model->pedcontratacao_id]);
                                }
                            //Verifica se existe já a contratação inserida anterioemente em algum pedido de Contratação
                            // if(PedidocontratacaoItens::find()->where(['contratacao_id' => $_POST['PedidocontratacaoItens'][$i]['contratacao_id']])->count() >= 2) {
                            //     Yii::$app->session->setFlash('danger', '<b>ERRO! </b>Solicitação <b>'.$_POST['PedidocontratacaoItens'][$i]['contratacao_id'].'</b> já inserida no Pedido de Contratação!</b>');
                            //     return $this->redirect(['update', 'id' => $model->pedcontratacao_id]);
                            //     }
                                $model->save();
                            }
                        $transaction->commit();
                            
                        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação Cadastrado!</b>');
                       return $this->redirect(['index']);
                    }
                }
                }  catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação Cadastrado!</b>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'processo' => $processo,
                'modelsItens' => (empty($modelsItens)) ? [new PedidocontratacaoItens] : $modelsItens,
            ]);
        }
    }

    /**
     * Updates an existing PedidoContratacao model.
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
        $modelsItens = $model->pedidocontratacaoItens;

        $model->pedcontratacao_situacaoggp = 1; //Aguardando Autorização GPP
        $model->pedcontratacao_situacaodad = 1; //Aguardando Autorização DAD
        $model->pedcontratacao_data = date('Y-m-d');
        $model->pedcontratacao_responsavel = $session['sess_nomeusuario'];

        //Verifica se o Pedido de Contratação já foi homologado
        if(isset($model->pedcontratacao_homologador) || isset($model->pedcontratacao_datahomologacao)) {
            Yii::$app->session->setFlash('danger', '<b>ERRO!</b> Pedido de Contratação já Homologado. Não é possível executar esta ação!');
            return $this->redirect(['index']);
        }

        //[4,7,8,9,10,11,12,13,14] -> Situações EM ANDAMENTO
        $contratacoes = Contratacao::find()->where(['IN','situacao_id', [4,7,8,9,10,11,12,13,14,15,16,17]])->orderBy('id')->all();

        $processo = EtapasProcesso::find()->select(['etapa_id', new \yii\db\Expression("CONCAT(`processo`.`numeroEdital`, ' - ', `etapa_cargo`) as etapa_cargo")])->innerJoinWith('processo', `processo.id` == `etapasprocesso_id`)->where(['etapa_situacao' => 'Em Homologação'])->all();

        if ($model->load(Yii::$app->request->post())) {

        //--------Itens do Pedido de Contratação--------------
        $oldIDsItens = ArrayHelper::map($modelsItens, 'id', 'id');
        $modelsItens = Model::createMultiple(PedidocontratacaoItens::classname(), $modelsItens);
        Model::loadMultiple($modelsItens, Yii::$app->request->post());
        $deletedIDsItens = array_diff($oldIDsItens, array_filter(ArrayHelper::map($modelsItens, 'id', 'id')));

        // validate all models
        $valid = $model->validate();
        $valid = (Model::validateMultiple($modelsItens) && $valid);

                        if ($valid) {
                            $transaction = \Yii::$app->db->beginTransaction();
                            try {
                                if ($flag = $model->save(false)) {
                                    if (! empty($deletedIDsItens)) {
                                        PedidocontratacaoItens::deleteAll(['id' => $deletedIDsItens]);
                                    }
                                    foreach ($modelsItens as $modelItens) {
                                        $modelItens->pedidocontratacao_id = $model->pedcontratacao_id;
                                        if (! ($flag = $modelItens->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }
                                }

                               if ($flag) {
                            foreach ($modelsItens as $i => $modelItens) {
                           //Verifica se é o mesmo cargo escolhido na solicitação de Contratação e se é diferente da contratação especial
                           if($model->pedcontratacao_tipo == 0) {
                               if($_POST['PedidocontratacaoItens'][$i]['itemcontratacao_cargo'] != $modelItens->etapasProcesso->etapa_cargo) {
                                    Yii::$app->session->setFlash('danger', '<b>ERRO!</b> Cargo <b>'.$modelItens['etapasProcesso']['etapa_cargo'].'</b> diferente do informado na Solicitação <b>'.$_POST['PedidocontratacaoItens'][$i]['contratacao_id'].'</b>');
                                    return $this->redirect(['update', 'id' => $model->pedcontratacao_id]);
                                    }
                            }
                            //Verifica se existe já a contratação inserida anterioemente em algum pedido de Contratação
                            // if(PedidocontratacaoItens::find()->where(['contratacao_id' => $_POST['PedidocontratacaoItens'][$i]['contratacao_id']])->count() >= 2) {
                            //     Yii::$app->session->setFlash('danger', '<b>ERRO! </b>Solicitação <b>'.$_POST['PedidocontratacaoItens'][$i]['contratacao_id'].'</b> já inserida no Pedido de Contratação!</b>');
                            //     return $this->redirect(['update', 'id' => $model->pedcontratacao_id]);
                            //     }
                                $model->save();
                            }
                        $transaction->commit();

                        Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação Atualizado!</b>');
                       return $this->redirect(['index']);
                    }
                }catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<b>SUCESSO!</b> Pedido de Contratação Atualizado!</b>');

            return $this->redirect(['index']);
        }else {
             if($model->pedcontratacao_tipo == 0) {
                return $this->render('update', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'processo' => $processo,
                'modelsItens' => (empty($modelsItens)) ? [new PedidocontratacaoItens] : $modelsItens,
                ]);
            }else{
                return $this->render('update-especial', [
                'model' => $model,
                'contratacoes' => $contratacoes,
                'processo' => $processo,
                'modelsItens' => (empty($modelsItens)) ? [new PedidocontratacaoItens] : $modelsItens,
                ]);
            }
        }
    }

    /**
     * Deletes an existing PedidoContratacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        //Verifica se já existe alguma etapa de processo criada
        if(isset($model->pedcontratacao_homologador) || isset($model->pedcontratacao_datahomologacao)) {
            Yii::$app->session->setFlash('danger', '<b>ERRO!</b> Pedido já Homologado. Não é possível executar esta ação!');
            return $this->redirect(['index']);
        }else{
            PedidocontratacaoItens::deleteAll('pedidocontratacao_id = "'.$id.'"');
            $model->delete(); //Exclui o pedido de custo
            Yii::$app->session->setFlash('success', '<b>SUCESSO! </b> Pedido de Contratação excluido!</b>');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the PedidoContratacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PedidoContratacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PedidoContratacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    }

    public function AccessoAdministrador()
    {
            $this->layout = 'main-acesso-negado';
            return $this->render('/site/acesso_negado');
    }
}
