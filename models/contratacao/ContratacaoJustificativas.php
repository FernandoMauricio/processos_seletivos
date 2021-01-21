<?php

namespace app\models\contratacao;

use Yii;

/**
 * This is the model class for table "contratacao_justificativas".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $usuario
 * @property integer $id_contratacao
 *
 * @property Contratacao $idContratacao
 */
class ContratacaoJustificativas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contratacao_justificativas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'usuario', 'id_contratacao'], 'required'],
            [['id_contratacao'], 'integer'],
            [['descricao'], 'string'],
            [['usuario'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Justificativa',
            'usuario' => 'Colaborador',
            'id_contratacao' => 'Solicitação de Contratação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContratacao()
    {
        return $this->hasOne(Contratacao::className(), ['id' => 'id_contratacao']);
    }
}
