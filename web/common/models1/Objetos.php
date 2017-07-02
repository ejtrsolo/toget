<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "c06_objetos".
 *
 * @property integer $c06_id
 * @property string $c06_nombre
 * @property string $c06_imagen
 * @property integer $c05_tipo
 * @property integer $c07_dispositivo
 * @property integer $c08_persona
 * @property integer $c06_status
 * @property integer $c06_usercreate
 * @property string $c06_datecreate
 * @property integer $c06_userupdate
 * @property string $c06_dateupdate
 *
 * @property Tipos $tipo
 * @property Dispositivos $dispositivo
 * @property Personas $persona
 * @property Dispositivos[] $dispositivos
 * @property Recomendaciones[] $recomendaciones
 * @property Registros[] $registros
 * @property RelacionPermisos[] $relacionPermisos
 */
class Objetos extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c06_objetos';
    }

    public function getPrefix(){ 
        return 'c06';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c06_nombre', 'c05_tipo'], 'required'],
            [['c05_tipo', 'c07_dispositivo', 'c08_persona', 'c06_status', 'c06_usercreate', 'c06_userupdate'], 'integer'],
            [['c06_datecreate', 'c06_dateupdate'], 'safe'],
            [['c06_nombre'], 'string', 'max' => 100],
            [['c06_imagen'], 'string', 'max' => 200],
            [['c05_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipos::className(), 'targetAttribute' => ['c05_tipo' => 'c05_id']],
            [['c07_dispositivo'], 'exist', 'skipOnError' => true, 'targetClass' => Dispositivos::className(), 'targetAttribute' => ['c07_dispositivo' => 'c07_id']],
            [['c08_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['c08_persona' => 'c08_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c06_id' => 'Id',
            'c06_nombre' => 'Nombre',
            'c06_imagen' => 'Imagen',
            'c05_tipo' => 'Tipo',
            'c07_dispositivo' => 'Dispositivo',
            'c08_persona' => 'Persona',
            'c06_status' => 'Estatus',
            'c06_usercreate' => 'Usuario de alta',
            'c06_datecreate' => 'Fecha de alta',
            'c06_userupdate' => 'Usuario de modificación',
            'c06_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipos::className(), ['c05_id' => 'c05_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivo()
    {
        return $this->hasOne(Dispositivos::className(), ['c07_id' => 'c07_dispositivo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['c08_id' => 'c08_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivos::className(), ['c06_objeto' => 'c06_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecomendaciones()
    {
        return $this->hasMany(Recomendaciones::className(), ['c06_objeto' => 'c06_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistros()
    {
        return $this->hasMany(Registros::className(), ['c06_objeto' => 'c06_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionPermisos()
    {
        return $this->hasMany(RelacionPermisos::className(), ['c06_objeto' => 'c06_id']);
    }

    public static function getObjetos($persona){
        $objetos = Objetos::findAll(['c08_persona'=>$persona, 'c06_status'=>1]);
        return ArrayHelper::map($objetos, 'c06_id', 'c06_nombre');
    }
}
