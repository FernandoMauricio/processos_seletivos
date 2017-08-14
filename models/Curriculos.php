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
 * @property CurriculosComplementos[] $CurriculosComplementos
 * @property CurriculosEmpregos[] $CurriculosEmpregos
 * @property CurriculosDocumentacao[] $curriculosDocumentacaos
 * @property CurriculosEndereco[] $curriculosEnderecos
 * @property CurriculosFormacao[] $curriculosFormacaos
 */
class Curriculos extends \yii\db\ActiveRecord
{
    public $idadeModel;
    public $termoAceite;
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
            [['edital', 'numeroInscricao','cargo', 'nome', 'cpf', 'datanascimento', 'sexo', 'email', 'telefone', 'data', 'termoAceite'], 'required'],
            ['cpf', 'unique', 'targetAttribute' => ['edital', 'cpf', 'cargo'],'message' => '"{value} Já utilizado para o edital e cargo selecionado"'],
            ['cpf', CpfValidator::className()],
            [['idade', 'deficiencia'], 'integer'],
            [['datanascimento', 'data' , 'idadeModel', 'classificado'], 'safe'],
            [['edital', 'numeroInscricao', 'identidade', 'orgao_exped'], 'string', 'max' => 45],
            [['nome', 'cargo', 'email', 'emailAlt'], 'string', 'max' => 100],
            [['curriculo_lattes'], 'string', 'max' => 255],
            [['email', 'emailAlt'], 'email'],
            [['cpf', 'sexo', 'telefone', 'telefoneAlt'], 'string', 'max' => 20],
            [['deficiencia_cid'], 'string', 'max' => 10],
            [['classificado'], 'exist', 'skipOnError' => true, 'targetClass' => SituacaoCandidato::className(), 'targetAttribute' => ['classificado' => 'sitcan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'edital' => 'Documento de Abertura',
            'numeroInscricao' => 'Inscrição',
            'cargo' => 'Cargo',
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
            'data' => 'Data/Hora da Inscrição',
            'classificado' => 'Situação',
            'termoAceite' => 'Termo de aceite',
            'deficiencia' => 'Pessoa com Deficiência?',
            'deficiencia_cid' => 'Se sim, especificar CID',
            'curriculo_lattes' => 'Informe o link do seu Curríuclo Lattes',
        ];
    }


    public function getCargosProcesso() //Relation between Cargos & Processo table
    {
        return $this->hasMany(CargosProcesso::className(), ['processo_id' => 'id']);
    }


   /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacaoCandidato()
    {
        return $this->hasOne(SituacaoCandidato::className(), ['sitcan_id' => 'classificado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosComplementos()
    {
        return $this->hasMany(CurriculosComplementos::className(), ['curriculos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculosEmpregos()
    {
        return $this->hasMany(CurriculosEmpregos::className(), ['curriculos_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessoSeletivo()
    {
        return $this->hasOne(ProcessoSeletivo::className(), ['numeroEdital' => 'edital']);
    }


}
