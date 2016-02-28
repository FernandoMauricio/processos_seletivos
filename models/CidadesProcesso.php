<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidades_processo".
 *
 * @property integer $id
 * @property integer $cidade_id
 * @property integer $processo_id
 *
 * @property Cidades $cidade
 * @property Processo $processo
 */
class CidadesProcesso extends \yii\db\ActiveRecord
{

    public $permissions;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidades_processo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cidade_id', 'processo_id'], 'required'],
            [['cidade_id', 'processo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cidade_id' => 'Cidade ID',
            'processo_id' => 'Processo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidade()
    {
        return $this->hasOne(Cidades::className(), ['idcidade' => 'cidade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesso()
    {
        return $this->hasOne(Processo::className(), ['id' => 'processo_id']);
    }
}
