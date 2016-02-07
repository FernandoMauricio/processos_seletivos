<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curriculos_endereco".
 *
 * @property integer $id
 * @property string $cep
 * @property string $endereco
 * @property string $numero_end
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property integer $curriculos_id
 *
 * @property Curriculos $curriculos
 */
class CurriculosEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculos_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cep', 'endereco', 'bairro', 'cidade', 'estado', 'curriculos_id'], 'required'],
            [['curriculos_id'], 'integer'],
            [['cep'], 'string', 'max' => 45],
            [['endereco', 'complemento'], 'string', 'max' => 255],
            [['numero_end'], 'string', 'max' => 20],
            [['bairro', 'cidade', 'estado'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cep' => 'Cep',
            'endereco' => 'Endereco',
            'numero_end' => 'Numero End',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
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
