<?php

namespace app\models\curriculos;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\etapasprocesso\EtapasItens;
use app\models\etapasprocesso\EtapasProcesso;

/**
 * CadastroDeReservaSearch represents the model behind the search form about `app\models\etapasprocesso\EtapasItens`.
 */
class CadastroDeReservaSearch extends EtapasItens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'etapasprocesso_id', 'curriculos_id'], 'integer'],
            [['itens_escrita', 'itens_comportamental', 'itens_entrevista', 'itens_pontuacaototal'], 'number'],
            [['itens_classificacao', 'itens_localcontratacao', 'cargo'], 'safe'],
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

        $query = EtapasItens::find()->select(['id', 'curriculos_id', 'itens_classificacao', 'itens_localcontratacao', 'etapa_cargo as cargo'])->innerJoinWith('etapasprocesso', `etapasprocesso_id` == `etapa_id`)->where(['<>','itens_classificacao', '%Desclassificado(a)%'])->andWhere(['<>','itens_classificacao', '']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['cargo'] = [
        'asc' => ['etapas_processo.etapa_cargo' => SORT_ASC],
        'desc' => ['etapas_processo.etapa_cargo' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'etapasprocesso_id' => $this->etapasprocesso_id,
            'curriculos_id' => $this->curriculos_id,
            'itens_escrita' => $this->itens_escrita,
            'itens_comportamental' => $this->itens_comportamental,
            'itens_entrevista' => $this->itens_entrevista,
            'itens_pontuacaototal' => $this->itens_pontuacaototal,
        ]);

        $query->andFilterWhere(['like', 'itens_classificacao', $this->itens_classificacao])
              ->andFilterWhere(['like', 'itens_localcontratacao', $this->itens_localcontratacao])
              ->andFilterWhere(['like', 'etapas_processo.etapa_cargo', $this->cargo]);

        return $dataProvider;
    }
}
