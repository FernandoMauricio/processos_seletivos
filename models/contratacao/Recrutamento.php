<?php

namespace app\models\contratacao;

use Yii;

/**
 * This is the model class for table "recrutamento".
 *
 * @property integer $idrecrutamento
 * @property string $descricao
 *
 * @property Contratacao[] $contratacaos
 */
class Recrutamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recrutamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrecrutamento' => 'Idrecrutamento',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacaos()
    {
        return $this->hasMany(Contratacao::className(), ['recrutamento_id' => 'idrecrutamento']);
    }
}
