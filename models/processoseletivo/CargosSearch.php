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
            [['descricao', 'areasLabel', 'descricao_cargo', 'homologacao', 'data_homologacao'], 'safe'],
            [['salario_valorhora', 'salario', 'salario_1sexto', 'salario_produtividade', 'salario_6horasfixas', 'salario_1sextofixas', 'salario_bruto', 'encargos', 'valor_total'], 'number'],
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

        $query->joinWith('areasCargos.area');

        $dataProvider->sort->attributes['areasLabel'] = [
        'asc' => ['areas.descricao' => SORT_ASC],
        'desc' => ['areas.descricao' => SORT_DESC],
        ];

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
            'salario_valorhora' => $this->salario_valorhora,
            'salario' => $this->salario,
            'salario_1sexto' => $this->salario_1sexto,
            'salario_produtividade' => $this->salario_produtividade,
            'salario_6horasfixas' => $this->salario_6horasfixas,
            'salario_1sextofixas' => $this->salario_1sextofixas,
            'salario_bruto' => $this->salario_bruto,
            'encargos' => $this->encargos,
            'valor_total' => $this->valor_total,
            //'cargos.status' => 1, //Cadastros ativos
        ]);

        $query->andFilterWhere(['like', 'cargos.descricao', $this->descricao])
              ->andFilterWhere(['like', 'areas.descricao', $this->areasLabel])
              ->andFilterWhere(['like', 'descricao_cargo', $this->descricao_cargo])
              ->andFilterWhere(['like', 'homologacao', $this->homologacao])
              ->andFilterWhere(['like', 'data_homologacao', $this->data_homologacao])
              ->andFilterWhere(['like', 'cargos.status', $this->status]);

        return $dataProvider;
    }
}
