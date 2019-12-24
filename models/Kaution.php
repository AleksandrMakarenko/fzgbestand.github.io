<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kaution".
 *
 * @property int $nr_inside_id
 * @property string $fin_cars_number
 * @property string $kaution_deposit
 * @property string $bestaetigung_confirmation
 * @property string $zahlungsdatum_payment_date
 * @property string $zahlungsform_form_of_payment
 * @property string $sonstiges_other
 */
class Kaution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kaution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_inside_id', 'fin_cars_number', 'kaution_deposit', 'bestaetigung_confirmation', 'zahlungsdatum_payment_date', 'zahlungsform_form_of_payment', 'sonstiges_other'], 'required'],
            [['nr_inside_id'], 'integer'],
            [['kaution_deposit'], 'number'],
            [['zahlungsdatum_payment_date'], 'safe'],
            [['sonstiges_other'], 'string'],
            [['fin_cars_number', 'bestaetigung_confirmation', 'zahlungsform_form_of_payment'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nr_inside_id' => 'Nr Inside ID',
            'fin_cars_number' => 'Fin Cars Number',
            'kaution_deposit' => 'Kaution Deposit',
            'bestaetigung_confirmation' => 'Bestaetigung Confirmation',
            'zahlungsdatum_payment_date' => 'Zahlungsdatum Payment Date',
            'zahlungsform_form_of_payment' => 'Zahlungsform Form Of Payment',
            'sonstiges_other' => 'Sonstiges Other',
        ];
    }
}
