<?php

namespace app\models\pedidos\pedidocontratacao;

use Yii;

use app\models\pedidos\pedidocusto\PedidocustoSituacao;


/**
 * This is the model class for table "pedido_contratacao".
 *
 * @property integer $pedcontratacao_id
 * @property string $pedcontratacao_assunto
 * @property string $pedcontratacao_recursos
 * @property double $pedcontratacao_valortotal
 * @property string $pedcontratacao_data
 * @property string $pedcontratacao_aprovadorggp
 * @property integer $pedcontratacao_situacaoggp
 * @property string $pedcontratacao_dataaprovacaoggp
 * @property string $pedcontratacao_aprovadordad
 * @property integer $pedcontratacao_situacaodad
 * @property string $pedcontratacao_dataaprovacaodad
 * @property string $pedcontratacao_responsavel
 *
 * @property PedidocustoSituacao $pedcontratacaoSituacaoggp
 * @property PedidocustoSituacao $pedcontratacaoSituacaodad
 * @property PedidocontratacaoItens[] $pedidocontratacaoItens
 */
class PedidoContratacao extends \yii\db\ActiveRecord
{
    public $pedidocusto_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_contratacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedcontratacao_assunto', 'pedcontratacao_recursos', 'pedcontratacao_valortotal', 'pedcontratacao_situacaoggp', 'pedcontratacao_situacaodad'], 'required'],
            [['pedcontratacao_valortotal'], 'number'],
            [['pedcontratacao_data', 'pedcontratacao_dataaprovacaoggp', 'pedcontratacao_dataaprovacaodad', 'pedcontratacao_datahomologacao'], 'safe'],
            [['pedcontratacao_situacaoggp', 'pedcontratacao_situacaodad', 'pedidocusto_id'], 'integer'],
            [['pedcontratacao_assunto'], 'string', 'max' => 255],
            [['pedcontratacao_recursos'], 'string', 'max' => 100],
            [['pedcontratacao_aprovadorggp', 'pedcontratacao_aprovadordad', 'pedcontratacao_responsavel','pedcontratacao_homologador'], 'string', 'max' => 45],
            [['pedcontratacao_situacaoggp'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['pedcontratacao_situacaoggp' => 'situacao_id']],
            [['pedcontratacao_situacaodad'], 'exist', 'skipOnError' => true, 'targetClass' => PedidocustoSituacao::className(), 'targetAttribute' => ['pedcontratacao_situacaodad' => 'situacao_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pedcontratacao_id' => 'Cód.',
            'pedcontratacao_assunto' => 'Unidade',
            'pedcontratacao_recursos' => 'Recursos',
            'pedcontratacao_valortotal' => 'Valor Total',
            'pedcontratacao_data' => 'Data',
            'pedcontratacao_aprovadorggp' => 'Aprovadorggp',
            'pedcontratacao_situacaoggp' => 'Situação GGP',
            'pedcontratacao_dataaprovacaoggp' => 'Dataaprovacaoggp',
            'pedcontratacao_aprovadordad' => 'Aprovadordad',
            'pedcontratacao_situacaodad' => 'Situação DAD',
            'pedcontratacao_dataaprovacaodad' => 'Dataaprovacaodad',
            'pedcontratacao_responsavel' => 'Responsavel',
            'pedidocusto_id' => 'Pedido de Custo',
            'pedcontratacao_homologador' => 'Homologado por',
            'pedcontratacao_datahomologacao' => 'Data Homologação',
        ];
    }

    //Localiza os cargos vinculado ao Documento de Abertura
    public static function getCandidatosAprovadosSubCat($cat_id) {

        $sql = 'SELECT DISTINCT
                   `curriculos`.`nome` AS id,
                   concat(UPPER(`curriculos`.`nome`), " - ", `etapas_itens`.`itens_classificacao`) AS name
                FROM `curriculos`
                INNER JOIN `etapas_itens` ON  `etapas_itens`.`curriculos_id` = `curriculos`.`id`
                INNER JOIN `etapas_processo` ON `etapas_processo`.`etapa_id` = `etapas_itens`.`etapasprocesso_id`
                INNER JOIN `pedidocusto_itens` ON `pedidocusto_itens`.`pedidocusto_id` = `etapas_processo`.`pedidocusto_id`
                WHERE `etapas_itens`.`itens_classificacao` NOT LIKE "%Desclassificado(a)%"
                AND `etapas_itens`.`itens_classificacao` NOT LIKE ""
                AND `etapas_processo`.`etapa_id` = '.$cat_id.'
                ORDER BY `etapas_itens`.`itens_pontuacaototal` DESC' ;

        $data = \app\models\curriculos\Curriculos::findBySql($sql)->asArray()->all();

        return $data;
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedcontratacaoSituacaoggp()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'pedcontratacao_situacaoggp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedcontratacaoSituacaodad()
    {
        return $this->hasOne(PedidocustoSituacao::className(), ['situacao_id' => 'pedcontratacao_situacaodad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidocontratacaoItens()
    {
        return $this->hasMany(PedidocontratacaoItens::className(), ['pedidocontratacao_id' => 'pedcontratacao_id']);
    }

    public function getPedidoCusto()
    {
        return $this->hasOne(PedidocontratacaoItens::className(), ['pedidocontratacao_id' => 'pedcontratacao_id']);
    }

}
