<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curriculos_complemento".
 *
 * @property integer $id
 * @property string $cursos
 * @property integer $certificado
 * @property integer $curriculos_id
 *
 * @property Curriculos $curriculos
 * @property CurriculosCurriculosComplementos[] $curriculosCurriculosComplementos
 */
class CurriculosComplemento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculos_complemento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['certificado', 'curriculos_id'], 'integer'],
            [['cursos'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cursos' => 'Curso',
            'certificado' => 'Tem certificado?',
            'curriculos_id' => 'Curriculos ID',
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
    public function getCurriculosCurriculosComplementos()
    {
        return $this->hasMany(CurriculosCurriculosComplementos::className(), ['curriculos_complemento_id' => 'id']);
    }
}
