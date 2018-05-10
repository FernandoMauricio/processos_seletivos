<?php

namespace app\models\pedidos;

use Yii;

/**
 * This is the model class for table "aprovacoes".
 *
 * @property integer $aprov_id
 * @property string $aprov_descricao
 * @property string $aprov_cargo
 * @property string $aprov_observacao
 * @property string $aprov_area
 * @property integer $aprov_status
 */
class Aprovacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aprovacoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aprov_descricao', 'aprov_cargo', 'aprov_area', 'aprov_status'], 'required'],
            [['aprov_status'], 'integer'],
            [['aprov_observacao'], 'default', 'value' => null],
            [['aprov_descricao', 'aprov_cargo', 'aprov_observacao', 'aprov_area'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aprov_id' => 'Cód.',
            'aprov_descricao' => 'Nome do Aprovador',
            'aprov_cargo' => 'Cargo',
            'aprov_observacao' => 'Ordem de Serviço',
            'aprov_area' => 'Área da Aprovação',
            'aprov_status' => 'Situação',
        ];
    }
}
