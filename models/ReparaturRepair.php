<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reparatur_repair".
 *
 * @property int $reparatursnummer_repairs_id
 * @property string $fin_vehicle_id
 * @property string $reparatursdatum_repairs_date
 * @property int $reparaturskosten_repair_costs
 * @property string $reparatursort_repair_place
 * @property string $reparatursinhalt_repair_content
 * @property string $sonstiges_other
 */
class ReparaturRepair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reparatur_repair';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reparatursnummer_repairs_id', 'fin_vehicle_id', 'reparatursdatum_repairs_date', 'reparaturskosten_repair_costs', 'reparatursort_repair_place', 'reparatursinhalt_repair_content', 'sonstiges_other'], 'required'],
            [['reparatursnummer_repairs_id', 'reparaturskosten_repair_costs'], 'integer'],
            [['reparatursdatum_repairs_date'], 'safe'],
            [['reparatursort_repair_place', 'reparatursinhalt_repair_content', 'sonstiges_other'], 'string'],
            [['fin_vehicle_id'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reparatursnummer_repairs_id' => 'Reparaturs Nummer (Repairs ID)',
            'fin_vehicle_id' => 'Fin (Vehicle ID)',
            'reparatursdatum_repairs_date' => 'Reparatursdatum (Repairs Date)',
            'reparaturskosten_repair_costs' => 'Reparaturskosten (Repair Costs)',
            'reparatursort_repair_place' => 'Reparatursort (Repair Place)',
            'reparatursinhalt_repair_content' => 'Reparatursinhalt (Repair Content)',
            'sonstiges_other' => 'Sonstiges (Other)',
        ];
    }
}
