<?php

namespace app\models\pedidos\pedidohomologacao;

use Yii;

use app\models\curriculos\Curriculos;

/**
 * This is the model class for table "pedidohomologacao_itens".
 *
 * @property integer $pedhomolog_id
 * @property string $pedhomolog_classificacao
 * @property string $pedhomolog_candidato
 * @property integer $pedidohomologacao_id
 *
 * @property PedidoHomologacao $pedidohomologacao
 */
class PedidohomologacaoItens extends \yii\db\ActiveRecord
{
    public $unidade;
    public $email;
    public $telefone;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidohomologacao_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedidohomologacao_id'], 'required'],
            [['pedidohomologacao_id', 'curriculos_id', 'etapa_id'], 'integer'],
            [['pedhomolog_data', 'pedhomolog_expiracao'], 'safe'],
            [['pedhomolog_candidato', 'pedhomolog_classificacao', 'pedhomolog_localcontratacao', 'unidade'], 'string', 'max' => 255],
            [['pedhomolog_cargo', 'pedhomolog_docabertura', 'pedhomolog_numeroInscricao', 'pedhomolog_nivel'], 'string', 'max' => 45],
            [['pedidohomologacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => PedidoHomologacao::className(), 'targetAttribute' => ['pedidohomologacao_id' => 'homolog_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pedhomolog_id' => 'Cód.',
            'unidade' => 'Unidade',
            'pedidohomologacao_id' => 'Cód. Homologação',
            'curriculos_id' => 'Cód. Candidato',
            'pedhomolog_docabertura' => 'Doc. Abertura',
            'pedhomolog_numeroInscricao' => 'Inscrição',
            'pedhomolog_candidato' => 'Candidato',
            'pedhomolog_classificacao' => 'Classificação',
            'pedhomolog_cargo' => 'Cargo',
            'pedhomolog_nivel' => 'Nível',
            'pedhomolog_localcontratacao' => 'Destino',
            'pedhomolog_data' => 'Data da Homologação',
            'pedhomolog_expiracao' => 'Data da Expiração',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidohomologacao()
    {
        return $this->hasOne(PedidoHomologacao::className(), ['homolog_id' => 'pedidohomologacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculos()
    {
        return $this->hasOne(Curriculos::className(), ['id' => 'curriculos_id']);
    }

}
