<?php

namespace app\models\curriculos;

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
class CurriculosComplementos extends \yii\db\ActiveRecord
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
            [['certificado', 'carga_horaria', 'curriculos_id'], 'integer'],
            [['cursos'], 'string', 'max' => 100],
            [['local'], 'string', 'max' => 255],
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
            'local' => 'Onde?',
            'carga_horaria' => 'Qual carga horária?',
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
