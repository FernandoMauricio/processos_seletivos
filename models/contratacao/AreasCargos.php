<?php

namespace app\models\contratacao;

use Yii;

use app\models\processoseletivo\Cargos;

/**
 * This is the model class for table "areas_cargos".
 *
 * @property integer $id
 * @property integer $area_id
 * @property integer $cargo_id
 *
 * @property Areas $area
 * @property Cargos $cargo
 */
class AreasCargos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas_cargos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'cargo_id'], 'required'],
            [['area_id', 'cargo_id'], 'integer'],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['area_id' => 'idarea']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::className(), 'targetAttribute' => ['cargo_id' => 'idcargo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Area ID',
            'cargo_id' => 'Cargo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['idarea' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargos::className(), ['idcargo' => 'cargo_id']);
    }
}
