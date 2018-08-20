<?php

namespace app\models\pedidos\pedidocontratacao;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\pedidocontratacao\PedidoContratacao;

/**
 * PedidoContratacaoAprovacaoDadSearch represents the model behind the search form about `app\models\pedidos\pedidocontratacao\PedidoContratacao`.
 */
class PedidoContratacaoAprovacaoDadSearch extends PedidoContratacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedcontratacao_id'], 'integer'],
            [['pedcontratacao_assunto', 'pedcontratacao_recursos', 'pedcontratacao_data', 'pedcontratacao_aprovadorggp', 'pedcontratacao_dataaprovacaoggp', 'pedcontratacao_aprovadordad', 'pedcontratacao_dataaprovacaodad', 'pedcontratacao_responsavel', 'pedcontratacao_situacaoggp', 'pedcontratacao_situacaodad'], 'safe'],
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

        $this->load($params);

        $query->joinWith('pedcontratacaoSituacaoggp');
        $query->joinWith('pedcontratacaoSituacaodad as b');

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
            'pedcontratacao_dataaprovacaoggp' => $this->pedcontratacao_dataaprovacaoggp,
            'pedcontratacao_dataaprovacaodad' => $this->pedcontratacao_dataaprovacaodad,
            'pedcontratacao_situacaoggp' => 4,//Aprovado Pelo GGP
            'pedcontratacao_situacaodad' => 1, // Aguardando Aprovação
        ]);

        $query->andFilterWhere(['like', 'pedcontratacao_assunto', $this->pedcontratacao_assunto])
            ->andFilterWhere(['like', 'pedcontratacao_recursos', $this->pedcontratacao_recursos])
            ->andFilterWhere(['like', 'pedidocusto_situacao.situacao_descricao', $this->pedcontratacao_situacaoggp])
            ->andFilterWhere(['like', 'b.situacao_descricao', $this->pedcontratacao_situacaodad])
            ->andFilterWhere(['like', 'pedcontratacao_aprovadorggp', $this->pedcontratacao_aprovadorggp])
            ->andFilterWhere(['like', 'pedcontratacao_aprovadordad', $this->pedcontratacao_aprovadordad])
            ->andFilterWhere(['like', 'pedcontratacao_responsavel', $this->pedcontratacao_responsavel]);

        return $dataProvider;
    }
}
