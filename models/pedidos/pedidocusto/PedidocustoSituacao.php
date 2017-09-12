<?php

namespace app\models\pedidos\pedidocusto;

use Yii;

/**
 * This is the model class for table "pedidocusto_situacao".
 *
 * @property integer $situacao_id
 * @property string $situacao_descricao
 *
 * @property PedidoCusto[] $pedidoCustos
 * @property PedidoCusto[] $pedidoCustos0
 */
class PedidocustoSituacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidocusto_situacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['situacao_descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'situacao_id' => 'Situacao ID',
            'situacao_descricao' => 'Situacao Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoCustos()
    {
        return $this->hasMany(PedidoCusto::className(), ['custo_situacaoggp' => 'situacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoCustos0()
    {
        return $this->hasMany(PedidoCusto::className(), ['custo_situacaodad' => 'situacao_id']);
    }
}
