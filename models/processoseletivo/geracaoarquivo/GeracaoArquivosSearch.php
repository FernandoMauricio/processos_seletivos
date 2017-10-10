<?php

namespace app\models\processoseletivo\geracaoarquivo;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\processoseletivo\geracaoarquivo\GeracaoArquivos;

/**
 * GeracaoArquivosSearch represents the model behind the search form about `app\models\processoseletivo\geracaoarquivo\GeracaoArquivos`.
 */
class GeracaoArquivosSearch extends GeracaoArquivos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gerarq_id'], 'integer'],
            [['gerarq_titulo', 'gerarq_documentos', 'gerarq_emailconfirmacao', 'gerarq_datarealizacao', 'gerarq_horarealizacao', 'gerarq_local', 'gerarq_endereco', 'gerarq_fase', 'gerarq_tempo', 'gerarq_responsavel', 'processo_id', 'etapasprocesso_id'], 'safe'],
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
        $query = GeracaoArquivos::find();

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

        $query->joinWith('processo');
        $query->joinWith('etapasprocesso');

        // grid filtering conditions
        $query->andFilterWhere([
            'gerarq_id' => $this->gerarq_id,
            'gerarq_datarealizacao' => $this->gerarq_datarealizacao,
            'gerarq_horarealizacao' => $this->gerarq_horarealizacao,
        ]);

        $query->andFilterWhere(['like', 'gerarq_titulo', $this->gerarq_titulo])
            ->andFilterWhere(['like', 'processo.numeroEdital', $this->processo_id])
            ->andFilterWhere(['like', 'etapas_processo.etapa_cargo', $this->etapasprocesso_id])
            ->andFilterWhere(['like', 'gerarq_documentos', $this->gerarq_documentos])
            ->andFilterWhere(['like', 'gerarq_emailconfirmacao', $this->gerarq_emailconfirmacao])
            ->andFilterWhere(['like', 'gerarq_local', $this->gerarq_local])
            ->andFilterWhere(['like', 'gerarq_endereco', $this->gerarq_endereco])
            ->andFilterWhere(['like', 'gerarq_fase', $this->gerarq_fase])
            ->andFilterWhere(['like', 'gerarq_tempo', $this->gerarq_tempo])
            ->andFilterWhere(['like', 'gerarq_responsavel', $this->gerarq_responsavel]);

        return $dataProvider;
    }
}
