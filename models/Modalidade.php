<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modalidade".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Processo[] $processos
 */
class Modalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modalidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessos()
    {
        return $this->hasMany(Processo::className(), ['modalidade_id' => 'id']);
    }
}
