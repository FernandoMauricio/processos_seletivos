<?php

namespace app\models\processoseletivo;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\processoseletivo\Cargos;

/**
 * CargosSearch represents the model behind the search form about `app\models\processoseletivo\Cargos`.
 */
class CargosSearch extends Cargos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcargo', 'ch_semana', 'status'], 'integer'],
            [['descricao', 'area'], 'safe'],
            [['salario', 'encargos', 'valor_total'], 'number'],
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
        $query = Cargos::find();

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
            'idcargo' => $this->idcargo,
            'ch_semana' => $this->ch_semana,
            'salario' => $this->salario,
            'encargos' => $this->encargos,
            'valor_total' => $this->valor_total,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'area', $this->area]);

        return $dataProvider;
    }
}