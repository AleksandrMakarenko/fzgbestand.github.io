<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VerkaufSale;

/**
 * VerkaufSaleSearch represents the model behind the search form of `app\models\VerkaufSale`.
 */
class VerkaufSaleSearch extends VerkaufSale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['verkaufsnummer_sale_id','kaeufersnummer_customer_id'], 'integer'],
            [['fin_vehicle_id', 'verkaufsdatum_sale_date', 'kaeufersname_customersname', 'zahlungsmethode_payment_method', 'zahlungsdatum_payment_date','mitarbeiter_employee', 'sonstiges_other'], 'safe'],
            [['nettopreis_net_price', 'mws_value_added_tax', 'bruttopreis_gross_price', 'gewinn_profit'], 'number'],
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
        $query = VerkaufSale::find();

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
            'verkaufsnummer_sale_id' => $this->verkaufsnummer_sale_id,
            'verkaufsdatum_sale_date' => $this->verkaufsdatum_sale_date,
            'nettopreis_net_price' => $this->nettopreis_net_price,
            'mws_value_added_tax' => $this->mws_value_added_tax,
            'bruttopreis_gross_price' => $this->bruttopreis_gross_price,
            'gewinn_profit' => $this->gewinn_profit,
            'zahlungsdatum_payment_date' => $this->zahlungsdatum_payment_date,
            'kaeufersnummer_customer_id' => $this->kaeufersnummer_customer_id,
        ]);

        $query->andFilterWhere(['like', 'fin_vehicle_id', $this->fin_vehicle_id])
            ->andFilterWhere(['like', 'kaeufersname_customersname', $this->kaeufersname_customersname])
            ->andFilterWhere(['like', 'zahlungsmethode_payment_method', $this->zahlungsmethode_payment_method])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other])
            ->andFilterWhere(['like', 'mitarbeiter_employee', $this->mitarbeiter_employee]);

        return $dataProvider;
    }
}
