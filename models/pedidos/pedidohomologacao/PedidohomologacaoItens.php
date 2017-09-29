<?php

namespace app\models\pedidos\pedidohomologacao;

use Yii;

/**
 * This is the model class for table "pedidohomologacao_itens".
 *
 * @property integer $pedhomolog_id
 * @property string $pedhomolog_classificacao
 * @property string $pedhomolog_candidato
 * @property integer $pedidohomologacao_id
 *
 * @property PedidoHomologacao $pedidohomologacao
 */
class PedidohomologacaoItens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidohomologacao_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedidohomologacao_id'], 'required'],
            [['pedidohomologacao_id'], 'integer'],
            [['pedhomolog_classificacao', 'pedhomolog_candidato'], 'string', 'max' => 255],
            [['pedidohomologacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => PedidoHomologacao::className(), 'targetAttribute' => ['pedidohomologacao_id' => 'homolog_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pedhomolog_id' => 'Pedhomolog ID',
            'pedhomolog_classificacao' => 'Pedhomolog Classificacao',
            'pedhomolog_candidato' => 'Pedhomolog Candidato',
            'pedidohomologacao_id' => 'Pedidohomologacao ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidohomologacao()
    {
        return $this->hasOne(PedidoHomologacao::className(), ['homolog_id' => 'pedidohomologacao_id']);
    }
}
