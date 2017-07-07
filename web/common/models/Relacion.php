<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r03_relacion".
 *
 * @property integer $r03_id
 * @property integer $c01_color
 * @property integer $a01_id
 * @property integer $c08_persona
 * @property integer $r03_status
 * @property integer $r03_usercreate
 * @property string $r03_datecreate
 * @property integer $r03_userupdate
 * @property string $r03_dateupdate

 * @property integer $cambiarAmigos
 * @property integer $agregarUsuarios
 * @property integer $hacerRecomendaciones
 * @property integer $verCalendario
 * @property integer $asignarObjetos
 * @property integer $cambiarPermisos
 * @property integer $cambiarObjetos
 *
 * @property User $user
 * @property Colores $color
 * @property Personas $persona
 */
class Relacion extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r03_relacion';
    }

    public function getPrefix(){ 
        return 'r03';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c01_color', 'a01_id', 'c08_persona'], 'required'],
            [['c01_color', 'a01_id', 'c08_persona', 'r03_status', 'r03_usercreate', 'r03_userupdate'], 'integer'],
            [['r03_datecreate', 'r03_dateupdate'], 'safe'],
            [['a01_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['a01_id' => 'id']],
            [['c01_color'], 'exist', 'skipOnError' => true, 'targetClass' => Colores::className(), 'targetAttribute' => ['c01_color' => 'c01_id']],
            [['c08_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['c08_persona' => 'c08_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r03_id' => 'Id',
            'c01_color' => 'Color',
            'a01_id' => 'Usuario',
            'c08_persona' => 'Persona',
            'r03_status' => 'Estatus',
            'r03_usercreate' => 'Usuario de alta',
            'r03_datecreate' => 'Fecha de alta',
            'r03_userupdate' => 'Usuario de modificación',
            'r03_dateupdate' => 'Fecha de modificación',
        ];
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
    public function getUsuario()
    {
        return $this->hasOne(Profile::className(), ['a01_id' => 'a01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Colores::className(), ['c01_id' => 'c01_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['c08_id' => 'c08_persona']);
    }
    public static function getAmigos($a01_id){
        return self::find()->andWhere(['r03_status'=>1, 'a01_id'=>$a01_id])->all();
    }
}
