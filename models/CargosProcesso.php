<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargos_processo".
 *
 * @property integer $id
 * @property integer $cargo_id
 * @property integer $processo_id
 *
 * @property Cargos $cargo
 * @property Processo $processo
 */
class CargosProcesso extends \yii\db\ActiveRecord
{

    public $permissions;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargos_processo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cargo_id', 'processo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cargo_id' => 'Cargo ID',
            'processo_id' => 'Processo ID',
        ];
    }

    //Localiza os cargos vinculado ao Processo Seletivo
    public static function getCargosProcessoSubCat($cat_id) {

        $sql = 'SELECT
                    `cargos_processo`.`cargo_id` AS id,
                    `cargos`.`descricao` AS name
               FROM 
                   `cargos`
               INNER JOIN 
                   `cargos_processo` ON  `cargos_processo`.`cargo_id` = `cargos`.`idcargo`
               WHERE
                    `cargos_processo`.`processo_id` = '.$cat_id.'';

        $data = \app\models\CargosProcesso::findBySql($sql)->asArray()->all();

        return $data;

   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargos::className(), ['idcargo' => 'cargo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesso()
    {
        return $this->hasOne(Processo::className(), ['id' => 'processo_id']);
    }
}
