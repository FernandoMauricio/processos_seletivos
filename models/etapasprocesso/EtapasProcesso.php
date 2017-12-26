<?php

namespace app\models\etapasprocesso;

use Yii;

use app\models\processoseletivo\ProcessoSeletivo;
use app\models\pedidos\pedidocusto\PedidoCusto;
use app\models\pedidos\pedidocontratacao\PedidocontratacaoItens;
use app\models\processoseletivo\geracaoarquivo\GeracaoArquivos;

/**
 * This is the model class for table "etapas_processo".
 *
 * @property integer $etapa_id
 * @property integer $processo_id
 * @property string $etapa_cargo
 * @property string $etapa_datarealizacao
 * @property string $etapa_local
 * @property string $etapa_cidade
 * @property string $etapa_estado
 * @property string $etapa_selecionadores
 * @property string $etapa_data
 * @property string $etapa_atualizadopor
 * @property string $etapa_dataatualizacao
 * @property string $etapa_situacao
 *
 * @property EtapasItens[] $etapasItens
 * @property Processo $processo
 */
class EtapasProcesso extends \yii\db\ActiveRecord
{
    public $processoSeletivo;
    public $contratacao_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etapas_processo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['processo_id', 'pedidocusto_id', 'etapa_cargo' ,'etapa_perfil', 'etapa_cidade'], 'required'],
            [['etapa_selecionadores','etapa_local', 'etapa_cidade', 'etapa_estado', 'etapa_situacao'], 'required', 'on' => 'update'],
            [['processo_id', 'etapa_perfil', 'contratacao_id'], 'integer'],
            [['etapa_data', 'etapa_dataatualizacao', 'etapa_selecionadores'], 'safe'],
            [['etapa_cargo', 'etapa_observacao', 'etapa_local'], 'string', 'max' => 255],
            [['etapa_datarealizacao', 'etapa_cidade', 'etapa_estado', 'etapa_atualizadopor', 'etapa_situacao'], 'string', 'max' => 45],
            [['pedidocusto_id'], 'exist', 'skipOnError' => true, 'targetClass' => PedidoCusto::className(), 'targetAttribute' => ['pedidocusto_id' => 'custo_id']],
            [['processo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoSeletivo::className(), 'targetAttribute' => ['processo_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['etapa_selecionadores','etapa_local', 'etapa_cidade', 'etapa_estado', 'etapa_situacao', 'etapa_observacao', 'pedidocusto_id', 'etapa_cargo', 'etapa_atualizadopor', 'etapa_datarealizacao', 'etapa_dataatualizacao'];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'etapa_id' => 'Cód',
            'processo_id' => 'Documento de Abertura',
            'pedidocusto_id' => 'Pedido de Custo',
            'etapa_cargo' => 'Cargo',
            'etapa_datarealizacao' => 'Data da Realização',
            'etapa_local' => 'Local',
            'etapa_cidade' => 'Cidade',
            'etapa_estado' => 'Estado',
            'etapa_selecionadores' => 'Nome dos Selecionadores',
            'etapa_data' => 'Data da Criação',
            'etapa_atualizadopor' => 'Atualizado Por',
            'etapa_dataatualizacao' => 'Data Atualização',
            'etapa_situacao' => 'Situação',
            'etapa_observacao' => 'Cronograma das Etapas',
            'etapa_perfil' => 'Perfil das Etapas',
            'processoSeletivo' => 'Documento de Abertura',
            'contratacao_id' => 'Solicitação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtapasItens()
    {
        return $this->hasMany(EtapasItens::className(), ['etapasprocesso_id' => 'etapa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesso()
    {
        return $this->hasOne(ProcessoSeletivo::className(), ['id' => 'processo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocusto()
    {
        return $this->hasOne(PedidoCusto::className(), ['custo_id' => 'pedidocusto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocontratacaoItens()
    {
        return $this->hasMany(PedidocontratacaoItens::className(), ['etapasprocesso_id' => 'etapa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeracaoArquivos()
    {
        return $this->hasOne(GeracaoArquivos::className(), ['etapasprocesso_id' => 'etapa_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoContratacao()
    {
        return $this->hasOne(PedidocontratacaoItens::className(), ['etapasprocesso_id' => 'etapa_id']);
    }
}
