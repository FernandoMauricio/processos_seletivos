<?php

namespace app\models\pedidos\pedidocusto;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\pedidocusto\PedidoCusto;

/**
 * PedidoCustoSearch represents the model behind the search form about `app\models\pedidos\PedidoCusto`.
 */
class PedidoCustoAprovacaoDrgSearch extends PedidoCusto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custo_id'], 'integer'],
            [['custo_assunto', 'custo_recursos', 'custo_data', 'custo_aprovadorggp', 'custo_situacaoggp', 'custo_situacaodad', 'custo_situacaodrg', 'custo_dataaprovacaoggp', 'custo_aprovadordad', 'custo_dataaprovacaodad', 'custo_aprovadordrg', 'custo_dataaprovacaodrg','custo_responsavel', 'custo_valortotal'], 'safe'],
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

        $query->joinWith('custoSituacaoggp');
        $query->joinWith('custoSituacaodad as b');
        $query->joinWith('custoSituacaodrg as c');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'custo_id' => $this->custo_id,
            'custo_data' => $this->custo_data,
            'custo_dataaprovacaoggp' => $this->custo_dataaprovacaoggp,
            'custo_dataaprovacaodad' => $this->custo_dataaprovacaodad,
            'custo_situacaoggp' => 4, //Aprovado Pelo GGP
            'custo_situacaodad' => 4, //Aprovado Pela DAD
            'custo_situacaodrg' => 1, // Aguardando Aprovação
        ]);

        $query->andFilterWhere(['like', 'custo_assunto', $this->custo_assunto])
            ->andFilterWhere(['like', 'custo_recursos', $this->custo_recursos])
            ->andFilterWhere(['like', 'custo_valortotal', $this->custo_valortotal])
            ->andFilterWhere(['like', 'pedidocusto_situacao.situacao_descricao', $this->custo_situacaoggp])
            ->andFilterWhere(['like', 'b.situacao_descricao', $this->custo_situacaodad])
            ->andFilterWhere(['like', 'c.situacao_descricao', $this->custo_situacaodrg])
            ->andFilterWhere(['like', 'custo_aprovadorggp', $this->custo_aprovadorggp])
            ->andFilterWhere(['like', 'custo_aprovadordad', $this->custo_aprovadordad])
            ->andFilterWhere(['like', 'custo_responsavel', $this->custo_responsavel]);

        return $dataProvider;
    }
}
