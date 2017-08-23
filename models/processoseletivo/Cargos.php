<?php

namespace app\models\processoseletivo;

use Yii;

/**
 * This is the model class for table "cargos".
 *
 * @property integer $idcargo
 * @property string $descricao
 * @property string $area
 * @property integer $ch_semana
 * @property double $salario
 * @property double $encargos
 * @property double $valor_total
 * @property integer $status
 *
 * @property CargosProcesso[] $cargosProcessos
 */
class Cargos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'area', 'ch_semana', 'salario', 'status'], 'required'],
            [['ch_semana', 'status'], 'integer'],
            [['salario', 'encargos', 'valor_total'], 'number'],
            [['descricao', 'area'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcargo' => 'Cod.',
            'descricao' => 'Descrição',
            'area' => 'Área',
            'ch_semana' => 'CH Semanal',
            'salario' => 'Salário',
            'encargos' => 'Encargos',
            'valor_total' => 'Total',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargosProcessos()
    {
        return $this->hasMany(CargosProcesso::className(), ['cargo_id' => 'idcargo']);
    }
}