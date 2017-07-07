<?php

namespace common\models;

use frontend\models\Country;
use frontend\models\States;
use Yii;

/**
 * This is the model class for table "a02_profile".
 *
 * @property integer $a02_id
 * @property integer $a01_id
 * @property string $a02_name
 * @property string $a02_flastname
 * @property string $a02_slastname
 * @property string $a02_photo
 * @property integer $c03_id
 * @property integer $c02_id
 * @property integer $a02_status
 * @property integer $a02_usercreate
 * @property string $a02_datecreate
 * @property integer $a02_userupdate
 * @property string $a02_dateupdate
 *
 * @property User $userCreate
 * @property User $user
 * @property Country $country
 * @property States $state
 */
class Profile extends \common\models\ActiveRecordHow
{
    const CB_STATES=1;

    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'a02_profile';
    }
    public function getPrefix(){
        return 'a02';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a01_id', 'a02_name', 'a02_flastname', 'a02_slastname', 'a02_photo', 'a02_status', 'file'], 'required'],
            [['a01_id', 'c03_id', 'c02_id', 'a02_status', 'a02_usercreate', 'a02_userupdate'], 'integer'],
            [['a02_photo'], 'string'],
            [['a02_datecreate', 'a02_dateupdate'], 'safe'],
            [['a02_name', 'a02_flastname', 'a02_slastname'], 'string', 'max' => 100],
            [['a01_id'], 'unique'],
            [['a02_usercreate'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['a02_usercreate' => 'id']],
            [['a01_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['a01_id' => 'id']],
            [['c02_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['c02_id' => 'c02_id']],
            [['c03_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['c03_id' => 'c03_id']],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'maxSize' => 1024*1024*5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => 'Imagen de perfil',
            'a02_id' => 'Id',
            'a01_id' => 'Usuario',
            'a02_name' => 'Nombre',
            'a02_flastname' => 'Apellido paterno',
            'a02_slastname' => 'Apellido materno',
            'a02_photo' => 'Imagen de perfil',
            'c03_id' => 'Estado',
            'c02_id' => 'País',
            'a02_status' => 'Estado',
            'a02_usercreate' => 'Usuario de alta',
            'a02_datecreate' => 'Fecha de alta',
            'a02_userupdate' => 'Usuario de modificación',
            'a02_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreate()
    {
        return $this->hasOne(User::className(), ['id' => 'a02_usercreate']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'a01_id']);
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
}
