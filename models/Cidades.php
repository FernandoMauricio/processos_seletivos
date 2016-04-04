<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidades".
 *
 * @property integer $idcidade
 * @property string $descricao
 * @property integer $status
 *
 * @property CidadesProcesso[] $cidadesProcessos
 */
class Cidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'status'], 'required'],
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
            'idcidade' => 'Código',
            'descricao' => 'Descrição',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidadesProcesso()
    {
        return $this->hasMany(CidadesProcesso::className(), ['cidade_id' => 'idcidade']);
    }
}
