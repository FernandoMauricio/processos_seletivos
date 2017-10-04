<?php

namespace app\models\pedidos\pedidocontratacao;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\pedidocontratacao\PedidoContratacao;

/**
 * PedidoContratacaoSearch represents the model behind the search form about `app\models\pedidos\pedidocontratacao\PedidoContratacao`.
 */
class PedidoContratacaoSearch extends PedidoContratacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedcontratacao_id', 'pedcontratacao_situacaoggp', 'pedcontratacao_situacaodad'], 'integer'],
            [['pedcontratacao_assunto', 'pedcontratacao_recursos', 'pedcontratacao_data', 'pedcontratacao_aprovadorggp', 'pedcontratacao_dataaprovacaoggp', 'pedcontratacao_aprovadordad', 'pedcontratacao_dataaprovacaodad', 'pedcontratacao_responsavel', 'pedidocusto_id', 'pedcontratacao_homologador', 'pedcontratacao_datahomologacao'], 'safe'],
            [['pedcontratacao_valortotal'], 'number'],
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
        $query = PedidoContratacao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['pedidoCusto.etapasProcesso.pedidocusto']);

        $dataProvider->sort->attributes['pedidocusto_id'] = [
        'asc' => ['pedido_custo.etapas_processo.pedidocusto_id' => SORT_ASC],
        'desc' => ['apedido_custo.etapas_processo.pedidocusto_id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pedcontratacao_id' => $this->pedcontratacao_id,
            'pedcontratacao_valortotal' => $this->pedcontratacao_valortotal,
            'pedcontratacao_data' => $this->pedcontratacao_data,
            'pedcontratacao_situacaoggp' => $this->pedcontratacao_situacaoggp,
            'pedcontratacao_dataaprovacaoggp' => $this->pedcontratacao_dataaprovacaoggp,
            'pedcontratacao_situacaodad' => $this->pedcontratacao_situacaodad,
            'pedcontratacao_dataaprovacaodad' => $this->pedcontratacao_dataaprovacaodad,
            'pedcontratacao_datahomologacao' => $this->pedcontratacao_datahomologacao,
        ]);

        $query->andFilterWhere(['like', 'pedcontratacao_assunto', $this->pedcontratacao_assunto])
            ->andFilterWhere(['like', 'pedcontratacao_recursos', $this->pedcontratacao_recursos])
            ->andFilterWhere(['like', 'pedcontratacao_aprovadorggp', $this->pedcontratacao_aprovadorggp])
            ->andFilterWhere(['like', 'pedcontratacao_aprovadordad', $this->pedcontratacao_aprovadordad])
            ->andFilterWhere(['like', 'pedcontratacao_responsavel', $this->pedcontratacao_responsavel])
            ->andFilterWhere(['like', 'pedidocusto_id', $this->pedidocusto_id])
            ->andFilterWhere(['like', 'pedcontratacao_homologador', $this->pedcontratacao_homologador]);

        return $dataProvider;
    }
}
