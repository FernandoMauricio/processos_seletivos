<?php

namespace app\controllers\pedidos;

use Yii;
use app\models\contratacao\Contratacao;
use app\models\etapasprocesso\EtapasProcesso;
use app\models\processoseletivo\ProcessoSeletivo;
use app\models\pedidos\pedidocontratacao\PedidocontratacaoItens;
use app\models\pedidos\pedidocontratacao\PedidoContratacao;
use app\models\pedidos\pedidocontratacao\PedidoContratacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
        $searchModel = new PedidoContratacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoContratacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Localiza os Processo Seletivos
    public function actionGetCandidatosAprovados() {
                $out = [];
                if (isset($_POST['depdrop_parents'])) {
                    $parents = $_POST['depdrop_parents'];
                    if ($parents != null) {
                        $cat_id = $parents[0];
                        $out = EtapasProcesso::getCandidatosAprovadosSubCat($cat_id);
                        echo Json::encode(['output'=>$out, 'selected'=>'']);
                        return;
                    }
                }
                echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Creates a new PedidoContratacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session     = Yii::$app->session;
        $model       = new PedidoContratacao();
        $modelsItens = [new PedidocontratacaoItens];

        $model->pedcontratacao_situacaoggp = 1; //Aguardando Autorização GPP
        $model->pedcontratacao_situacaodad = 1; //Aguardando Autorização DAD
        $model->pedcontratacao_data        = date('Y-m-d');
        $model->pedcontratacao_responsavel = $session['sess_nomeusuario'];
        $model->pedcontratacao_recursos    = 'PRÓPRIOS';

        //1 => Em elaboração / 2 => Em correção pelo setor
        $contratacoes = Contratacao::find()->where(['!=','situacao_id', 1])->andWhere(['!=','situacao_id', 2])->orderBy('id')->all();

        $processo = ProcessoSeletivo::find()->where(['situacao_id' => 1])->orWhere(['situacao_id' => 2])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pedcontratacao_id]);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pedcontratacao_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
