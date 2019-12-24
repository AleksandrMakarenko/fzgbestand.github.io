<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MitarbeiterEmployee;

/**
 * MitarbeiterEmployeeSearch represents the model behind the search form of `app\models\MitarbeiterEmployee`.
 */
class MitarbeiterEmployeeSearch extends MitarbeiterEmployee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_inside_id'], 'integer'],
            [['initialen_initials', 'vorname_firstname', 'nachname_surname', 'geburtsdatum_birthdate', 'anstellungsdatum_employmentdate', 'kündigungsdatum_terminationdate', 'sonstiges_other'], 'safe'],
            [['gehalt_salary'], 'number'],
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
        $query = MitarbeiterEmployee::find();

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
            'geburtsdatum_birthdate' => $this->geburtsdatum_birthdate,
            'anstellungsdatum_employmentdate' => $this->anstellungsdatum_employmentdate,
            'kündigungsdatum_terminationdate' => $this->kündigungsdatum_terminationdate,
            'gehalt_salary' => $this->gehalt_salary,
        ]);

        $query->andFilterWhere(['like', 'initialen_initials', $this->initialen_initials])
            ->andFilterWhere(['like', 'vorname_firstname', $this->vorname_firstname])
            ->andFilterWhere(['like', 'nachname_surname', $this->nachname_surname])
            ->andFilterWhere(['like', 'sonstiges_other', $this->sonstiges_other]);

        return $dataProvider;
    }
}
