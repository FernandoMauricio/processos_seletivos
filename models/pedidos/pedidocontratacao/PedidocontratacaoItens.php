<?php

namespace app\models\pedidos\pedidocontratacao;

use Yii;

use app\models\contratacao\Contratacao;
use app\models\etapasprocesso\EtapasProcesso;
/**
 * This is the model class for table "pedidocontratacao_itens".
 *
 * @property integer $id
 * @property integer $pedidocontratacao_id
 * @property integer $contratacao_id
 * @property integer $pedidocusto_itens_id
 * @property string $itemcontratacao_unidade
 * @property string $itemcontratacao_nome
 * @property string $itemcontratacao_carta
 * @property string $itemcontratacao_tipocontrato
 * @property double $itemcontratacao_chsemanal
 * @property double $itemcontratacao_total
 * @property string $itemcontratacao_justificativa
 * @property string $itemcontratacao_dataingresso
 *
 * @property Contratacao $contratacao
 * @property PedidoContratacao $pedidocontratacao
 * @property PedidocustoItens $pedidocustoItens
 */
class PedidocontratacaoItens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidocontratacao_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedidocontratacao_id', 'contratacao_id', 'itemcontratacao_unidade', 'itemcontratacao_cargo', 'itemcontratacao_area', 'itemcontratacao_nome', 'itemcontratacao_tipocontrato', 'itemcontratacao_chsemanal', 'itemcontratacao_total', 'itemcontratacao_justificativa'], 'required'],
            [['pedidocontratacao_id', 'contratacao_id', 'etapasprocesso_id'], 'integer'],
            [['itemcontratacao_chsemanal', 'itemcontratacao_total'], 'number'],
            [['itemcontratacao_unidade', 'itemcontratacao_cargo', 'itemcontratacao_carta', 'itemcontratacao_area', 'itemcontratacao_tipocontrato', 'itemcontratacao_dataingresso'], 'string', 'max' => 45],
            [['itemcontratacao_nome', 'itemcontratacao_justificativa'], 'string', 'max' => 255],
            [['contratacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contratacao::className(), 'targetAttribute' => ['contratacao_id' => 'id']],
            [['pedidocontratacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => PedidoContratacao::className(), 'targetAttribute' => ['pedidocontratacao_id' => 'pedcontratacao_id']],
            [['etapasprocesso_id'], 'exist', 'skipOnError' => true, 'targetClass' => EtapasProcesso::className(), 'targetAttribute' => ['etapasprocesso_id' => 'etapa_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cód.',
            'pedidocontratacao_id' => 'Cód. Pedido Contratação',
            'contratacao_id' => 'Solicitação',
            'etapasprocesso_id' => 'Nº P.S.',
            'itemcontratacao_unidade' => 'Unidade',
            'itemcontratacao_cargo' => 'Cargo',
            'itemcontratacao_area' => 'Nível',
            'itemcontratacao_nome' => 'Nome',
            'itemcontratacao_carta' => 'Carta',
            'itemcontratacao_tipocontrato' => 'Tipo Contrato',
            'itemcontratacao_chsemanal' =>'CH Semanal',
            'itemcontratacao_total' => 'Remuneração com Encargos',
            'itemcontratacao_justificativa' => 'Justificativa',
            'itemcontratacao_dataingresso' => 'Data Prevista Início',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacao()
    {
        return $this->hasOne(Contratacao::className(), ['id' => 'contratacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocontratacao()
    {
        return $this->hasOne(PedidoContratacao::className(), ['pedcontratacao_id' => 'pedidocontratacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocustoItens()
    {
        return $this->hasOne(PedidocustoItens::className(), ['id' => 'pedidocusto_itens_id']);
    }
}
