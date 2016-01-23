<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curriculos".
 *
 * @property integer $id
 * @property integer $edital
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
 * @property integer $curriculos_endereco_id
 * @property integer $curriculos_documentacao_id
 * @property integer $curriculos_formacao_id
 *
 * @property CurriculosDocumentacao $curriculosDocumentacao
 * @property CurriculosEndereco $curriculosEndereco
 * @property CurriculosFormacao $curriculosFormacao
 * @property CurriculosCurriculosComplementos[] $curriculosCurriculosComplementos
 * @property CurriculosCurriculosEmpregos[] $curriculosCurriculosEmpregos
 */
class Curriculos extends \yii\db\ActiveRecord
{
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
            [['edital', 'cargo', 'nome', 'cpf', 'sexo', 'email', 'emailAlt', 'telefone', 'telefoneAlt', 'data', 'curriculos_endereco_id', 'curriculos_documentacao_id', 'curriculos_formacao_id'], 'required'],
            [['edital', 'cargo', 'curriculos_endereco_id', 'curriculos_documentacao_id', 'curriculos_formacao_id'], 'integer'],
            [['datanascimento', 'data'], 'safe'],
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
            'curriculos_endereco_id' => 'Curriculos Endereco ID',
            'curriculos_documentacao_id' => 'Curriculos Documentacao ID',
            'curriculos_formacao_id' => 'Curriculos Formacao ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosDocumentacao()
    {
        return $this->hasOne(CurriculosDocumentacao::className(), ['id' => 'curriculos_documentacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosEndereco()
    {
        return $this->hasOne(CurriculosEndereco::className(), ['id' => 'curriculos_endereco_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosFormacao()
    {
        return $this->hasOne(CurriculosFormacao::className(), ['id' => 'curriculos_formacao_id']);
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
}
