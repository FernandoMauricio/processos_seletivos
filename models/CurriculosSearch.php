<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Curriculos;

/**
 * CurriculosSearch represents the model behind the search form about `app\models\Curriculos`.
 */
class CurriculosSearch extends Curriculos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cv_id'], 'integer'],
            [['cv_numeroEdital', 'cv_cargo', 'cv_nome', 'cv_datanascimento', 'cv_email', 'cv_telefone', 'cv_resumocv', 'cv_data', 'cv_email2', 'cv_telefone2'], 'safe'],
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
        $query = Curriculos::find()
        ->orderBy(['cv_nome' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 100,
        ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cv_id' => $this->cv_id,
            'cv_datanascimento' => $this->cv_datanascimento,
            'cv_data' => $this->cv_data,
        ]);

        $query->andFilterWhere(['like', 'cv_numeroEdital', $this->cv_numeroEdital])
            ->andFilterWhere(['like', 'cv_cargo', $this->cv_cargo])
            ->andFilterWhere(['like', 'cv_nome', $this->cv_nome])
            ->andFilterWhere(['like', 'cv_email', $this->cv_email])
            ->andFilterWhere(['like', 'cv_telefone', $this->cv_telefone])
            ->andFilterWhere(['like', 'cv_resumocv', $this->cv_resumocv])
            ->andFilterWhere(['like', 'cv_email2', $this->cv_email2])
            ->andFilterWhere(['like', 'cv_telefone2', $this->cv_telefone2]);

        return $dataProvider;
    }
}
