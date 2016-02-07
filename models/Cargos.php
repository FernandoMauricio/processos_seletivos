<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargos".
 *
 * @property integer $idcargo
 * @property string $descricao
 *
 * @property CargosProcesso[] $cargosProcessos
 */
class Cargos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['status'], 'integer'],
            [['descricao'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcargo' => 'Código',
            'descricao' => 'Descrição',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargosProcessos()
    {
        return $this->hasMany(CargosProcesso::className(), ['cargo_id' => 'idcargo']);
    }
}
