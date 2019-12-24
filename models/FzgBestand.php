<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fzg_bestand".
 *
 * @property int $id
 * @property string $nr
 * @property string $ek_datum
 * @property string $modell
 * @property string $verkaeufer
 * @property string $fin
 * @property string $ek_netto_preis
 * @property string $ek_mwst
 * @property string $ek_brutto_preis
 * @property string $vk_datum
 * @property string $kaeufer
 * @property string $vk_netto_preis
 * @property string $vk_mwst
 * @property string $vk_brutto_preis
 * @property string $gewinn
 * @property string $mitarbeiter_employee
 * @property string $sonstiges
 * @property int $vk_status
 */
class FzgBestand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     
    public static function tableName()
    {
        return 'fzg_bestand';
    }
    public static $vk_status=['not sold','sold'];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[/*'nr', 'ek_datum', 'modell', 'verkaeufer', 'fin', 'ek_netto_preis', 'ek_mwst', 'ek_brutto_preis', 'vk_datum', 'kaeufer', 'vk_netto_preis', 'vk_mwst', 'vk_brutto_preis', 'gewinn'*/], 'required'],
            [['id'], 'integer','message' => ' new code '],
            [['ek_datum', 'vk_datum'], 'safe'],
            [['ek_datum'], 'date', 'format' => 'php:Y-m-d'],
            [['modell', 'verkaeufer', 'kaeufer', 'sonstiges'], 'string'],
            [['ek_netto_preis', 'ek_mwst', 'ek_brutto_preis', 'vk_netto_preis', 'vk_mwst', 'vk_brutto_preis', 'gewinn','vk_status'], 'number'],
            [['nr', 'fin', 'mitarbeiter_employee'], 'string', 'max' => 15],
            [['id'], 'unique'],
        ];
    }
    public $id_to;
    public $nr_to;
    public $ek_datum_to;
    public $ek_netto_preis_to;
    public $ek_mwst_to;
    public $ek_brutto_preis_to;
    public $vk_datum_to;
    public $vk_netto_preis_to;
    public $vk_mwst_to;
    public $vk_brutto_preis_to;
    public $gewinn_to;
    public $gewinn_add;



    /**
     * {@inheritdoc}
     */


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_to' => 'bis ID',
            'nr' => 'Nr',
            'nr_to'=>'bis Nr',
            'ek_datum' => 'Ek Datum',
            'ek_datum_to'=>'bis Ek Datum',
            'modell' => 'Modell',
            'verkaeufer' => 'Verkaeufer',
            'fin' => 'Fin',
            'ek_netto_preis' => 'Ek Netto Preis',
            'ek_netto_preis_to'=>'Bis Ek Preis',
            'ek_mwst' => 'Ek Mwst',
            'ek_mwst_to'=>'Bis Ek Mwst',
            'ek_brutto_preis' => 'Ek Brutto Preis',
            'ek_brutto_preis_to' => 'Bis Ek Brutto Preis',
            'vk_status' => 'Vk Status: Ermitteln verkaufte(unverkaufte) geben 1(0)',
            'vk_datum' => 'Vk Datum',
            'vk_datum_to'=>'Bis Vk Datum',
            'kaeufer' => 'Kaeufer',
            'vk_netto_preis' => 'Vk Netto Preis',
            'vk_netto_preis_to'=>'Bis Vk Preis',
            'vk_mwst' => 'Vk Mwst',
            'vk_mwst_to' => 'Bis Vk Mwst',
            'vk_brutto_preis' => 'Vk Brutto Preis',
            'vk_brutto_preis_to' => 'Bis Vk Preis',
            'gewinn' => 'Gewinn',
            'gewinn_to' => 'Bis Gewinn',
            'gewinn_add'=> 'Gesamter Gewinn',
            'mitarbeiter_employee'=>'Mitarbeiter (Employee)',
            'sonstiges' => 'Sonstiges',
        ];
    }
}
