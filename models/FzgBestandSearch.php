<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FzgBestand;

/**
 * FzgBestandSearch represents the model behind the search form of `app\models\FzgBestand`.
 */
class FzgBestandSearch extends FzgBestand
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','id_to'],'integer'],
            [['nr','nr_to', 'ek_datum','ek_datum_to', 'modell', 'verkaeufer', 'fin', 'vk_datum','vk_datum_to', 'kaeufer','mitarbeiter_employee', 'sonstiges','vk_status'], 'safe'],
            [['ek_netto_preis', 'ek_netto_preis_to', 'ek_mwst','ek_mwst_to', 'ek_brutto_preis', 'ek_brutto_preis_to', 'vk_netto_preis', 'vk_netto_preis_to',
                'vk_mwst','vk_mwst_to', 'vk_brutto_preis','vk_brutto_preis_to','gewinn','gewinn_to', 'gewinn_add'], 'number'],
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
        //var_dump($params);Exit();
        $query = FzgBestand::find();

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
        if($this->id_to){
               $query->andFilterWhere(['between', 'id', $this->id,$this->id_to]);
        }
        else{
            $query->andFilterWhere([
                'id' => $this->id]);
        }
        if($this->nr_to){
            $query->andFilterWhere(['between','nr',$this->nr,$this->nr_to]);
        }
        else{
            $query->andFilterWhere(['like', 'nr', $this->nr]);
        }
        if($this->ek_datum_to){
            $query->andFilterWhere(['between','ek_datum',$this->ek_datum,$this->ek_datum_to]);

        }
        else{
            $query->andFilterWhere(['ek_datum'=> $this->ek_datum]);
        }

        if($this->ek_netto_preis_to){
            $query->andFilterWhere(['between','ek_netto_preis', $this->ek_netto_preis,$this->ek_netto_preis_to]);
        }
        else{
            $query->andFilterWhere(['ek_netto_preis' => $this->ek_netto_preis]);
        }
        if($this->ek_mwst_to){
            $query->andFilterWhere(['between', 'ek_mwst', $this->ek_mwst, $this->ek_mwst_to]);
        }
        else{
            $query->andFilterWhere(['ek_mwst' => $this->ek_mwst]);
        }
        if($this->ek_brutto_preis_to){
            $query->andFilterWhere(['between', 'ek_brutto_preis', $this->ek_brutto_preis, $this->ek_brutto_preis_to]);
        }
        else{
            $query->andFilterWhere(['ek_brutto_preis' => $this->ek_brutto_preis]);
        }
        if($this->vk_datum_to){
            $query->andFilterWhere(['between', 'vk_datum',$this->vk_datum,$this->vk_datum_to]);
        }
        else{
            $query->andFilterWhere(['vk_datum'=>$this->vk_datum]);
        }
        if($this->vk_netto_preis_to){
            $query->andFilterWhere(['between', 'vk_netto_preis',$this->vk_netto_preis, $this->vk_netto_preis_to]);
        }
        else{
            $query->andFilterWhere(['vk_netto_preis'=>$this->vk_netto_preis]);
        }
        if($this->vk_mwst_to){
            $query->andFilterWhere(['between','vk_mwst',$this->vk_mwst,$this->vk_mwst_to]);
        }
        else{
            $query->andFilterWhere(['vk_mwst'=>$this->vk_mwst]);
        }
        if($this->vk_brutto_preis_to){
            $query->andFilterWhere(['between', 'vk_brutto_preis', $this->vk_brutto_preis, $this->vk_brutto_preis_to]);
        }
        else{
            $query->andFilterWhere(['vk_brutto_preis'=>$this->vk_brutto_preis]);
        }
        if($this->gewinn_to){
            $query->andFilterWhere(['between', 'gewinn', $this->gewinn, $this->gewinn_to]);
        }
        else{
            $query->andFilterWhere(['gewinn' => $this->gewinn]);
        }
       if($this->vk_datum && $this->vk_datum_to){
            //count the summ of profit for period from vk_datum to vk_datum_to
            $this->gewinn_add=FzgBestand::find()->andFilterWhere(['between', 'vk_datum',$this->vk_datum, $this->vk_datum_to] )->sum('gewinn');
        }

        // grid filtering conditions
       /* $query->andFilterWhere([
            'gewinn' => $this->gewinn,
        ]);*/

        $query
            ->andFilterWhere(['like', 'modell', $this->modell])
            ->andFilterWhere(['like', 'verkaeufer', $this->verkaeufer])
            ->andFilterWhere(['like', 'kaeufer', $this->kaeufer])
            ->andFilterWhere(['like', 'mitarbeiter_employee', $this->mitarbeiter_employee])
            ->andFilterWhere(['like', 'vk_status', $this->vk_status])
            ->andFilterWhere(['like', 'fin', $this->fin])
            ->andFilterWhere(['like', 'sonstiges', $this->sonstiges]);


        return $dataProvider;
    }
}
