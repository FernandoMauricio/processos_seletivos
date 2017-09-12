<?php

namespace app\models\contratacao;

use Yii;

/**
 * This is the model class for table "areas".
 *
 * @property integer $idarea
 * @property string $descricao
 * @property integer $status
 *
 * @property AreasCargos[] $areasCargos
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idarea' => 'Idarea',
            'descricao' => 'Descricao',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreasCargos()
    {
        return $this->hasMany(AreasCargos::className(), ['area_id' => 'idarea']);
    }
}
