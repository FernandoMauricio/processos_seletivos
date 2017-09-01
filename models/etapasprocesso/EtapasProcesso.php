<?php

namespace app\models\etapasprocesso;

use Yii;

use app\models\processoseletivo\ProcessoSeletivo;

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
            [['processo_id'], 'required'],
            [['processo_id'], 'integer'],
            [['etapa_data', 'etapa_dataatualizacao', 'etapa_selecionadores'], 'safe'],
            [['etapa_cargo', 'etapa_observacao'], 'string', 'max' => 255],
            [['etapa_datarealizacao', 'etapa_local', 'etapa_cidade', 'etapa_estado', 'etapa_atualizadopor', 'etapa_situacao'], 'string', 'max' => 45],
            [['processo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoSeletivo::className(), 'targetAttribute' => ['processo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'etapa_id' => 'Cód',
            'processo_id' => 'Documento Abertura',
            'etapa_cargo' => 'Cargo',
            'etapa_datarealizacao' => 'Data da Realização',
            'etapa_local' => 'Local',
            'etapa_cidade' => 'Cidade',
            'etapa_estado' => 'Estado',
            'etapa_selecionadores' => 'Selecionadores',
            'etapa_data' => 'Data da Criação',
            'etapa_atualizadopor' => 'Atualizado Por',
            'etapa_dataatualizacao' => 'Data atualização',
            'etapa_situacao' => 'Situação',
            'etapa_observacao' => 'Observação',
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
}
