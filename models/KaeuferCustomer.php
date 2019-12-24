<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kaeufer_customer".
 *
 * @property int $kaeufersnummer_customer_id
 * @property string $kaufersname_customer_name
 * @property string $telefonnummer_phonenumber
 * @property string $email
 * @property string $anschrift_adress
 * @property string $unternehmersform_kind_of_customer
 * @property string $sonstiges_other
 */
class KaeuferCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kaeufer_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kaeufersnummer_customer_id', 'kaufersname_customer_name', 'telefonnummer_phonenumber', 'email', 'anschrift_adress', 'unternehmersform_kind_of_customer', 'sonstiges_other'], 'required'],
            [['kaeufersnummer_customer_id'], 'integer'],
            [['kaufersname_customer_name', 'anschrift_adress', 'sonstiges_other'], 'string'],
            [['telefonnummer_phonenumber', 'unternehmersform_kind_of_customer'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kaeufersnummer_customer_id' => 'Kaeufersnummer Customer ID',
            'kaufersname_customer_name' => 'Kaufersname Customer Name',
            'telefonnummer_phonenumber' => 'Telefonnummer Phonenumber',
            'email' => 'Email',
            'anschrift_adress' => 'Anschrift Adress',
            'unternehmersform_kind_of_customer' => 'Unternehmersform Kind Of Customer',
            'sonstiges_other' => 'Sonstiges Other',
        ];
    }
}
