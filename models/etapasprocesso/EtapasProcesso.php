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
            [['etapa_data', 'etapa_dataatualizacao'], 'safe'],
            [['etapa_cargo', 'processoSeletivo'], 'string', 'max' => 255],
            [['etapa_atualizadopor', 'etapa_situacao'], 'string', 'max' => 45],
            [['processo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoSeletivo::className(), 'targetAttribute' => ['processo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'etapa_id' => 'Cód.',
            'processo_id' => 'Pedido de Custo',
            'processoSeletivo' => 'Documento de Abertura',
            'etapa_cargo' => 'Cargo',
            'etapa_data' => 'Data da Criação',
            'etapa_atualizadopor' => 'Última atualização',
            'etapa_dataatualizacao' => 'Data última atualização',
            'etapa_situacao' => 'Situação',
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
