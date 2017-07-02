<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c02_country".
 *
 * @property integer $c02_id
 * @property string $c02_name
 * @property integer $c02_active
 * @property integer $c02_usercreate
 * @property string $c02_datecreate
 * @property integer $c02_userupdate
 * @property string $c02_dateupdate
 *
 * @property User $usercreate
 */
class Country extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c02_country';
    }

    public function getPrefix(){
        return 'c02';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c02_name', 'c02_active', 'c02_usercreate'], 'required'],
            [['c02_active', 'c02_usercreate', 'c02_userupdate'], 'integer'],
            [['c02_datecreate', 'c02_dateupdate'], 'safe'],
            [['c02_name'], 'string', 'max' => 100],
            [['c02_usercreate'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['c02_usercreate' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c02_id' => 'Id',
            'c02_name' => 'Nombre',
            'c02_active' => 'Estatus',
            'c02_usercreate' => 'Usuario de alta',
            'c02_datecreate' => 'Fecha de alta',
            'c02_userupdate' => 'Usuario de modificación',
            'c02_dateupdate' => 'Fecha de modificación',
        ];
    }

    public static function getCountrys(){
        $country = self::find()->all();
        return ArrayHelper::map($country, 'c02_id', 'c02_name');
    }
    public static function getCountrysOnly(){
        $country = Yii::$app->db->createCommand("SELECT c02_name FROM c02_country")->queryColumn();
        return $country;
    }

    public static function isExist($country){
        $exist = self::findOne(['c02_name'=>$country]);
        return $exist;
    }
}
