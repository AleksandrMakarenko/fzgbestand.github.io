<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verkaeufer_vendor".
 *
 * @property int $verkaeufersnummer_vendor_id
 * @property string $verkaeufersname_vendor_name
 * @property string $telefonnummer_phone_number
 * @property string $email
 * @property string $anschrift_adress
 * @property string $unternehmersform_kind_of_customer
 * @property string $sonstiges_other
 */
class VerkaeuferVendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verkaeufer_vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['verkaeufersnummer_vendor_id', 'verkaeufersname_vendor_name', 'telefonnummer_phone_number', 'email', 'anschrift_adress', 'unternehmersform_kind_of_customer', 'sonstiges_other'], 'required'],
            [['verkaeufersnummer_vendor_id'], 'integer'],
            [['verkaeufersname_vendor_name', 'anschrift_adress', 'sonstiges_other'], 'string'],
            [['telefonnummer_phone_number', 'unternehmersform_kind_of_customer'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verkaeufersnummer_vendor_id' => 'Verkaeufersnummer (Vendor ID)',
            'verkaeufersname_vendor_name' => 'Verkaeufersname (Vendor Name)',
            'telefonnummer_phone_number' => 'Telefonnummer (Phone Number)',
            'email' => 'Email',
            'anschrift_adress' => 'Anschrift (Adress)',
            'unternehmersform_kind_of_customer' => 'Unternehmersform (Kind Of Customer)',
            'sonstiges_other' => 'Sonstiges (Other)',
        ];
    }
}
