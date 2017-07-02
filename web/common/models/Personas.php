<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c08_personas".
 *
 * @property integer $c08_id
 * @property string $c08_nombre
 * @property string $c08_apaterno
 * @property string $c08_amaterno
 * @property string $c08_imagen
 * @property string $c08_usuario
 * @property string $c08_password
 * @property integer $c08_status
 * @property integer $c08_usercreate
 * @property string $c08_datecreate
 * @property integer $c08_userupdate
 * @property string $c08_dateupdate
 *
 * @property C06Objetos[] $c06Objetos
 * @property C07Dispositivos[] $c07Dispositivos
 * @property R01Recomendaciones[] $r01Recomendaciones
 * @property R02Registros[] $r02Registros
 * @property R03Relacion[] $r03Relacions
 * @property R04RelacionPermisos[] $r04RelacionPermisos
 */
class Personas extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c08_personas';
    }

    public function getPrefix(){ 
        return 'c08';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c08_nombre', 'c08_apaterno', 'c08_amaterno', 'c08_usuario', 'c08_password'], 'required'],
            [['c08_password'], 'string'],
            [['c08_status', 'c08_usercreate', 'c08_userupdate'], 'integer'],
            [['c08_datecreate', 'c08_dateupdate'], 'safe'],
            [['c08_nombre'], 'string', 'max' => 100],
            [['c08_apaterno', 'c08_amaterno', 'c08_usuario'], 'string', 'max' => 80],
            [['c08_imagen'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c08_id' => 'Id',
            'c08_nombre' => 'Nombre',
            'c08_apaterno' => 'Apellido paterno',
            'c08_amaterno' => 'Apellido materno',
            'c08_imagen' => 'Imagen',
            'c08_usuario' => 'Usuario',
            'c08_password' => 'Contraseña',
            'c08_status' => 'Estatus',
            'c08_usercreate' => 'Usuario de alta',
            'c08_datecreate' => 'Fecha de alta',
            'c08_userupdate' => 'Usuario de modificación',
            'c08_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC06Objetos()
    {
        return $this->hasMany(C06Objetos::className(), ['c08_persona' => 'c08_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC07Dispositivos()
    {
        return $this->hasMany(C07Dispositivos::className(), ['c08_persona' => 'c08_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR01Recomendaciones()
    {
        return $this->hasMany(R01Recomendaciones::className(), ['c08_persona' => 'c08_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR02Registros()
    {
        return $this->hasMany(R02Registros::className(), ['c08_persona' => 'c08_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR03Relacions()
    {
        return $this->hasMany(R03Relacion::className(), ['c08_persona' => 'c08_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR04RelacionPermisos()
    {
        return $this->hasMany(R04RelacionPermisos::className(), ['c08_persona' => 'c08_id']);
    }
}
