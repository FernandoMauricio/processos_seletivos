<?php

namespace app\models\processoseletivo;

use Yii;

use app\models\contratacao\AreasCargos;

/**
 * This is the model class for table "cargos".
 *
 * @property integer $idcargo
 * @property string $descricao
 * @property string $area
 * @property integer $ch_semana
 * @property double $salario_valorhora
 * @property double $salario
 * @property double $salario_1sexto
 * @property double $salario_produtividade
 * @property double $salario_6horasfixas
 * @property double $salario_1sextofixas
 * @property double $salario_bruto
 * @property double $encargos
 * @property double $valor_total
 * @property integer $status
 *
 * @property CargosProcesso[] $cargosProcessos
 * @property Contratacao[] $contratacaos
 */
class Cargos extends \yii\db\ActiveRecord
{
    public $calculos;
    public $areasLabel;

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
            [['descricao', 'ch_semana', 'salario', 'status', 'calculos'], 'required'],
            [['ch_semana'], 'compare', 'compareValue' => 0, 'operator' => '>', 'message'=>'Valores maiores que 0 e sem vírgulas.'],
            [['ch_semana', 'status'], 'integer'],
            [['areasLabel'], 'safe'],
            [['salario_valorhora', 'salario', 'salario_1sexto', 'salario_produtividade', 'salario_6horasfixas', 'salario_1sextofixas', 'salario_bruto', 'encargos', 'valor_total'], 'number'],
            [['descricao'], 'string', 'max' => 100],
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
            'ch_semana' => 'CH Semanal',
            'salario_valorhora' => 'V.H',
            'salario' => 'S. Base',
            'salario_1sexto' => '1/6 RSR',
            'salario_produtividade' => 'PRODUT.',
            'salario_6horasfixas' => '06h Fixas',
            'salario_1sextofixas' => '1/6 Fixas',
            'salario_bruto' => 'S. Bruto',
            'encargos' => 'Encargos',
            'valor_total' => 'Valor Total',
            'status' => 'Status',
            'calculos' => 'Realizar cálculos para Docentes?',
            'areasLabel' => 'Níveis', 
        ];
    }

    public function getAreasCargos() //Relation between Cargos & Processo table
    {
        return $this->hasMany(AreasCargos::className(), ['cargo_id' => 'idcargo']);
    }


    public function afterSave($insert, $changedAttributes){
        //Níveis do Cargo
        
        \Yii::$app->db->createCommand()->delete('areas_cargos', 'cargo_id = '.(int) $this->idcargo)->execute(); //Delete existing value
        if($_POST['Cargos']['areasLabel'] != '') {
            foreach ($this->areasLabel as $id) { //Write new values
                $tc = new AreasCargos();
                $tc->cargo_id = $this->idcargo;
                $tc->area_id = $id;
                $tc->save();
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargosProcessos()
    {
        return $this->hasMany(CargosProcesso::className(), ['cargo_id' => 'idcargo']);
    }
}