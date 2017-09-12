<?php

namespace app\models\pedidos\pedidocusto;

use Yii;
use app\models\contratacao\Contratacao;

/**
 * This is the model class for table "pedidocusto_itens".
 *
 * @property integer $id
 * @property integer $pedidocusto_id
 * @property integer $contratacao_id
 * @property string $itemcusto_unidade
 * @property integer $itemcusto_cargo
 * @property integer $itemcusto_quantidade
 * @property string $itemcusto_tipocontrato
 * @property string $itemcusto_area
 * @property double $itemcusto_chsemanal
 * @property double $itemcusto_salario
 * @property double $itemcusto_encargos
 * @property double $itemcusto_total
 * @property string $itemcusto_justificativa
 * @property string $itemcusto_dataingresso
 *
 * @property Contratacao $contratacao
 * @property PedidoCusto $pedidocusto
 */
class PedidocustoItens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidocusto_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemcusto_unidade', 'itemcusto_cargo', 'itemcusto_quantidade', 'itemcusto_tipocontrato', 'itemcusto_area', 'itemcusto_chsemanal', 'itemcusto_salario', 'itemcusto_encargos', 'itemcusto_total', 'itemcusto_justificativa'], 'required'],
            [['pedidocusto_id', 'contratacao_id', 'itemcusto_quantidade'], 'integer'],
            [['itemcusto_chsemanal', 'itemcusto_salario', 'itemcusto_encargos', 'itemcusto_total'], 'number'],
            [['itemcusto_unidade', 'itemcusto_cargo', 'itemcusto_tipocontrato', 'itemcusto_area'], 'string', 'max' => 45],
            [['itemcusto_dataingresso'], 'string', 'max' => 15],
            [['itemcusto_justificativa'], 'string', 'max' => 255],
            [['contratacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contratacao::className(), 'targetAttribute' => ['contratacao_id' => 'id']],
            [['pedidocusto_id'], 'exist', 'skipOnError' => true, 'targetClass' => PedidoCusto::className(), 'targetAttribute' => ['pedidocusto_id' => 'custo_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Itemcusto ID',
            'pedidocusto_id' => 'Pedidocusto ID',
            'contratacao_id' => 'Solicitação',
            'itemcusto_unidade' => 'Unidade',
            'itemcusto_cargo' => 'Cargo',
            'itemcusto_quantidade' => 'Quantidade',
            'itemcusto_tipocontrato' => 'Tipo Contrato',
            'itemcusto_area' => 'Área',
            'itemcusto_chsemanal' => 'CH. Semanal',
            'itemcusto_salario' => 'Salario',
            'itemcusto_encargos' => 'Encargos',
            'itemcusto_total' => 'Custo Total',
            'itemcusto_justificativa' => 'Justificativa',
            'itemcusto_dataingresso' => 'Data prevista Início',
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
    public function getPedidocusto()
    {
        return $this->hasOne(PedidoCusto::className(), ['custo_id' => 'pedidocusto_id']);
    }
}
