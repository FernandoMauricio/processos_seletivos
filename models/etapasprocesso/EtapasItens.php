<?php

namespace app\models\etapasprocesso;

use Yii;

use app\models\curriculos\Curriculos;

/**
 * This is the model class for table "etapas_itens".
 *
 * @property integer $id
 * @property integer $etapasprocesso_id
 * @property integer $curriculos_id
 * @property double $itens_analisarperfil
 * @property double $itens_comportamental
 * @property double $itens_entrevista
 * @property double $itens_pontuacaototal
 * @property string $itens_classificacao
 *
 * @property Curriculos $curriculos
 * @property EtapasProcesso $etapasprocesso
 */
class EtapasItens extends \yii\db\ActiveRecord
{
    public $inscricao;
    public $nome;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etapas_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['etapasprocesso_id', 'curriculos_id'], 'required'],
            [['etapasprocesso_id', 'curriculos_id'], 'integer'],
            [['itens_analisarperfil', 'itens_comportamental', 'itens_entrevista', 'itens_pontuacaototal'], 'number'],
            [['itens_classificacao', 'nome', 'inscricao'], 'string', 'max' => 255],
            [['curriculos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculos::className(), 'targetAttribute' => ['curriculos_id' => 'id']],
            [['etapasprocesso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesso::className(), 'targetAttribute' => ['etapasprocesso_id' => 'etapa_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Itens ID',
            'etapasprocesso_id' => 'Etapasprocesso ID',
            'curriculos_id' => 'Curriculos ID',
            'itens_analisarperfil' => 'Análise de Perfil',
            'itens_comportamental' => 'Avaliação Comportamental',
            'itens_entrevista' => 'Entrevista',
            'itens_pontuacaototal' => 'Pontuação Total',
            'itens_classificacao' => 'Classificação',
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
}
