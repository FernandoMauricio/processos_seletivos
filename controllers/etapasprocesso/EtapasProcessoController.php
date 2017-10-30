<?php

namespace app\controllers\etapasprocesso;

use Yii;
use app\models\Model;
use app\models\curriculos\CurriculosAdmin;
use app\models\processoseletivo\CargosProcesso;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\pedidos\pedidocusto\PedidoCusto;
use app\models\etapasprocesso\EtapasProcesso;
use app\models\etapasprocesso\EtapasProcessoSearch;
use app\models\etapasprocesso\EtapasItens;
use app\models\etapasprocesso\EtapasItensSearch;
use app\models\etapasprocesso\Usuarios;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * EtapasProcessoController implements the CRUD actions for EtapasProcesso model.
 */
class EtapasProcessoController extends Controller
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
     * Lists all EtapasProcesso models.
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
        $searchModel = new EtapasProcessoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EtapasProcesso model.
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
        $itens = EtapasItens::find()->innerJoinWith('curriculos')->where(['etapasprocesso_id' => $model->etapa_id])->orderBy(['itens_pontuacaototal' => SORT_DESC, 'nome' => SORT_ASC])->all();

        return $this->render('view', [
            'model' => $model,
            'itens' => $itens,
        ]);
    }

    //Localiza os cargos vinculado ao Processo Seletivo
    public function actionCargosEtapasProcesso() {
                $out = [];
                if (isset($_POST['depdrop_parents'])) {
                    $parents = $_POST['depdrop_parents'];
                    if ($parents != null) {
                        $cat_id = $parents[0];
                        $out = CargosProcesso::getCargosEtapasProcessoSubCat($cat_id);
                        echo Json::encode(['output'=>$out, 'selected'=>'']);
                        return;
                    }
                }
                echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Creates a new EtapasProcesso model.
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

        $model = new EtapasProcesso();

        $model->etapa_data = date('Y-m-d H:i:s');
        $model->etapa_atualizadopor = $session['sess_nomeusuario'];
        $model->etapa_dataatualizacao = date('Y-m-d H:i:s');
        $model->etapa_situacao = 'Em Processo';

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();
        $pedidoCusto = PedidoCusto::find()->select(['custo_id', new \yii\db\Expression("CONCAT(`custo_id`, ' - ', `custo_assunto`) as custo_assunto")])->where(['custo_situacaoggp' => 4, 'custo_situacaodad' => 4])->andWhere(['custo_situacao' => 2])->all(); //Aprovado pelo GGP e DAD / Situação em processo

        if ($model->load(Yii::$app->request->post())) {

            //Verifica se existe alguma etapa do proecsso criada do processo e cargo selecionado
            if(EtapasProcesso::find()->where(['processo_id' => $model->processo_id, 'etapa_cargo' => $model->etapa_cargo])->count() > 0) {
                Yii::$app->session->setFlash('danger', '<b>ERRO! </b>Etapas do Processo Seletivo <b>'.$model->processo->numeroEdital.'</b> para o cargo <b>' .$model->etapa_cargo. '</b> já criado!</b>');
                return $this->redirect(['index']);
            }

            //Verifica se existe algum candiadto selecionado
            if(CurriculosAdmin::find()->where(['classificado'=> 1, 'edital' => $model->processo->numeroEdital, 'cargo' => $model->etapa_cargo])->count() == 0) {
                Yii::$app->session->setFlash('warning', '<b>AVISO! </b>Não existem candidatos selecionados!</b>');
                return $this->redirect(['index']);
            }

        $model->save();

        //Localiza somente os candidatos classificados para o edital escolhido
        $sqlCandidatos = '
            SELECT `curriculos`.`id`, `curriculos`.`edital`, `curriculos`.`nome` 
            FROM `curriculos` 
            LEFT JOIN `processo` ON `curriculos`.`edital` = `processo`.`numeroEdital` 
            WHERE (`classificado`= 1) 
            AND `curriculos`.`edital` = "'.$model->processo->numeroEdital.'" 
            AND `curriculos`.`cargo` = "'.$model->etapa_cargo.'"
            ORDER BY  `curriculos`.`nome` ASC
        ';

        $candidatos = CurriculosAdmin::findBySql($sqlCandidatos)->all();

        foreach ($candidatos as $candidato) {
        //Inclui as informações dos candidatos classificados
                Yii::$app->db->createCommand()
                    ->insert('etapas_itens', [
                             'etapasprocesso_id'    => $model->etapa_id,
                             'curriculos_id'        => $candidato['id'],
                             'itens_escrita'        => 0,
                             'itens_didatica'       => 0,
                             'itens_comportamental' => 0,
                             'itens_entrevista'     => 0,
                             'itens_pratica'        => 0,
                             ])
                    ->execute();
            $model->save();
        }

        Yii::$app->session->setFlash('success', '<b>SUCESSO! </b>Etapas do Processo Seletivo <b>'.$model->processo->numeroEdital.'</b> para o cargo <b>' .$model->etapa_cargo. '</b> criado com sucesso!</b>');

            return $this->redirect(['update', 'id' => $model->etapa_id]);
        } else {
            return $this->renderAjax('criar-etapas-processo', [
                'model' => $model,
                'processo' => $processo,
                'pedidoCusto' => $pedidoCusto,
            ]);
        }
    }

    /**
     * Updates an existing EtapasProcesso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main-full';
        
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $model = $this->findModel($id);
        $model->scenario = 'update'; //Validações obrigatórias na atualização

        $itens = EtapasItens::find()->innerJoinWith('curriculos')->where(['etapasprocesso_id' => $model->etapa_id])->orderBy(['itens_pontuacaototal' => SORT_DESC, 'nome' => SORT_ASC])->all();
        $selecionadores = Usuarios::find()->where(['usu_codsituacao' => 1, 'usu_codtipo' => 2])->orderBy(['usu_nomeusuario' => SORT_ASC])->all();

        //Mostrará os Selecionadores das etapas do processo
        $model->etapa_selecionadores = explode(", ",$model->etapa_selecionadores);

        //Verifica se já existe algum Pedido de Contratação criado para essa Etapa de Processo
        // if(isset($model->pedidoContratacao->etapasprocesso_id)) {
        //     Yii::$app->session->setFlash('danger', '<b>ERRO! </b> Não é possível <b>EDITAR</b> pois já existe <b>Pedido de Contratação</b> criado.');
        //     return $this->redirect(['index']);
        // }

        if ($model->load(Yii::$app->request->post())) {

            $model->etapa_atualizadopor = $session['sess_nomeusuario'];
            $model->etapa_dataatualizacao = date('Y-m-d H:i:s');
            //Transformará os Selecionadores em um string separados por ,
            $model->etapa_selecionadores = implode(", ",$model->etapa_selecionadores);
            $model->save();

        //Input dos candidados selecionados da etapa
        foreach ($itens as $i => $etapa) {
            $etapa->etapasprocesso_id        = $model->etapa_id;
            $etapa->itens_confirmacaocontato = $_POST['EtapasItens'][$i]['itens_confirmacaocontato'];
            $etapa->itens_escrita            = $_POST['EtapasItens'][$i]['itens_escrita'];
            $etapa->itens_comportamental     = $_POST['EtapasItens'][$i]['itens_comportamental'];
            $etapa->itens_didatica           = $_POST['EtapasItens'][$i]['itens_didatica'];
            $etapa->itens_entrevista         = $_POST['EtapasItens'][$i]['itens_entrevista'];
            $etapa->itens_pratica            = $_POST['EtapasItens'][$i]['itens_pratica'];
            $etapa->itens_pontuacaototal     = $_POST['EtapasItens'][$i]['itens_pontuacaototal'];
            $etapa->itens_classificacao      = $_POST['EtapasItens'][$i]['itens_classificacao'];
            $etapa->itens_localcontratacao   = $_POST['EtapasItens'][$i]['itens_localcontratacao'];
            $etapa->update(false); // skipping validation as no user input is involved

            //Atualiza o local de contrtação do Pedido de Homologação
            Yii::$app->db->createCommand()
            ->update('pedidohomologacao_itens', [
                     'pedhomolog_localcontratacao' => $etapa->itens_localcontratacao,
                     ], [//------WHERE
                     'curriculos_id' => $etapa->curriculos_id,
                     ]) 
            ->execute();
        }

        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>Dados Atualizados!</strong>');

            return $this->redirect(['update', 'id' => $model->etapa_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'itens' => $itens,
                'selecionadores' => $selecionadores,
            ]);
        }
    }

    /**
     * Deletes an existing EtapasProcesso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //Verifica se já existe algum Pedido de Contratação criado para essa Etapa de Processo
        if(isset($model->pedidoContratacao->etapasprocesso_id)) {
            Yii::$app->session->setFlash('danger', '<b>ERRO! </b> Não é possível <b>EXCLUIR</b> pois já existe <b>Pedido de Contratação</b> criado.');
            return $this->redirect(['index']);
        }
        if(isset($model->geracaoArquivos->etapasprocesso_id)) {//Verifica se já existe algum Resultado das Etapas ou Resultado Final criado na tela de Geração de Arquivos
            Yii::$app->session->setFlash('danger', '<b>ERRO! </b> Não é possível <b>EXCLUIR</b> pois já existe <b>Resultado das Etapas ou Resultado Final</b> criado na tela de Geração de Arquivos.');
            return $this->redirect(['index']);
        }
        else{
        EtapasItens::deleteAll('etapasprocesso_id = "'.$id.'"');
        $model->delete(); //Exclui a etapa do processo
        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Etapa do Processo excluido!</strong>');
        return $this->redirect(['index']);
        }
    }

    /**
     * Finds the EtapasProcesso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EtapasProcesso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EtapasProcesso::findOne($id)) !== null) {
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
