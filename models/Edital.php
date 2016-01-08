<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "edital".
 *
 * @property integer $id
 * @property string $edital
 * @property integer $processo_id
 *
 * @property Processo $processo
 */
class Edital extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edital';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edital', 'processo_id'], 'required'],
            [['processo_id'], 'integer'],
            [['edital'], 'string', 'max' => 165]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'edital' => 'Edital',
            'processo_id' => 'Processo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesso()
    {
        return $this->hasOne(Processo::className(), ['id' => 'processo_id']);
    }
}
