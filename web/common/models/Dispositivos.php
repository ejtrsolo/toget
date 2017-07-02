<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c07_dispositivos".
 *
 * @property integer $c07_id
 * @property string $c07_device
 * @property string $c07_last_con
 * @property integer $c08_persona
 * @property integer $c06_objeto
 * @property integer $c07_status
 * @property integer $c07_usercreate
 * @property string $c07_datecreate
 * @property integer $c07_userupdate
 * @property string $c07_dateupdate
 *
 * @property C06Objetos[] $c06Objetos
 * @property C06Objetos $c06Objeto
 * @property C08Personas $c08Persona
 */
class Dispositivos extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c07_dispositivos';
    }

    public function getPrefix(){ 
        return 'c07';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c07_device', 'c08_persona'], 'required'],
            [['c07_last_con', 'c07_datecreate', 'c07_dateupdate'], 'safe'],
            [['c08_persona', 'c06_objeto', 'c07_status', 'c07_usercreate', 'c07_userupdate'], 'integer'],
            [['c07_device'], 'string', 'max' => 50],
            [['c06_objeto'], 'exist', 'skipOnError' => true, 'targetClass' => C06Objetos::className(), 'targetAttribute' => ['c06_objeto' => 'c06_id']],
            [['c08_persona'], 'exist', 'skipOnError' => true, 'targetClass' => C08Personas::className(), 'targetAttribute' => ['c08_persona' => 'c08_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c07_id' => 'Id',
            'c07_device' => 'Device',
            'c07_last_con' => 'Última Conexión',
            'c08_persona' => 'Persona',
            'c06_objeto' => 'Objeto',
            'c07_status' => 'Estatus',
            'c07_usercreate' => 'Usuario de alta',
            'c07_datecreate' => 'Fecha de alta',
            'c07_userupdate' => 'Usuario de modificación',
            'c07_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC06Objetos()
    {
        return $this->hasMany(C06Objetos::className(), ['c07_dispositivo' => 'c07_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC06Objeto()
    {
        return $this->hasOne(C06Objetos::className(), ['c06_id' => 'c06_objeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC08Persona()
    {
        return $this->hasOne(C08Personas::className(), ['c08_id' => 'c08_persona']);
    }
}
