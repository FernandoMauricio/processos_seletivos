<?php

namespace app\models\pedidos;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\PedidoCusto;

/**
 * PedidoCustoSearch represents the model behind the search form about `app\models\pedidos\PedidoCusto`.
 */
class PedidoCustoSearch extends PedidoCusto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custo_id', 'custo_situacaoggp', 'custo_situacaodad'], 'integer'],
            [['custo_assunto', 'custo_recursos', 'custo_data', 'custo_aprovadorggp', 'custo_dataaprovacaoggp', 'custo_aprovadordad', 'custo_dataaprovacaodad', 'custo_responsavel'], 'safe'],
            [['custo_valortotal'], 'number'],
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
        $query = PedidoCusto::find();

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
            'custo_id' => $this->custo_id,
            'custo_valortotal' => $this->custo_valortotal,
            'custo_data' => $this->custo_data,
            'custo_situacaoggp' => $this->custo_situacaoggp,
            'custo_dataaprovacaoggp' => $this->custo_dataaprovacaoggp,
            'custo_situacaodad' => $this->custo_situacaodad,
            'custo_dataaprovacaodad' => $this->custo_dataaprovacaodad,
        ]);

        $query->andFilterWhere(['like', 'custo_assunto', $this->custo_assunto])
            ->andFilterWhere(['like', 'custo_recursos', $this->custo_recursos])
            ->andFilterWhere(['like', 'custo_aprovadorggp', $this->custo_aprovadorggp])
            ->andFilterWhere(['like', 'custo_aprovadordad', $this->custo_aprovadordad])
            ->andFilterWhere(['like', 'custo_responsavel', $this->custo_responsavel]);

        return $dataProvider;
    }
}
