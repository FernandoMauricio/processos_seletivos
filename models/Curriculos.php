<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curriculos".
 *
 * @property integer $id
 * @property string $edital
 * @property integer $cargo
 * @property string $nome
 * @property string $cpf
 * @property string $datanascimento
 * @property string $sexo
 * @property string $email
 * @property string $emailAlt
 * @property string $telefone
 * @property string $telefoneAlt
 * @property string $data
 *
 * @property CurriculosCurriculosComplementos[] $curriculosCurriculosComplementos
 * @property CurriculosCurriculosEmpregos[] $curriculosCurriculosEmpregos
 * @property CurriculosDocumentacao[] $curriculosDocumentacaos
 * @property CurriculosEndereco[] $curriculosEnderecos
 * @property CurriculosFormacao[] $curriculosFormacaos
 */
class Curriculos extends \yii\db\ActiveRecord
{
    public $permissions;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edital', 'cargo', 'nome', 'cpf', 'datanascimento', 'sexo', 'email', 'telefone', 'data'], 'required'],
            [['cargo'], 'integer'],
            [['datanascimento', 'data'], 'safe'],
            [['edital'], 'string', 'max' => 45],
            [['nome', 'email', 'emailAlt'], 'string', 'max' => 100],
            [['cpf', 'sexo', 'telefone', 'telefoneAlt'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'edital' => 'Edital',
            'cargo' => 'Cargo',
            'nome' => 'Nome',
            'cpf' => 'Cpf',
            'datanascimento' => 'Datanascimento',
            'sexo' => 'Sexo',
            'email' => 'Email',
            'emailAlt' => 'Email Alt',
            'telefone' => 'Telefone',
            'telefoneAlt' => 'Telefone Alt',
            'data' => 'Data',
        ];
    }


    public function getCargosProcesso() //Relation between Cargos & Processo table
    {
        return $this->hasMany(CargosProcesso::className(), ['processo_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosCurriculosComplementos()
    {
        return $this->hasMany(CurriculosCurriculosComplementos::className(), ['curriculos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosCurriculosEmpregos()
    {
        return $this->hasMany(CurriculosCurriculosEmpregos::className(), ['curriculos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosDocumentacaos()
    {
        return $this->hasMany(CurriculosDocumentacao::className(), ['curriculos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosEnderecos()
    {
        return $this->hasMany(CurriculosEndereco::className(), ['curriculos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosFormacaos()
    {
        return $this->hasMany(CurriculosFormacao::className(), ['curriculos_id' => 'id']);
    }
}
