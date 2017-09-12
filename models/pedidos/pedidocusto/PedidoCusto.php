<?php

namespace app\models\pedidos\pedidocusto;

use Yii;

/**
 * This is the model class for table "pedido_custo".
 *
 * @property integer $custo_id
 * @property string $custo_assunto
 * @property string $custo_recursos
 * @property double $custo_valortotal
 * @property string $custo_data
 * @property string $custo_aprovadorggp
 * @property integer $custo_situacaoggp
 * @property string $custo_dataaprovacaoggp
 * @property string $custo_aprovadordad
 * @property integer $custo_situacaodad
 * @property string $custo_dataaprovacaodad
 * @property string $custo_responsavel
 *
 * @property PedidocustoSituacao $custoSituacaoggp
 * @property PedidocustoSituacao $custoSituacaodad
 * @property PedidocustoItens[] $pedidocustoItens
 */
class PedidoCusto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_custo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custo_assunto', 'custo_recursos', 'custo_valortotal', 'custo_situacaoggp', 'custo_situacaodad'], 'required'],
            [['custo_valortotal'], 'number'],
            [['custo_data', 'custo_dataaprovacaoggp', 'custo_dataaprovacaodad'], 'safe'],
            [['custo_situacaoggp', 'custo_situacaodad'], 'integer'],
            [['custo_assunto'], 'string', 'max' => 255],
            [['custo_recursos'], 'string', 'max' => 100],
            [['custo_aprovadorggp', 'custo_aprovadordad', 'custo_responsavel'], 'string', 'max' => 45],
            [['custo_situacaoggp'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['custo_situacaoggp' => 'situacao_id']],
            [['custo_situacaodad'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['custo_situacaodad' => 'situacao_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'custo_id' => 'Cód.',
            'custo_assunto' => 'Unidade',
            'custo_recursos' => 'Recursos',
            'custo_valortotal' => 'Valor Total',
            'custo_data' => 'Data',
            'custo_aprovadorggp' => 'Custo Aprovadorggp',
            'custo_situacaoggp' => 'Situação GGP',
            'custo_dataaprovacaoggp' => 'Custo Dataaprovacaoggp',
            'custo_aprovadordad' => 'Custo Aprovadordad',
            'custo_situacaodad' => 'Situação DAD',
            'custo_dataaprovacaodad' => 'Custo Dataaprovacaodad',
            'custo_responsavel' => 'Responsável',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustoSituacaoggp()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'custo_situacaoggp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustoSituacaodad()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'custo_situacaodad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocustoItens()
    {
        return $this->hasMany(PedidocustoItens::className(), ['pedidocusto_id' => 'custo_id']);
    }
}
