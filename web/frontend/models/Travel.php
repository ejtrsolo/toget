<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "c01_travel".
 *
 * @property integer $c01_id
 * @property string $c01_start_date
 * @property string $c01_end_date
 * @property integer $g02_repeat
 * @property string $c01_start_lat
 * @property string $c01_start_lng
 * @property string $c01_end_lat
 * @property string $c01_end_lng
 * @property integer $c01_active
 * @property integer $c01_usercreate
 * @property string $c01_datecreate
 * @property integer $c01_userupdate
 * @property string $c01_dateupdate
 *
 * @property G02Option $g02Repeat
 */
class Travel extends \frontend\models\ActiveRecord
{
    const COMBO_REPEAT = 2;
    const OPTION_UNA_VEZ = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c01_travel';
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
            [['c01_start_date', 'c01_end_date', 'c01_datecreate', 'c01_dateupdate'], 'safe'],
            [['g02_repeat', 'c01_start_lat', 'c01_start_lng', 'c01_end_lat', 'c01_end_lng', 'c01_usercreate'], 'required'],
            [['g02_repeat', 'c01_active', 'c01_usercreate', 'c01_userupdate'], 'integer'],
            [['c01_start_lat', 'c01_start_lng', 'c01_end_lat', 'c01_end_lng'], 'string', 'max' => 50],
            [['g02_repeat'], 'exist', 'skipOnError' => true, 'targetClass' => G02Option::className(), 'targetAttribute' => ['g02_repeat' => 'g02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c01_id' => 'Id',
            'c01_start_date' => 'Fecha de inicio',
            'c01_end_date' => 'Fecha final',
            'g02_repeat' => 'Repetición',
            'c01_start_lat' => 'Punto de inicio (latitud)',
            'c01_start_lng' => 'Punto de inicio (longitud)',
            'c01_end_lat' => 'Punto de fin (latitud)',
            'c01_end_lng' => 'Punto de fin (longitud)',
            'c01_active' => 'Estado',
            'c01_usercreate' => 'Usuario de alta',
            'c01_datecreate' => 'Fecha de alta',
            'c01_userupdate' => 'Usuario de modificación',
            'c01_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG02Repeat()
    {
        return $this->hasOne(G02Option::className(), ['g02_id' => 'g02_repeat']);
    }
    public static function getTravels($user = 1, $active = 1){
        if(!$user){
            return [];
        }
        $travels = Travel::findAll([
            'c01_usercreate' => $user,
            'c01_active' => $active,
        ]);
        return $travels;
    }
}
