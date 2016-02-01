<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CurriculosFormacao;

/**
 * CurriculosFormacaoSearch represents the model behind the search form about `app\models\CurriculosFormacao`.
 */
class CurriculosFormacaoSearch extends CurriculosFormacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fundamental_inc', 'fundamental_comp', 'medio_inc', 'medio_comp', 'superior_inc', 'superior_comp', 'pos', 'mestrado', 'doutorado', 'estuda_atualmente', 'estuda_turno', 'curriculos_id'], 'integer'],
            [['superior_area', 'pos_area', 'mestrado_area', 'doutorado_area', 'estuda_curso'], 'safe'],
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
        $query = CurriculosFormacao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fundamental_inc' => $this->fundamental_inc,
            'fundamental_comp' => $this->fundamental_comp,
            'medio_inc' => $this->medio_inc,
            'medio_comp' => $this->medio_comp,
            'superior_inc' => $this->superior_inc,
            'superior_comp' => $this->superior_comp,
            'pos' => $this->pos,
            'mestrado' => $this->mestrado,
            'doutorado' => $this->doutorado,
            'estuda_atualmente' => $this->estuda_atualmente,
            'estuda_turno' => $this->estuda_turno,
            'curriculos_id' => $this->curriculos_id,
        ]);

        $query->andFilterWhere(['like', 'superior_area', $this->superior_area])
            ->andFilterWhere(['like', 'pos_area', $this->pos_area])
            ->andFilterWhere(['like', 'mestrado_area', $this->mestrado_area])
            ->andFilterWhere(['like', 'doutorado_area', $this->doutorado_area])
            ->andFilterWhere(['like', 'estuda_curso', $this->estuda_curso]);

        return $dataProvider;
    }
}
