<?php

namespace app\models\curriculos;

use Yii;
use yii\base\Model;
use yiibr\brvalidator\CpfValidator;
use yiibr\brvalidator\CnpjValidator;
use yiibr\brvalidator\CeiValidator;

use app\models\etapasprocesso\EtapasItens;

/**
 * This is the model class for table "curriculos".
 *
 * @property integer $id
 * @property string $edital
 * @property string $numeroInscricao
 * @property string $cargo
 * @property string $nome
 * @property string $cpf
 * @property string $identidade
 * @property string $orgao_exped
 * @property string $datanascimento
 * @property integer $deficiencia
 * @property string $deficiencia_cid
 * @property integer $idade
 * @property string $sexo
 * @property string $email
 * @property string $emailAlt
 * @property string $telefone
 * @property string $telefoneAlt
 * @property string $data
 * @property integer $classificado
 * @property string $curriculo_lattes
 * @property integer $unidade_aprovador
 * @property string $aprovador_ggp
 * @property string $dataaprovador_ggp
 * @property string $aprovador_solicitante
 * @property string $dataaprovador_solicitante
 *
 * @property SituacaoCandidato $classificado0
 * @property CurriculosComplemento[] $curriculosComplementos
 * @property CurriculosEmpregos[] $curriculosEmpregos
 * @property CurriculosEndereco[] $curriculosEnderecos
 * @property CurriculosFormacao[] $curriculosFormacaos
 */
class CurriculosAdmin extends \yii\db\ActiveRecord
{
    public $idadeModel;
    public $termoAceite;
    public $sexoLabel;

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
            // [['edital', 'numeroInscricao','cargo', 'nome', 'cpf', 'datanascimento', 'sexo', 'email', 'telefone', 'data', 'termoAceite'], 'required'],
            // ['cpf', 'unique', 'targetAttribute' => ['edital', 'cpf', 'cargo'],'message' => '"{value} Já utilizado para o edital e cargo selecionado"'],
            // ['cpf', CpfValidator::className()],
            [['idade', 'deficiencia', 'unidade_aprovador', 'parentesco', 'situacao_ggp', 'situacao_aprovadorsolicitante'], 'integer'],
            [['datanascimento', 'data', 'idadeModel', 'classificado', 'sexoLabel', 'dataaprovador_ggp', 'dataaprovador_solicitante'], 'safe'],
            [['edital', 'numeroInscricao', 'identidade', 'orgao_exped', 'estado_civil'], 'string', 'max' => 45],
            [['nome', 'cargo', 'email', 'emailAlt', 'aprovador_ggp', 'aprovador_solicitante'], 'string', 'max' => 100],
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
            'edital' => 'Edital',
            'numeroInscricao' => 'Inscrição',
            'cargo' => 'Cargo',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'identidade' => 'RG',
            'orgao_exped' => 'Orgão Expedidor',
            'datanascimento' => 'Data de Nascimento',
            'idade' => 'Idade',
            'sexo' => 'Sexo',
            'sexoLabel' => 'Sexo',
            'email' => 'Email',
            'emailAlt' => 'Email Alternativo',
            'telefone' => 'Telefone',
            'telefoneAlt' => 'Telefone Alternativo',
            'data' => 'Data/Hora da Inscrição',
            'classificado' => 'Situação',
            'termoAceite' => 'Termo de aceite',
            'deficiencia' => 'Pessoa com Deficiência?',
            'deficiencia_cid' => 'Se sim, especificar CID',
            'unidade_aprovador' => 'Solicitante Aprovador',
            'aprovador_ggp' => 'Aprovador Ggp',
            'dataaprovador_ggp' => 'Dataaprovador Ggp',
            'aprovador_solicitante' => 'Aprovador Solicitante',
            'dataaprovador_solicitante' => 'Dataaprovador Solicitante',
            'parentesco' => 'declaro',
        ];
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtapasItens()
    {
        return $this->hasOne(EtapasItens::className(), ['curriculos_id' => 'id']);
    }
}
