<?php

namespace app\models\pedidos\pedidocontratacao;

use Yii;

use app\models\pedidos\pedidocusto\PedidocustoSituacao;


/**
 * This is the model class for table "pedido_contratacao".
 *
 * @property integer $pedcontratacao_id
 * @property string $pedcontratacao_assunto
 * @property string $pedcontratacao_recursos
 * @property double $pedcontratacao_valortotal
 * @property string $pedcontratacao_data
 * @property string $pedcontratacao_aprovadorggp
 * @property integer $pedcontratacao_situacaoggp
 * @property string $pedcontratacao_dataaprovacaoggp
 * @property string $pedcontratacao_aprovadordad
 * @property integer $pedcontratacao_situacaodad
 * @property string $pedcontratacao_dataaprovacaodad
 * @property string $pedcontratacao_responsavel
 *
 * @property PedidocustoSituacao $pedcontratacaoSituacaoggp
 * @property PedidocustoSituacao $pedcontratacaoSituacaodad
 * @property PedidocontratacaoItens[] $pedidocontratacaoItens
 */
class PedidoContratacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_contratacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedcontratacao_assunto', 'pedcontratacao_recursos', 'pedcontratacao_valortotal', 'pedcontratacao_situacaoggp', 'pedcontratacao_situacaodad'], 'required'],
            [['pedcontratacao_valortotal'], 'number'],
            [['pedcontratacao_data', 'pedcontratacao_dataaprovacaoggp', 'pedcontratacao_dataaprovacaodad'], 'safe'],
            [['pedcontratacao_situacaoggp', 'pedcontratacao_situacaodad'], 'integer'],
            [['pedcontratacao_assunto'], 'string', 'max' => 255],
            [['pedcontratacao_recursos'], 'string', 'max' => 100],
            [['pedcontratacao_aprovadorggp', 'pedcontratacao_aprovadordad', 'pedcontratacao_responsavel'], 'string', 'max' => 45],
            [['pedcontratacao_situacaoggp'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['pedcontratacao_situacaoggp' => 'situacao_id']],
            [['pedcontratacao_situacaodad'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['pedcontratacao_situacaodad' => 'situacao_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pedcontratacao_id' => 'Pedcontratacao ID',
            'pedcontratacao_assunto' => 'Pedcontratacao Assunto',
            'pedcontratacao_recursos' => 'Pedcontratacao Recursos',
            'pedcontratacao_valortotal' => 'Pedcontratacao Valortotal',
            'pedcontratacao_data' => 'Pedcontratacao Data',
            'pedcontratacao_aprovadorggp' => 'Pedcontratacao Aprovadorggp',
            'pedcontratacao_situacaoggp' => 'Pedcontratacao Situacaoggp',
            'pedcontratacao_dataaprovacaoggp' => 'Pedcontratacao Dataaprovacaoggp',
            'pedcontratacao_aprovadordad' => 'Pedcontratacao Aprovadordad',
            'pedcontratacao_situacaodad' => 'Pedcontratacao Situacaodad',
            'pedcontratacao_dataaprovacaodad' => 'Pedcontratacao Dataaprovacaodad',
            'pedcontratacao_responsavel' => 'Pedcontratacao Responsavel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedcontratacaoSituacaoggp()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'pedcontratacao_situacaoggp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedcontratacaoSituacaodad()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'pedcontratacao_situacaodad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocontratacaoItens()
    {
        return $this->hasMany(PedidocontratacaoItens::className(), ['pedidocontratacao_id' => 'pedcontratacao_id']);
    }
}
