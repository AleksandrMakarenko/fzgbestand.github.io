<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KaeuferCustomer;

/**
 * KaeuferCustomerSearch represents the model behind the search form of `app\models\KaeuferCustomer`.
 */
class KaeuferCustomerSearch extends KaeuferCustomer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kaeufersnummer_customer_id'], 'integer'],
            [['kaufersname_customer_name', 'telefonnummer_phonenumber', 'email', 'anschrift_adress', 'unternehmersform_kind_of_customer', 'sonstiges_other'], 'safe'],
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
        $query = KaeuferCustomer::find();

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
            'kaeufersnummer_customer_id' => $this->kaeufersnummer_customer_id,
        ]);

        $query->andFilterWhere(['like', 'kaufersname_customer_name', $this->kaufersname_customer_name])
            ->andFilterWhere(['like', 'telefonnummer_phonenumber', $this->telefonnummer_phonenumber])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'anschrift_adress', $this->anschrift_adress])
            ->andFilterWhere(['like', 'unternehmersform_kind_of_customer', $this->unternehmersform_kind_of_customer])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);

        return $dataProvider;
    }
}
