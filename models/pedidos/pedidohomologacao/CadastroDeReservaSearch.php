<?php

namespace app\models\pedidos\pedidohomologacao;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\pedidohomologacao\PedidohomologacaoItens;
use yii\db\Expression;

/**
 * PediddohomologacaoItensSearch represents the model behind the search form about `app\models\pedidos\pedidohomologacao\PedidohomologacaoItens`.
 */
class CadastroDeReservaSearch extends PedidohomologacaoItens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedhomolog_id', 'pedidohomologacao_id', 'curriculos_id'], 'integer'],
            [['pedhomolog_docabertura', 'pedhomolog_numeroInscricao', 'pedhomolog_candidato', 'pedhomolog_classificacao', 'pedhomolog_localcontratacao', 'pedhomolog_cargo', 'pedhomolog_data'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        //Busca por candidatos que estejam com o pedido de homologação com validade de até 1 ano
        $query = PedidohomologacaoItens::find()
        ->where(['=','pedhomolog_localcontratacao', 'CADASTRO DE RESERVA'])
        ->where(['>', 'pedhomolog_data', new Expression('DATE_SUB(NOW(), INTERVAL 1 MONTH)')]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pedhomolog_id' => $this->pedhomolog_id,
            'pedidohomologacao_id' => $this->pedidohomologacao_id,
            'curriculos_id' => $this->curriculos_id,
            'pedhomolog_data' => $this->pedhomolog_data,
        ]);

        $query->andFilterWhere(['like', 'pedhomolog_docabertura', $this->pedhomolog_docabertura])
            ->andFilterWhere(['like', 'pedhomolog_numeroInscricao', $this->pedhomolog_numeroInscricao])
            ->andFilterWhere(['like', 'pedhomolog_candidato', $this->pedhomolog_candidato])
            ->andFilterWhere(['like', 'pedhomolog_classificacao', $this->pedhomolog_classificacao])
            ->andFilterWhere(['like', 'pedhomolog_localcontratacao', $this->pedhomolog_localcontratacao])
            ->andFilterWhere(['like', 'pedhomolog_cargo', $this->pedhomolog_cargo]);

        return $dataProvider;
    }
}