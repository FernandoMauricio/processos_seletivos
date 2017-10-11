<?php

namespace app\controllers\processoseletivo;

use Yii;
use app\models\curriculos\CurriculosAdmin;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\processoseletivo\geracaoarquivo\GeracaoArquivos;
use app\models\processoseletivo\geracaoarquivo\GeracaoArquivosSearch;
use app\models\processoseletivo\geracaoarquivo\GeracaoarquivosItens;
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

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

        $model = $this->findModel($id);
        $modelsItens = $model->geracaoarquivosItens;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'content' => $this->renderPartial('imprimir', ['model' => $model, 'modelsItens' => $modelsItens], 'UTF-8', 'ISO-8859-1'),
                'options' => [
                    'title' => 'Recrutamento e Seleção - Senac AM',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                ],
                'methods' => [
                    'SetHeader' => ['RESULTADOS - SENAC AM|| Manaus, ' . utf8_encode(strftime('%A, ') . strftime("%d de %B de %Y"))],
                    'SetFooter' => ['Recrutamento e Seleção - GGP||Página {PAGENO}'],
                ]
            ]);

        return $pdf->render('imprimir', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all GeracaoArquivos models.
     * @return mixed
     */
    public function actionIndex()
    {
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
        $session = Yii::$app->session;
        $model = new GeracaoArquivos();

        $model->gerarq_responsavel = $session['sess_nomeusuario'];

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                //Localiza somente os candidatos classificados para o edital escolhido
                $sqlCandidatos = '
                SELECT `curriculos`.`nome`, `curriculos`.`edital` 
                    FROM `curriculos` 
                    INNER JOIN `processo` ON `curriculos`.`edital` = `processo`.`numeroEdital`
                    INNER JOIN `etapas_itens` ON `etapas_itens`.`curriculos_id` = `curriculos`.`id`
                WHERE (`classificado`= 1) 
                    AND `curriculos`.`edital` = "'.$model->processo->numeroEdital.'"
                    AND `curriculos`.`cargo` = "'.$model->etapasprocesso->etapa_cargo.'"
                    AND `etapas_itens`.`itens_classificacao` NOT LIKE "%Desclassificado(a)%"
                ORDER BY `curriculos`.`nome` ASC

                ';

                $candidatos = CurriculosAdmin::findBySql($sqlCandidatos)->all();

                foreach ($candidatos as $candidato) {
                        //Inclui as informações dos candidatos classificados
                        Yii::$app->db->createCommand()
                            ->insert('geracaoarquivos_itens', [
                                     'geracaoarquivos_id'    => $model->gerarq_id,
                                     'gerarqitens_candidato' => $candidato['nome'],
                                     'gerarqitens_horario'   => $model->gerarq_horarealizacao,
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
        $model = $this->findModel($id);
        $model->scenario = 'update'; //Validações obrigatórias na atualização
        $modelsItens = $model->geracaoarquivosItens;

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        $model->gerarq_documentos = explode(", ",$model->gerarq_documentos);

        if ($model->load(Yii::$app->request->post())) {

            $model->gerarq_documentos = implode(", ",$model->gerarq_documentos);
            $model->save();

            return $this->redirect(['view', 'id' => $model->gerarq_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsItens' => $modelsItens,
            ]);
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
}
