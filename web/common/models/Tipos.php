<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c05_tipos".
 *
 * @property integer $c05_id
 * @property string $c05_nombre
 * @property integer $c05_status
 * @property integer $c05_usercreate
 * @property string $c05_datecreate
 * @property integer $c05_userupdate
 * @property string $c05_dateupdate
 *
 * @property Mensajes[] $mensajes
 * @property Objetos[] $objetos
 */
class Tipos extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c05_tipos';
    }

    public function getPrefix(){ 
        return 'c05';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_nombre'], 'required'],
            [['c05_status', 'c05_usercreate', 'c05_userupdate'], 'integer'],
            [['c05_datecreate', 'c05_dateupdate'], 'safe'],
            [['c05_nombre'], 'string', 'max' => 50],
            [['c05_nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c05_id' => 'Id',
            'c05_nombre' => 'Nombre',
            'c05_status' => 'Estatus',
            'c05_usercreate' => 'Usuario de alta',
            'c05_datecreate' => 'Fecha de alta',
            'c05_userupdate' => 'Usuario de modificación',
            'c05_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes()
    {
        return $this->hasMany(Mensajes::className(), ['c05_tipo' => 'c05_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objetos::className(), ['c05_tipo' => 'c05_id']);
    }
    public static function getTipos(){
        $tipos = Tipos::find()->where(['c05_status'=>1])->all();
        return ArrayHelper::map($tipos, 'c05_id', 'c05_nombre');
    }
}
