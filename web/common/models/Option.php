<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "g02_option".
 *
 * @property integer $g02_id
 * @property integer $g01_id
 * @property integer $g02_value
 * @property string $g02_descrip
 * @property integer $g02_active
 * @property integer $g02_usercreate
 * @property string $g02_datecreate
 * @property integer $g02_userupdate
 * @property string $g02_dateupdate
 *
 * @property A02Profile[] $a02Profiles
 * @property A02Profile[] $a02Profiles0
 * @property C01Routes $c01Routes
 * @property C01Routes $c01Routes0
 * @property User $g02Usercreate
 * @property G01Group $g01
 */
class Option extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g02_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['g01_id', 'g02_value', 'g02_descrip', 'g02_active', 'g02_usercreate'], 'required'],
            [['g01_id', 'g02_value', 'g02_active', 'g02_usercreate', 'g02_userupdate'], 'integer'],
            [['g02_datecreate', 'g02_dateupdate'], 'safe'],
            [['g02_descrip'], 'string', 'max' => 100],
            [['g02_usercreate'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['g02_usercreate' => 'id']],
            [['g01_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['g01_id' => 'g01_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'g02_id' => 'Id',
            'g01_id' => 'Grupo',
            'g02_value' => 'Valor',
            'g02_descrip' => 'Descripción',
            'g02_active' => 'Estado',
            'g02_usercreate' => 'Usuario de alta',
            'g02_datecreate' => 'Fecha de alta',
            'g02_userupdate' => 'Usuario de modificación',
            'g02_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles_c()
    {
        return $this->hasMany(Profile::className(), ['g02_country' => 'g02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles_s()
    {
        return $this->hasMany(Profile::className(), ['g02_state' => 'g02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC01Routes()
    {
        return $this->hasOne(Route::className(), ['g02_country' => 'g02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC01Routes0()
    {
        return $this->hasOne(Route::className(), ['g02_state' => 'g02_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG02Usercreate()
    {
        return $this->hasOne(User::className(), ['id' => 'g02_usercreate']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG01()
    {
        return $this->hasOne(Group::className(), ['g01_id' => 'g01_id']);
    }

    //FUNCIONES
    public static function getCombo($grupo){
        $options=Option::find()
            ->where('g01_id=:group AND g02_active=1',[':group'=>$grupo])
            ->asArray()
            ->all();
        return ArrayHelper::map($options, 'g02_id', 'g02_descrip');
    }
}
