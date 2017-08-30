<?php

namespace app\controllers\etapasprocesso;

use Yii;
use app\models\curriculos\CurriculosAdmin;
use app\models\processoseletivo\CargosProcesso;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\etapasprocesso\EtapasProcesso;
use app\models\etapasprocesso\EtapasProcessoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $session = Yii::$app->session;

        $model = new EtapasProcesso();

        $model->etapa_data = date('Y-m-d H:i:s');
        $model->etapa_atualizadopor = $session['sess_nomeusuario'];
        $model->etapa_dataatualizacao = date('Y-m-d H:i:s') ;
        $model->etapa_situacao = 'Em Processo';

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        //Localiza somente os candidatos classificados para o edital escolhido
        $sqlCandidatos = 'SELECT `curriculos`.`id`, `curriculos`.`edital` FROM `curriculos` LEFT JOIN `processo` ON `curriculos`.`edital` = `processo`.`numeroEdital` WHERE (`classificado`= 1) AND `curriculos`.`edital` = "'.$model->processo->numeroEdital.'" AND `curriculos`.`cargo` = "'.$model->etapa_cargo.'"';

            $candidatos = CurriculosAdmin::findBySql($sqlCandidatos)->all();
        
        foreach ($candidatos as $candidato) {
           $etapasprocesso_id  = $model->etapa_id;
           $curriculos_id      = $candidato['id'];


        //Inclui as informações dos candidatos classificados
                Yii::$app->db->createCommand()
                    ->insert('etapas_itens', [
                             'etapasprocesso_id' => $etapasprocesso_id,
                             'curriculos_id'     => $curriculos_id,
                             'itens_analisarperfil' =>0,
                             'itens_comportamental' =>0,
                             'itens_entrevista'     =>0,
                             
                             ])
                    ->execute();
        }
            return $this->redirect(['update', 'id' => $model->etapa_id]);
        } else {
            return $this->renderAjax('criar-etapas-processo', [
                'model' => $model,
                'processo' => $processo,
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
        $model = $this->findModel($id);

        $modelsEtapasItens  = $model->etapasItens;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->etapa_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsEtapasItens' => $modelsEtapasItens,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
