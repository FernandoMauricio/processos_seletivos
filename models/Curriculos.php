<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yiibr\brvalidator\CpfValidator;
use yiibr\brvalidator\CnpjValidator;
use yiibr\brvalidator\CeiValidator;

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
    public $idadeModel;
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
            [['edital', 'numeroInscricao','cargo', 'cidade_selecionada', 'nome', 'cpf', 'datanascimento', 'sexo', 'email', 'telefone', 'data'], 'required'],
            ['cpf', 'unique', 'targetAttribute' => ['edital', 'cpf', 'cargo', 'cidade_selecionada'],'message' => '"{value} Já utilizado para o edital, cidade e cargo selecionado"'],
            ['cpf', CpfValidator::className()],
            [['idade'], 'integer'],
            [['datanascimento', 'data' , 'idadeModel', 'classificado'], 'safe'],
            [['edital', 'numeroInscricao', 'identidade', 'orgao_exped'], 'string', 'max' => 45],
            [['nome', 'cargo', 'cidade_selecionada', 'email', 'emailAlt'], 'string', 'max' => 100],
            [['email', 'emailAlt'], 'email'],
            [['cpf', 'sexo', 'telefone', 'telefoneAlt'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'edital' => 'Edital',
            'numeroInscricao' => 'Número de Inscrição',
            'cargo' => 'Cargo',
            'cidade_selecionada' => 'Cidade',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'identidade' => 'RG',
            'orgao_exped' => 'Orgão Expedidor',
            'datanascimento' => 'Data de Nascimento',
            'idade' => 'Idade',
            'sexo' => 'Sexo',
            'email' => 'Email',
            'emailAlt' => 'Email Alternativo',
            'telefone' => 'Telefone',
            'telefoneAlt' => 'Telefone Alternativo',
            'data' => 'Data da Inscrição',
            'classificado' => 'Situação',
        ];
    }

    public function getCargosProcesso() //Relation between Cargos & Processo table
    {
        return $this->hasMany(CargosProcesso::className(), ['processo_id' => 'id']);
    }


    public function getCidadesProcesso() //Relation between Cargos & Processo table
    {
        return $this->hasMany(CidadesProcesso::className(), ['processo_id' => 'id']);
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
