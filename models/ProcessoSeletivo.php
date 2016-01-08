<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "processo".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $data
 * @property string $numeroEdital
 * @property string $objetivo
 * @property integer $status
 * @property integer $situacao_id
 * @property integer $modalidade_id
 * @property string $data_encer
 *
 * @property Modalidade $modalidade
 * @property Situacao $situacao
 * @property Resultados[] $resultados
 */
class ProcessoSeletivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'processo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'data', 'numeroEdital', 'objetivo', 'modalidade_id', 'data_encer','status', 'situacao_id',], 'required'],
            [['data', 'data_encer'], 'safe'],
            [['objetivo'], 'string'],
            [['status', 'situacao_id', 'modalidade_id'], 'integer'],
            [['descricao'], 'string', 'max' => 100],
            [['numeroEdital'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'descricao' => 'Descrição',
            'data' => 'Data de Abertura',
            'data_encer' => 'Data de Encerramento',
            'numeroEdital' => 'Edital',
            'objetivo' => 'Objetivo',
            'status' => 'Publicação no site:',
            'situacao_id' => 'Situação:',
            'modalidade_id' => 'Modalidade:',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModalidade()
    {
        return $this->hasOne(Modalidade::className(), ['id' => 'modalidade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(Situacao::className(), ['id' => 'situacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResultados()
    {
        return $this->hasMany(Resultados::className(), ['processo_id' => 'id']);
    }
}
