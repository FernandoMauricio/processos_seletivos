<?php

namespace app\controllers\curriculos;

use Yii;
use app\models\Model;
use app\models\pedidos\pedidohomologacao\CadastroDeReservaSearch;
use app\models\pedidos\pedidohomologacao\PedidoHomologacao;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * EtapasProcessoController implements the CRUD actions for EtapasProcesso model.
 */
class CadastroDeReservaController extends Controller
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
        $searchModel = new CadastroDeReservaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/cadastro-de-reserva/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}