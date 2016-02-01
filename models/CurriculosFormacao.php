<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curriculos_formacao".
 *
 * @property integer $id
 * @property integer $fundamental_inc
 * @property integer $fundamental_comp
 * @property integer $medio_inc
 * @property integer $medio_comp
 * @property integer $superior_inc
 * @property integer $superior_comp
 * @property string $superior_area
 * @property integer $pos
 * @property string $pos_area
 * @property integer $mestrado
 * @property string $mestrado_area
 * @property integer $doutorado
 * @property string $doutorado_area
 * @property integer $estuda_atualmente
 * @property string $estuda_curso
 * @property integer $estuda_turno
 * @property integer $curriculos_id
 *
 * @property Curriculos $curriculos
 */
class CurriculosFormacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculos_formacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fundamental_inc', 'fundamental_comp', 'medio_inc', 'medio_comp', 'superior_inc', 'superior_comp', 'pos', 'mestrado', 'doutorado', 'estuda_atualmente', 'estuda_turno', 'curriculos_id'], 'integer'],
            [['curriculos_id'], 'required'],
            [['superior_area', 'pos_area', 'mestrado_area', 'doutorado_area'], 'string', 'max' => 45],
            [['estuda_curso'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fundamental_inc' => 'Fundamental Inc',
            'fundamental_comp' => 'Fundamental Comp',
            'medio_inc' => 'Medio Inc',
            'medio_comp' => 'Medio Comp',
            'superior_inc' => 'Superior Inc',
            'superior_comp' => 'Superior Comp',
            'superior_area' => 'Superior Area',
            'pos' => 'Pos',
            'pos_area' => 'Pos Area',
            'mestrado' => 'Mestrado',
            'mestrado_area' => 'Mestrado Area',
            'doutorado' => 'Doutorado',
            'doutorado_area' => 'Doutorado Area',
            'estuda_atualmente' => 'Estuda Atualmente',
            'estuda_curso' => 'Estuda Curso',
            'estuda_turno' => 'Estuda Turno',
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
}
