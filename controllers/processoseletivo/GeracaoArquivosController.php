<?php

namespace app\controllers\processoseletivo;

use Yii;
use app\models\Model;
use app\models\etapasprocesso\EtapasItens;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\processoseletivo\geracaoarquivo\GeracaoArquivos;
use app\models\processoseletivo\geracaoarquivo\GeracaoArquivosSearch;
use app\models\processoseletivo\geracaoarquivo\GeracaoarquivosItens;
use app\models\curriculos\CurriculosAdmin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;

/**
 * GeracaoArquivosController implements the CRUD actions for GeracaoArquivos model.
 */
class GeracaoArquivosController extends Controller
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

    //Localiza as Etapas de Processo Vinculados ao Documento de Abertura
    public function actionEtapasProcesso() {
                $out = [];
                if (isset($_POST['depdrop_parents'])) {
                    $parents = $_POST['depdrop_parents'];
                    if ($parents != null) {
                        $cat_id = $parents[0];
                        $out = GeracaoArquivos::getEtapasProcessoSubCat($cat_id);
                        echo Json::encode(['output'=>$out, 'selected'=>'']);
                        return;
                    }
                }
                echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionImprimir($id) {

    setlocale(LC_ALL, "pt_BR", "pt_BR.ISO-8859-1", "pt_BR.UTF-8", "portuguese");

        $model = $this->findModel($id);
        $modelsItens = $model->geracaoarquivosItens;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'content' => $model->gerarq_tipo == 0 ? $this->renderPartial('imprimir', ['model' => $model, 'modelsItens' => $modelsItens], 'UTF-8', 'ISO-8859-1') : $this->renderPartial('imprimir-resultado-final', ['model' => $model, 'modelsItens' => $modelsItens], 'UTF-8', 'ISO-8859-1'),
                'options' => [
                    'title' => 'Recrutamento e Seleção - Senac AM',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                ],
                'methods' => [
                    'SetHeader' => ['RESULTADOS - SENAC AM|| Manaus, ' . strftime('%A, ') . strftime("%d de %B de %Y")],
                    'SetFooter' => ['Recrutamento e Seleção - GGP||Página {PAGENO}'],
                ]
            ]);

            if($model->gerarq_tipo == 0) {
                return $pdf->render('imprimir', [
                    'model' => $model,
                    'modelsItens' => $modelsItens,
                ]);
            }else{
                return $pdf->render('imprimir-resultado-final', [
                    'model' => $model,
                    'modelsItens' => $modelsItens,
                ]);
            }
    }

    /**
     * Lists all GeracaoArquivos models.
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
        $searchModel = new GeracaoArquivosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeracaoArquivos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
        $session = Yii::$app->session;
        if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){
            return $this->AccessoAdministrador();
        }
        $model = $this->findModel($id);
        $modelsItens = $model->geracaoarquivosItens;

        return $this->render('view', [
            'model' => $model,
            'modelsItens' => $modelsItens
        ]);
    }

    /**
     * Creates a new GeracaoArquivos model.
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
        $model = new GeracaoArquivos();

        $model->gerarq_responsavel = $session['sess_nomeusuario'];
        $model->gerarq_horarealizacao = date('H:i');

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        if ($model->load(Yii::$app->request->post())) {


            $cidades = str_replace(',', '","', $model->etapasprocesso->etapa_cidade);

            //Verifica se existe algum candiadto selecionado para o cargo, edital e cidade
            $sqlCurriculos = 'SELECT `curriculos`.`id` 
            FROM curriculos 
            INNER JOIN curriculos_endereco ON `curriculos`.`id` = `curriculos_endereco`.`curriculos_id`
            INNER JOIN etapas_itens ON `curriculos`.`id` = `etapas_itens`.`curriculos_id`
            WHERE classificado IN (1,6)
            AND edital = "'.$model->processo->numeroEdital.'"
            AND cargo = "'.$model->etapasprocesso->etapa_cargo.'"
            AND `curriculos_endereco`.`cidade` IN ("'.str_replace(',', '","', $model->etapasprocesso->etapa_cidade).'")';

            $countCurriculos = CurriculosAdmin::findBySql($sqlCurriculos)->count();

            if($countCurriculos == 0) {
                Yii::$app->session->setFlash('warning', '<b>AVISO! </b>Não existem candidatos selecionados nas Etapas do Processos!</b>');
                return $this->redirect(['index']);
            }

            if($model->gerarq_tipo == 0){
                //Localiza somente os candidatos classificados para o edital escolhido
                $sqlCandidatos = '
                SELECT `curriculos`.`nome`, `curriculos`.`edital`,`curriculos_endereco`.`cidade`, `etapas_itens`.`itens_classificacao`, `etapas_itens`.`itens_pontuacaototal`
                FROM `curriculos` 
                    INNER JOIN `processo` ON `curriculos`.`edital` = `processo`.`numeroEdital`
                    INNER JOIN `etapas_itens` ON `etapas_itens`.`curriculos_id` = `curriculos`.`id`
                    INNER JOIN `curriculos_endereco` ON `curriculos`.`id` = `curriculos_endereco`.`curriculos_id`
                WHERE `classificado`= 1
                    AND `curriculos`.`edital` = "'.$model->processo->numeroEdital.'"
                    AND `curriculos`.`cargo` = "'.$model->etapasprocesso->etapa_cargo.'"
                    AND `curriculos_endereco`.`cidade` IN ("'.str_replace(',', '","', $model->etapasprocesso->etapa_cidade).'")
                    AND `etapas_itens`.`itens_classificacao` NOT LIKE "%Desclassificado(a)%"
                    AND `etapas_itens`.`itens_classificacao` LIKE ""
                OR `curriculos`.`edital` = "'.$model->processo->numeroEdital.'"
                    AND `curriculos`.`cargo` = "'.$model->etapasprocesso->etapa_cargo.'"
                    AND `curriculos_endereco`.`cidade` IN ("'.str_replace(',', '","', $model->etapasprocesso->etapa_cidade).'")
                    AND `etapas_itens`.`itens_classificacao` IS NULL
                ORDER BY `curriculos`.`nome` ASC
                ';
            }else{//Localiza os candidatos para listagem do Resultado Final
                $sqlCandidatos = '
                SELECT `curriculos`.`nome`, `curriculos`.`edital`,`curriculos_endereco`.`cidade`,`etapas_itens`.`itens_classificacao`, `etapas_itens`.`itens_pontuacaototal`
                FROM `curriculos` 
                    INNER JOIN `processo` ON `curriculos`.`edital` = `processo`.`numeroEdital`
                    INNER JOIN `etapas_itens` ON `etapas_itens`.`curriculos_id` = `curriculos`.`id`
                    INNER JOIN `curriculos_endereco` ON `curriculos`.`id` = `curriculos_endereco`.`curriculos_id`
                WHERE `classificado`IN (1,6) 
                    AND `curriculos`.`edital` = "'.$model->processo->numeroEdital.'"
                    AND `curriculos`.`cargo` = "'.$model->etapasprocesso->etapa_cargo.'"
                    AND `curriculos_endereco`.`cidade` IN ("'.str_replace(',', '","', $model->etapasprocesso->etapa_cidade).'")
                    AND `etapas_itens`.`itens_classificacao` NOT LIKE "%Desclassificado(a)%"
                    AND `etapas_itens`.`itens_classificacao` NOT LIKE ""
                ORDER BY `etapas_itens`.`itens_pontuacaototal` DESC, `curriculos`.`nome` ASC
                ';
            }

                $model->save();

                $candidatos = EtapasItens::findBySql($sqlCandidatos)->all();

                foreach ($candidatos as $candidato) {
                        //Inclui as informações dos candidatos classificados
                        Yii::$app->db->createCommand()
                            ->insert('geracaoarquivos_itens', [
                                     'geracaoarquivos_id'        => $model->gerarq_id,
                                     'gerarqitens_candidato'     => $candidato['nome'],
                                     'gerarqitens_horario'       => $model->gerarq_horarealizacao,
                                     'gerarqitens_pontuacao'     => $candidato['itens_pontuacaototal'],
                                     'gerarqitens_classificacao' => $candidato['itens_classificacao'],
                                     ])
                            ->execute();
                $model->save();
            }
                  return $this->redirect(['update', 'id' => $model->gerarq_id]);
        } else {
            return $this->renderAjax('criar-geracao-arquivos', [
                'model' => $model,
                'processo' => $processo,
            ]);
        }
    }

    /**
     * Updates an existing GeracaoArquivos model.
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
        $model->scenario = 'update'; //Validações obrigatórias na atualização
        $modelsItens = $model->geracaoarquivosItens;

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        $model->gerarq_documentos = explode(", ",$model->gerarq_documentos);

        if ($model->load(Yii::$app->request->post())) {

            //--------Listagem de Candidatos--------------
            $oldIDsmodelsItens = ArrayHelper::map($modelsItens, 'id', 'id');
            $modelsItens = Model::createMultiple(GeracaoarquivosItens::classname(), $modelsItens);
            Model::loadMultiple($modelsItens, Yii::$app->request->post());
            $deletedIDsmodelsItens = array_diff($oldIDsmodelsItens, array_filter(ArrayHelper::map($modelsItens, 'id', 'id')));

            $model->gerarq_documentos = is_array($model->gerarq_documentos) ? implode(", ", $model->gerarq_documentos) : null;
            $model->save();

        // validate all models
        $valid = $model->validate();
        $valid = (Model::validateMultiple($modelsItens)) && $valid;

                        if ($valid) {
                            $transaction = \Yii::$app->db->beginTransaction();
                            try {
                                if ($flag = $model->save(false)) {
                                    if (! empty($deletedIDsmodelsItens)) {
                                        GeracaoarquivosItens::deleteAll(['id' => $deletedIDsmodelsItens]);
                                    }
                                    foreach ($modelsItens as $modelItens) {
                                        $modelItens->geracaoarquivos_id = $model->gerarq_id;
                                        if (! ($flag = $modelItens->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }
                                }
                                if ($flag) {
                                    $transaction->commit();

                                    Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Documento '.$id.' Atualizado !</strong>');
                                    return $this->redirect(['view', 'id' => $model->gerarq_id]);
                                }
                            } catch (Exception $e) {
                                $transaction->rollBack();
                            }
                        }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Documento '.$id.' Atualizado !</strong>');

            return $this->redirect(['view', 'id' => $model->gerarq_id]);
        }else {
             if($model->gerarq_tipo == 0) {
                return $this->render('update', [
                    'model' => $model,
                    'modelsItens' => $modelsItens,
                ]);
            }else{
                return $this->render('update-resultado-final', [
                    'model' => $model,
                    'modelsItens' => $modelsItens,
                ]);
            }
        }
    }

    /**
     * Deletes an existing GeracaoArquivos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        GeracaoarquivosItens::deleteAll('geracaoarquivos_id = "'.$id.'"');
        $model->delete(); //Exclui a etapa do processo
        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Arquivo excluido!</strong>');
        return $this->redirect(['index']);
    }

    /**
     * Finds the GeracaoArquivos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeracaoArquivos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeracaoArquivos::findOne($id)) !== null) {
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
