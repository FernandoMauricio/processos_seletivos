<?php

namespace app\models\pedidos\pedidohomologacao;

use Yii;

use app\models\contratacao\Contratacao;
use app\models\pedidos\pedidocusto\PedidocustoSituacao;
use app\models\pedidos\pedidocontratacao\PedidocontratacaoItens;

/**
 * This is the model class for table "pedido_homologacao".
 *
 * @property integer $homolog_id
 * @property integer $contratacao_id
 * @property string $homolog_cargo
 * @property double $homolog_salario
 * @property double $homolog_encargos
 * @property double $homolog_total
 * @property string $homolog_tipo
 * @property string $homolog_unidade
 * @property string $homolog_motivo
 * @property string $homolog_sintese
 * @property string $homolog_validade
 * @property string $homolog_aprovadorggp
 * @property integer $homolog_situacaoggp
 * @property string $homolog_dataaprovacaoggp
 * @property string $homolog_aprovadordad
 * @property integer $homolog_situacaodad
 * @property string $homolog_dataaprovacaodad
 * @property string $homolog_responsavel
 *
 * @property Contratacao $contratacao
 * @property PedidocustoSituacao $homologSituacaoggp
 * @property PedidocustoSituacao $homologSituacaodad
 */
class PedidoHomologacao extends \yii\db\ActiveRecord
{
    public $candidato;
    public $edital;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_homologacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratacao_id', 'homolog_situacaoggp', 'homolog_situacaodad'], 'required'],
            [['contratacao_id', 'homolog_situacaoggp', 'homolog_situacaodad'], 'integer'],
            [['homolog_salario', 'homolog_encargos', 'homolog_total'], 'number'],
            [['homolog_sintese', 'candidato', 'edital', 'homolog_motivo'], 'string'],
            [['homolog_dataaprovacaoggp', 'homolog_dataaprovacaodad', 'homolog_data', 'homolog_datahomologacao', 'homolog_tipo'], 'safe'],
            [['homolog_cargo', 'homolog_unidade', 'homolog_validade', 'homolog_fases'], 'string', 'max' => 255],
            [['homolog_aprovadorggp', 'homolog_aprovadordad', 'homolog_responsavel'], 'string', 'max' => 45],
            [['contratacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contratacao::className(), 'targetAttribute' => ['contratacao_id' => 'id']],
            [['homolog_situacaoggp'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['homolog_situacaoggp' => 'situacao_id']],
            [['homolog_situacaodad'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['homolog_situacaodad' => 'situacao_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'homolog_id' => 'Cód. Homologação',
            'contratacao_id' => 'Solicitação',
            'homolog_fases' => 'Fases Realizadas no Processo',
            'homolog_cargo' => 'Cargo',
            'homolog_salario' => 'Remuneração',
            'homolog_encargos' => 'Encargos',
            'homolog_total' => 'Total',
            'homolog_tipo' => 'Tipo de Contrato',
            'homolog_unidade' => 'Unidade',
            'homolog_motivo' => 'Motivo da Solicitação',
            'homolog_sintese' => 'Sintese do Processo Seletivo',
            'homolog_validade' => 'Validade do Processo',
            'homolog_aprovadorggp' => 'Aprovadorggp',
            'homolog_situacaoggp' => 'Situação GGP',
            'homolog_dataaprovacaoggp' => 'Dataaprovacaoggp',
            'homolog_aprovadordad' => 'Aprovadordad',
            'homolog_situacaodad' => 'Situação DAD',
            'homolog_dataaprovacaodad' => 'Dataaprovacaodad',
            'homolog_responsavel' => 'Responsavel',
            'homolog_data' => 'Data',
            'homolog_datahomologacao' => 'Data da Homologação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacao()
    {
        return $this->hasOne(Contratacao::className(), ['id' => 'contratacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomologSituacaoggp()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'homolog_situacaoggp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomologSituacaodad()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'homolog_situacaodad']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidohomologacaoItens()
    {
        return $this->hasMany(PedidohomologacaoItens::className(), ['pedidohomologacao_id' => 'homolog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtapasProcesso()
    {
        return $this->hasOne(PedidohomologacaoItens::className(), ['pedidohomologacao_id' => 'homolog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocontratacaoItens()
    {
        return $this->hasOne(PedidocontratacaoItens::className(), ['contratacao_id' => 'contratacao_id']);
    }
}
