<?php

namespace app\models\pedidos\pedidohomologacao;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\pedidohomologacao\PedidoHomologacao;

/**
 * PedidoHomologacaoSearch represents the model behind the search form about `app\models\pedidos\pedidohomologacao\PedidoHomologacao`.
 */
class PedidoHomologacaoAprovacaoSearch extends PedidoHomologacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['homolog_id', 'contratacao_id'], 'integer'],
            [['homolog_cargo', 'homolog_tipo', 'homolog_unidade', 'homolog_motivo', 'homolog_sintese', 'homolog_validade', 'homolog_aprovadorggp', 'homolog_dataaprovacaoggp', 'homolog_aprovadordad', 'homolog_dataaprovacaodad', 'homolog_responsavel', 'homolog_situacaoggp', 'homolog_situacaodad'], 'safe'],
            [['homolog_salario', 'homolog_encargos', 'homolog_total'], 'number'],
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
        $query = PedidoHomologacao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('homologSituacaoggp');
        $query->joinWith('homologSituacaodad as b');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'homolog_id' => $this->homolog_id,
            'contratacao_id' => $this->contratacao_id,
            'homolog_salario' => $this->homolog_salario,
            'homolog_encargos' => $this->homolog_encargos,
            'homolog_total' => $this->homolog_total,
            'homolog_dataaprovacaoggp' => $this->homolog_dataaprovacaoggp,
            'homolog_dataaprovacaodad' => $this->homolog_dataaprovacaodad,
            'homolog_situacaoggp' => 1, // Aguardando Aprovação
            'homolog_situacaodad' => 1, // Aguardando Aprovação
        ]);

        $query->andFilterWhere(['like', 'homolog_cargo', $this->homolog_cargo])
            ->andFilterWhere(['like', 'homolog_tipo', $this->homolog_tipo])
            ->andFilterWhere(['like', 'homolog_unidade', $this->homolog_unidade])
            ->andFilterWhere(['like', 'homolog_motivo', $this->homolog_motivo])
            ->andFilterWhere(['like', 'homolog_sintese', $this->homolog_sintese])
            ->andFilterWhere(['like', 'homolog_validade', $this->homolog_validade])
            ->andFilterWhere(['like', 'homolog_aprovadorggp', $this->homolog_aprovadorggp])
            ->andFilterWhere(['like', 'pedidocusto_situacao.situacao_descricao', $this->homolog_situacaoggp])
            ->andFilterWhere(['like', 'homolog_aprovadordad', $this->homolog_aprovadordad])
            ->andFilterWhere(['like', 'b.situacao_descricao', $this->homolog_situacaodad])
            ->andFilterWhere(['like', 'homolog_responsavel', $this->homolog_responsavel]);

        return $dataProvider;
    }
}
