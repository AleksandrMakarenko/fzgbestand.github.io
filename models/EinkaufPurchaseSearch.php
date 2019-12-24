<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EinkaufPurchase;

/**
 * EinkaufPurchaseSearch represents the model behind the search form of `app\models\EinkaufPurchase`.
 */
class EinkaufPurchaseSearch extends EinkaufPurchase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_insite_id'], 'integer'],
            [['verkaeufersname_vendor_name', 'einkaufsdatum_purchase_date', 'fin_vehicle_id', 'bezahlungsdatum_pay_date',
                'zahlungsmethode_payment_method', 'sonstiges_other','verkaeufersnr_vendor_id'], 'safe'],
            [['netto_preis_net_price', 'mws_value_added_tax', 'brutto_preis_gross_price'], 'number'],
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
        $query = EinkaufPurchase::find();

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
            'nr_insite_id' => $this->nr_insite_id,
            'einkaufsdatum_purchase_date' => $this->einkaufsdatum_purchase_date,
            'netto_preis_net_price' => $this->netto_preis_net_price,
            'mws_value_added_tax' => $this->mws_value_added_tax,
            'brutto_preis_gross_price' => $this->brutto_preis_gross_price,
            'bezahlungsdatum_pay_date' => $this->bezahlungsdatum_pay_date,
            'verkaeufersnr_vendor_id' => $this->verkaeufersnr_vendor_id,
            'fin_vehicle_id' => $this->fin_vehicle_id,
        ]);

        $query->andFilterWhere(['like', 'verkaeufersname_vendor_name', $this->verkaeufersname_vendor_name])
              ->andFilterWhere(['like', 'zahlungsmethode_payment_method', $this->zahlungsmethode_payment_method])
              ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);


        return $dataProvider;
    }
}
