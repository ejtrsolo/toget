<?php

namespace app\models;

use common\models\Option;
use common\models\User;
use Yii;

/**
 * This is the model class for table "c01_routes".
 *
 * @property integer $c01_id
 * @property integer $g02_type
 * @property string $c01_name
 * @property string $c01_route
 * @property string $c01_stands
 * @property integer $c03_id
 * @property integer $c02_id
 * @property integer $c01_active
 * @property integer $c01_usercreate
 * @property string $c01_datecreate
 * @property integer $c01_userupdate
 * @property string $c01_dateupdate
 *
 * @property User $usercreate
 * @property Country $country
 * @property States $state
 * @property Option $type
 */
class Routes extends \common\models\ActiveRecordHow
{
    public $c;
    public $s;

    const COMBO_TIPO = 1;
    const OP_CAMION = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c01_routes';
    }

    public function getPrefix(){
        return 'c01';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['g02_type', 'c03_id', 'c02_id', 'c01_active', 'c01_usercreate', 'c01_userupdate'], 'integer'],
            [['c01_name', 'c01_route', 'c03_id', 'c02_id', 'c01_active', 'c01_usercreate', 's', 'c'], 'required'],
            [['c01_route', 'c01_stands'], 'string'],
            [['c01_datecreate', 'c01_dateupdate'], 'safe'],
            [['c01_name'], 'string', 'max' => 100],
            [['c01_name'], 'unique'],
            [['c03_id'], 'unique'],
            [['c02_id'], 'unique'],
            [['c01_usercreate'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['c01_usercreate' => 'id']],
            [['c02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['c02_id' => 'c02_id']],
            [['c03_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['c03_id' => 'c03_id']],
            [['g02_type'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['g02_type' => 'g02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c01_id' => 'Id',
            'g02_type' => 'Tipo',
            'c01_name' => 'Nombre',
            'c01_route' => 'Puntos de ruta',
            'c01_stands' => 'Paradas',
            'c03_id' => 'Estado',
            'c02_id' => 'Pais',
            's' => 'Estado',
            'c' => 'Pais',
            'c01_active' => 'Estatus',
            'c01_usercreate' => 'Usuario de alta',
            'c01_datecreate' => 'Fecha de alta',
            'c01_userupdate' => 'Usuario de modificación',
            'c01_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsercreate()
    {
        return $this->hasOne(User::className(), ['id' => 'c01_usercreate']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['c02_id' => 'c02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(States::className(), ['c03_id' => 'c03_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Option::className(), ['g02_id' => 'g02_type']);
    }
}
