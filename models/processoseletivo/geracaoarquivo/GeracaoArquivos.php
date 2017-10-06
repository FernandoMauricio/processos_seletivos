<?php

namespace app\models\processoseletivo\geracaoarquivo;

use Yii;
use app\models\etapasprocesso\EtapasProcesso;
use app\models\processoseletivo\ProcessoSeletivo;

/**
 * This is the model class for table "geracao_arquivos".
 *
 * @property integer $gerarq_id
 * @property integer $processo_id
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
    public $processoSeletivo;
    public $cargoLabel;
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
            [['processo_id', 'etapasprocesso_id'], 'required'],
            [['processo_id', 'etapasprocesso_id'], 'integer'],
            [['gerarq_datarealizacao', 'gerarq_horarealizacao', 'processoSeletivo', 'cargoLabel', 'gerarq_documentos', 'gerarq_fase'], 'safe'],
            [['gerarq_titulo', 'gerarq_emailconfirmacao', 'gerarq_local', 'gerarq_endereco', 'gerarq_tempo', 'gerarq_responsavel'], 'string', 'max' => 255],
            [['etapasprocesso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesso::className(), 'targetAttribute' => ['etapasprocesso_id' => 'etapa_id']],
            [['processo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoSeletivo::className(), 'targetAttribute' => ['processo_id' => 'id']],
        ];
    }

//'gerarq_titulo', 'gerarq_documentos', 'gerarq_emailconfirmacao', 'gerarq_datarealizacao', 'gerarq_horarealizacao', 'gerarq_local', 'gerarq_endereco', 'gerarq_fase', 'gerarq_tempo', 'gerarq_responsavel'
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gerarq_id' => 'Gerarq ID',
            'processo_id' => 'Documento de Abertura',
            'etapasprocesso_id' => 'Listagem de Candidatos(cargo)',
            'gerarq_titulo' => 'Título',
            'gerarq_documentos' => 'Apresentação de Documentos',
            'gerarq_emailconfirmacao' => 'Confirmar presença para e-mail',
            'gerarq_datarealizacao' => 'Data',
            'gerarq_horarealizacao' => 'Hora',
            'gerarq_local' => 'Local',
            'gerarq_endereco' => 'Endereçoo',
            'gerarq_fase' => 'Fase',
            'gerarq_tempo' => 'Tempo',
            'gerarq_responsavel' => 'Responsavel',
            'processoSeletivo' => 'Documento de Abertura',
            'cargoLabel' => 'Listagem de Candidatos(cargo):',
        ];
    }

    //Localiza as etapas do processo vinculadas ao Documento de Abertura
    public static function getEtapasProcessoSubCat($cat_id) {
        $sql = 'SELECT `etapa_id` AS id, `etapa_cargo` AS name FROM `etapas_processo` WHERE `processo_id` = '.$cat_id.'';
        $data = EtapasProcesso::findBySql($sql)->asArray()->all();
        return $data;
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
        return $this->hasOne(ProcessoSeletivo::className(), ['id' => 'processo_id']);
    }
}
