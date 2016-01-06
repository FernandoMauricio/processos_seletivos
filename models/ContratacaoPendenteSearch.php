<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contratacao;

/**
 * ContratacaoPendenteSearch represents the model behind the search form about `app\models\Contratacao`.
 */
class ContratacaoPendenteSearch extends Contratacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cod_colaborador', 'cod_unidade_solic', 'quant_pessoa', 'subistituicao', 'periodo', 'tempo_periodo', 'aumento_quadro', 'deficiencia', 'fundamental_comp', 'fundamento_inc', 'medio_comp', 'medio_inc', 'tecnico_comp', 'tecnico_inc', 'superior_comp', 'superior_inc', 'pos_comp', 'pos_inc', 'windows', 'word', 'excel', 'internet', 'experiencia', 'jornada_horas', 'recrutamento_id', 'selec_curriculo', 'selec_dinamica', 'selec_prova', 'selec_entrevista', 'situacao_id'], 'integer'],
            [['data_solicitacao', 'hora_solicitacao', 'colaborador', 'unidade', 'motivo', 'nome_substituicao', 'obs_deficiencia', 'data_ingresso', 'tecnico_area', 'superior_area', 'pos_area', 'dominio_atividade', 'experiencia_tempo', 'experiencia_atividade', 'jornada_obs', 'principais_atividades', 'selec_teste'], 'safe'],
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
        $query = Contratacao::find();

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
            'data_solicitacao' => $this->data_solicitacao,
            'hora_solicitacao' => $this->hora_solicitacao,
            'cod_colaborador' => $this->cod_colaborador,
            'cod_unidade_solic' => $this->cod_unidade_solic,
            'quant_pessoa' => $this->quant_pessoa,
            'subistituicao' => $this->subistituicao,
            'periodo' => $this->periodo,
            'tempo_periodo' => $this->tempo_periodo,
            'aumento_quadro' => $this->aumento_quadro,
            'deficiencia' => $this->deficiencia,
            'fundamental_comp' => $this->fundamental_comp,
            'fundamento_inc' => $this->fundamento_inc,
            'medio_comp' => $this->medio_comp,
            'medio_inc' => $this->medio_inc,
            'tecnico_comp' => $this->tecnico_comp,
            'tecnico_inc' => $this->tecnico_inc,
            'superior_comp' => $this->superior_comp,
            'superior_inc' => $this->superior_inc,
            'pos_comp' => $this->pos_comp,
            'pos_inc' => $this->pos_inc,
            'windows' => $this->windows,
            'word' => $this->word,
            'excel' => $this->excel,
            'internet' => $this->internet,
            'experiencia' => $this->experiencia,
            'jornada_horas' => $this->jornada_horas,
            'recrutamento_id' => $this->recrutamento_id,
            'selec_curriculo' => $this->selec_curriculo,
            'selec_dinamica' => $this->selec_dinamica,
            'selec_prova' => $this->selec_prova,
            'selec_entrevista' => $this->selec_entrevista,
            'situacao_id' => $this->situacao_id,
        ]);

        $query->andFilterWhere(['situacao_id' => 3])
            ->andFilterWhere(['like', 'colaborador', $this->colaborador])
            ->andFilterWhere(['like', 'unidade', $this->unidade])
            ->andFilterWhere(['like', 'motivo', $this->motivo])
            ->andFilterWhere(['like', 'nome_substituicao', $this->nome_substituicao])
            ->andFilterWhere(['like', 'obs_deficiencia', $this->obs_deficiencia])
            ->andFilterWhere(['like', 'data_ingresso', $this->data_ingresso])
            ->andFilterWhere(['like', 'tecnico_area', $this->tecnico_area])
            ->andFilterWhere(['like', 'superior_area', $this->superior_area])
            ->andFilterWhere(['like', 'pos_area', $this->pos_area])
            ->andFilterWhere(['like', 'dominio_atividade', $this->dominio_atividade])
            ->andFilterWhere(['like', 'experiencia_tempo', $this->experiencia_tempo])
            ->andFilterWhere(['like', 'experiencia_atividade', $this->experiencia_atividade])
            ->andFilterWhere(['like', 'jornada_obs', $this->jornada_obs])
            ->andFilterWhere(['like', 'principais_atividades', $this->principais_atividades])
            ->andFilterWhere(['like', 'selec_teste', $this->selec_teste]);

        return $dataProvider;
    }
}
