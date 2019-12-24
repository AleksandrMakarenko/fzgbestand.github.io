<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mitarbeiter_employee".
 *
 * @property int $nr_inside_id
 * @property string $initialen_initials
 * @property string $vorname_firstname
 * @property string $nachname_surname
 * @property string $geburtsdatum_birthdate
 * @property string $anstellungsdatum_employmentdate
 * @property string $kündigungsdatum_terminationdate
 * @property string $gehalt_salary
 * @property string $sonstiges_other
 */
class MitarbeiterEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mitarbeiter_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_inside_id', 'initialen_initials', 'vorname_firstname', 'nachname_surname', 'geburtsdatum_birthdate', 'anstellungsdatum_employmentdate', 'kündigungsdatum_terminationdate', 'gehalt_salary', 'sonstiges_other'], 'required'],
            [['nr_inside_id'], 'integer'],
            [['geburtsdatum_birthdate', 'anstellungsdatum_employmentdate', 'kündigungsdatum_terminationdate'], 'safe'],
            [['gehalt_salary'], 'number'],
            [['sonstiges_other'], 'string'],
            [['initialen_initials'], 'string', 'max' => 11],
            [['vorname_firstname', 'nachname_surname'], 'string', 'max' => 25],
            [['initialen_initials'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nr_inside_id' => 'Nr Inside ID',
            'initialen_initials' => 'Initialen Initials',
            'vorname_firstname' => 'Vorname Firstname',
            'nachname_surname' => 'Nachname Surname',
            'geburtsdatum_birthdate' => 'Geburtsdatum Birthdate',
            'anstellungsdatum_employmentdate' => 'Anstellungsdatum Employmentdate',
            'kündigungsdatum_terminationdate' => 'Kündigungsdatum Terminationdate',
            'gehalt_salary' => 'Gehalt Salary',
            'sonstiges_other' => 'Sonstiges Other',
        ];
    }
}
