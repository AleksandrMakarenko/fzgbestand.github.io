<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VerkaeuferVendor;

/**
 * VerkaeuferVendorSearch represents the model behind the search form of `app\models\VerkaeuferVendor`.
 */
class VerkaeuferVendorSearch extends VerkaeuferVendor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['verkaeufersnummer_vendor_id'], 'integer'],
            [['verkaeufersname_vendor_name', 'telefonnummer_phone_number', 'email', 'anschrift_adress', 'unternehmersform_kind_of_customer', 'sonstiges_other'], 'safe'],
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
        $query = VerkaeuferVendor::find();

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
            'verkaeufersnummer_vendor_id' => $this->verkaeufersnummer_vendor_id,
        ]);

        $query->andFilterWhere(['like', 'verkaeufersname_vendor_name', $this->verkaeufersname_vendor_name])
            ->andFilterWhere(['like', 'telefonnummer_phone_number', $this->telefonnummer_phone_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'anschrift_adress', $this->anschrift_adress])
            ->andFilterWhere(['like', 'unternehmersform_kind_of_customer', $this->unternehmersform_kind_of_customer])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);

        return $dataProvider;
    }
}
