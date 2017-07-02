<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c03_states".
 *
 * @property integer $c03_id
 * @property string $c03_name
 * @property integer $c03_active
 * @property integer $c03_usercreate
 * @property string $c03_datecreate
 * @property integer $c03_userupdate
 * @property string $c03_dateupdate
 *
 */
class States extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c03_states';
    }

    public function getPrefix(){
        return 'c03';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c03_name', 'c03_active'], 'required'],
            [['c03_active', 'c03_usercreate', 'c03_userupdate'], 'integer'],
            [['c03_datecreate', 'c03_dateupdate'], 'safe'],
            [['c03_name'], 'string', 'max' => 100],
            [['c03_usercreate'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['c03_usercreate' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c03_id' => 'Id',
            'c03_name' => 'Nombre',
            'c03_active' => 'Estatus',
            'c03_usercreate' => 'Usuario de alta',
            'c03_datecreate' => 'Fecha de alta',
            'c03_userupdate' => 'Usuario de modificación',
            'c03_dateupdate' => 'Fecha de modificación',
        ];
    }

    public static function getStates(){
        $states = States::find()->all();
        return ArrayHelper::map($states, 'c03_id', 'c03_name');
    }

    public static function getStatesOnly(){
        $states = Yii::$app->db->createCommand("SELECT c03_name FROM c03_states")->queryColumn();
        return $states;
    }
    public static function isExist($state){
        $exist = States::findOne(['c03_name'=>$state]);
        return $exist;
    }
}
