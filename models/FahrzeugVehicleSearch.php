<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FahrzeugVehicle;

/**
 * FahrzeugVehicleSearch represents the model behind the search form of `app\models\FahrzeugVehicle`.
 */
class FahrzeugVehicleSearch extends FahrzeugVehicle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_inside_id'], 'integer'],
            [['fin_vehicle_number', 'alte_nr_old_insite_number', 'modell_car_model', 'herstellungsjahr_manufacturing_jear', 'verkaufsstatus_sale_state', 'bilder_images', 'sonstiges_other'], 'safe'],
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
        $query = FahrzeugVehicle::find();

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
            'nr_inside_id' => $this->nr_inside_id,
            'herstellungsjahr_manufacturing_jear' => $this->herstellungsjahr_manufacturing_jear,
        ]);

        $query->andFilterWhere(['like', 'fin_vehicle_number', $this->fin_vehicle_number])
            ->andFilterWhere(['like', 'alte_nr_old_insite_number', $this->alte_nr_old_insite_number])
            ->andFilterWhere(['like', 'modell_car_model', $this->modell_car_model])
            ->andFilterWhere(['like', 'verkaufsstatus_sale_state', $this->verkaufsstatus_sale_state])
            ->andFilterWhere(['like', 'bilder_images', $this->bilder_images])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);

        return $dataProvider;
    }
}
