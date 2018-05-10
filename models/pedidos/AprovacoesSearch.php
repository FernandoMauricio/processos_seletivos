<?php

namespace app\models\pedidos;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pedidos\Aprovacoes;

/**
 * AprovacoesSearch represents the model behind the search form about `app\models\pedidos\Aprovacoes`.
 */
class AprovacoesSearch extends Aprovacoes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aprov_id', 'aprov_status'], 'integer'],
            [['aprov_descricao', 'aprov_cargo', 'aprov_observacao', 'aprov_area'], 'safe'],
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
        $query = Aprovacoes::find();

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
            'aprov_id' => $this->aprov_id,
            'aprov_status' => $this->aprov_status,
        ]);

        $query->andFilterWhere(['like', 'aprov_descricao', $this->aprov_descricao])
            ->andFilterWhere(['like', 'aprov_cargo', $this->aprov_cargo])
            ->andFilterWhere(['like', 'aprov_observacao', $this->aprov_observacao])
            ->andFilterWhere(['like', 'aprov_area', $this->aprov_area]);

        return $dataProvider;
    }
}
