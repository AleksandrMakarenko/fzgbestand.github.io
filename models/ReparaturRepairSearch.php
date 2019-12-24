<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReparaturRepair;

/**
 * ReparaturRepairSearch represents the model behind the search form of `app\models\ReparaturRepair`.
 */
class ReparaturRepairSearch extends ReparaturRepair
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reparatursnummer_repairs_id', 'reparaturskosten_repair_costs'], 'integer'],
            [['fin_vehicle_id', 'reparatursdatum_repairs_date', 'reparatursort_repair_place', 'reparatursinhalt_repair_content', 'sonstiges_other'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ReparaturRepair::find();

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
            'reparatursnummer_repairs_id' => $this->reparatursnummer_repairs_id,
            'reparatursdatum_repairs_date' => $this->reparatursdatum_repairs_date,
            'reparaturskosten_repair_costs' => $this->reparaturskosten_repair_costs,
        ]);

        $query->andFilterWhere(['like', 'fin_vehicle_id', $this->fin_vehicle_id])
            ->andFilterWhere(['like', 'reparatursort_repair_place', $this->reparatursort_repair_place])
            ->andFilterWhere(['like', 'reparatursinhalt_repair_content', $this->reparatursinhalt_repair_content])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);

        return $dataProvider;
    }
}
