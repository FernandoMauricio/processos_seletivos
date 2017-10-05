<?php

namespace app\models\processoseletivo\geracaoarquivo;

use Yii;

use app\models\curriculos\Curriculos;
use app\models\etapasprocesso\EtapasProcesso;
use app\models\processoseletivo\ProcessoSeletivo;

/**
 * This is the model class for table "geracao_arquivos".
 *
 * @property integer $gerarq_id
 * @property integer $processo_id
 * @property integer $curriculos_id
 * @property integer $etapasprocesso_id
 * @property string $gerarq_titulo
 * @property string $gerarq_documentos
 * @property string $gerarq_emailconfirmacao
 * @property string $gerarq_datarealizacao
 * @property string $gerarq_horarealizacao
 * @property string $gerarq_local
 * @property string $gerarq_endereco
 * @property string $gerarq_fase
 * @property string $gerarq_tempo
 * @property string $gerarq_responsavel
 *
 * @property Curriculos $curriculos
 * @property EtapasProcesso $etapasprocesso
 * @property Processo $processo
 */
class GeracaoArquivos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geracao_arquivos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gerarq_id', 'processo_id', 'curriculos_id', 'etapasprocesso_id', 'gerarq_titulo', 'gerarq_documentos', 'gerarq_emailconfirmacao', 'gerarq_datarealizacao', 'gerarq_horarealizacao', 'gerarq_local', 'gerarq_endereco', 'gerarq_fase', 'gerarq_tempo', 'gerarq_responsavel'], 'required'],
            [['gerarq_id', 'processo_id', 'curriculos_id', 'etapasprocesso_id'], 'integer'],
            [['gerarq_documentos', 'gerarq_fase'], 'string'],
            [['gerarq_datarealizacao', 'gerarq_horarealizacao'], 'safe'],
            [['gerarq_titulo', 'gerarq_emailconfirmacao', 'gerarq_local', 'gerarq_endereco', 'gerarq_tempo', 'gerarq_responsavel'], 'string', 'max' => 255],
            [['curriculos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculos::className(), 'targetAttribute' => ['curriculos_id' => 'id']],
            [['etapasprocesso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesso::className(), 'targetAttribute' => ['etapasprocesso_id' => 'etapa_id']],
            [['processo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoSeletivo::className(), 'targetAttribute' => ['processo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gerarq_id' => 'Gerarq ID',
            'processo_id' => 'Processo ID',
            'curriculos_id' => 'Curriculos ID',
            'etapasprocesso_id' => 'Etapasprocesso ID',
            'gerarq_titulo' => 'Gerarq Titulo',
            'gerarq_documentos' => 'Gerarq Documentos',
            'gerarq_emailconfirmacao' => 'Gerarq Emailconfirmacao',
            'gerarq_datarealizacao' => 'Gerarq Datarealizacao',
            'gerarq_horarealizacao' => 'Gerarq Horarealizacao',
            'gerarq_local' => 'Gerarq Local',
            'gerarq_endereco' => 'Gerarq Endereco',
            'gerarq_fase' => 'Gerarq Fase',
            'gerarq_tempo' => 'Gerarq Tempo',
            'gerarq_responsavel' => 'Gerarq Responsavel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculos()
    {
        return $this->hasOne(Curriculos::className(), ['id' => 'curriculos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtapasprocesso()
    {
        return $this->hasOne(EtapasProcesso::className(), ['etapa_id' => 'etapasprocesso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesso()
    {
        return $this->hasOne(Processo::className(), ['id' => 'processo_id']);
    }
}
