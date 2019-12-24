<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kaution;

/**
 * KautionerSearch represents the model behind the search form of `app\models\Kaution`.
 */
class KautionerSearch extends Kaution
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_inside_id'], 'integer'],
            [['fin_cars_number', 'bestaetigung_confirmation', 'zahlungsdatum_payment_date', 'zahlungsform_form_of_payment', 'sonstiges_other'], 'safe'],
            [['kaution_deposit'], 'number'],
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
        $query = Kaution::find();

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
            'kaution_deposit' => $this->kaution_deposit,
            'zahlungsdatum_payment_date' => $this->zahlungsdatum_payment_date,
        ]);

        $query->andFilterWhere(['like', 'fin_cars_number', $this->fin_cars_number])
            ->andFilterWhere(['like', 'bestaetigung_confirmation', $this->bestaetigung_confirmation])
            ->andFilterWhere(['like', 'zahlungsform_form_of_payment', $this->zahlungsform_form_of_payment])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);

        return $dataProvider;
    }
}
