<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_curriculo".
 *
 * @property integer $cv_id
 * @property string $cv_numeroEdital
 * @property string $cv_cargo
 * @property string $cv_nome
 * @property string $cv_datanascimento
 * @property string $cv_email
 * @property string $cv_telefone
 * @property string $cv_resumocv
 * @property string $cv_data
 * @property string $cv_email2
 * @property string $cv_telefone2
 */
class Curriculos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_curriculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cv_numeroEdital', 'cv_cargo', 'cv_nome', 'cv_email', 'cv_telefone', 'cv_resumocv', 'cv_data', 'cv_email2', 'cv_telefone2'], 'required'],
            [['cv_numeroEdital', 'cv_cargo', 'cv_nome', 'cv_email', 'cv_resumocv', 'cv_email2'], 'string'],
            [['cv_datanascimento', 'cv_data'], 'safe'],
            [['cv_telefone', 'cv_telefone2'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cv_id' => 'id',
            'cv_numeroEdital' => 'Número Edital',
            'cv_cargo' => 'Cargo',
            'cv_nome' => 'Nome',
            'cv_datanascimento' => 'Data Nascimento',
            'cv_email' => 'Email',
            'cv_telefone' => 'Telefone',
            'cv_resumocv' => 'Resumo Currículo',
            'cv_data' => 'Data de cadastro',
            'cv_email2' => 'Email Aternativo',
            'cv_telefone2' => 'Telefone Alternativo',
        ];
    }
}
