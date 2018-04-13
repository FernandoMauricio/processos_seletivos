<?php

namespace app\models\processoseletivo\geracaoarquivo;

use Yii;

/**
 * This is the model class for table "geracaoarquivos_itens".
 *
 * @property integer $id
 * @property string $gerarqitens_candidato
 * @property string $gerarqitens_horario
 * @property string $gerarqitens_tema
 * @property integer $geracaoarquivos_id
 *
 * @property GeracaoArquivos $geracaoarquivos
 */
class GeracaoarquivosItens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geracaoarquivos_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gerarqitens_candidato', 'geracaoarquivos_id'], 'required'],
            [['gerarqitens_horario', 'gerarqitens_pontuacao'], 'safe'],
            [['geracaoarquivos_id'], 'integer'],
            [['gerarqitens_candidato', 'gerarqitens_tema', 'gerarqitens_classificacao'], 'string', 'max' => 255],
            [['geracaoarquivos_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeracaoArquivos::className(), 'targetAttribute' => ['geracaoarquivos_id' => 'gerarq_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gerarqitens_candidato' => 'Candidatos',
            'gerarqitens_horario' => 'Horário',
            'gerarqitens_tema' => 'Tema da Aula',
            'gerarqitens_classificacao' => 'Classificação',
            'geracaoarquivos_id' => 'Geracaoarquivos ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeracaoarquivos()
    {
        return $this->hasOne(GeracaoArquivos::className(), ['gerarq_id' => 'geracaoarquivos_id']);
    }
}
