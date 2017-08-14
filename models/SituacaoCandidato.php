<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "situacao_candidato".
 *
 * @property integer $sitcan_id
 * @property string $sitcan_descricao
 * @property integer $sitcan_status
 *
 * @property Curriculos[] $curriculos
 */
class SituacaoCandidato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situacao_candidato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sitcan_descricao', 'sitcan_status'], 'required'],
            [['sitcan_status'], 'integer'],
            [['sitcan_descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sitcan_id' => 'Sitcan ID',
            'sitcan_descricao' => 'Sitcan Descricao',
            'sitcan_status' => 'Sitcan Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculos()
    {
        return $this->hasMany(Curriculos::className(), ['classificado' => 'sitcan_id']);
    }
}
