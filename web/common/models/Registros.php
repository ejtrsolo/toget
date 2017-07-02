<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r02_registros".
 *
 * @property integer $r02_id
 * @property integer $c06_objeto
 * @property integer $c08_persona
 * @property integer $r02_recomendacion
 * @property integer $r02_urgencia
 * @property string $r02_fecha
 * @property integer $r02_status
 * @property integer $r02_usercreate
 * @property string $r02_datecreate
 * @property integer $r02_userupdate
 * @property string $r02_dateupdate
 *
 * @property Objetos $c06Objeto
 * @property Personas $c08Persona
 */
class Registros extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r02_registros';
    }

    public function getPrefix(){ 
        return 'r02';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c06_objeto', 'c08_persona', 'r02_recomendacion', 'r02_urgencia'], 'required'],
            [['c06_objeto', 'c08_persona', 'r02_recomendacion', 'r02_urgencia', 'r02_status', 'r02_usercreate', 'r02_userupdate'], 'integer'],
            [['r02_fecha', 'r02_datecreate', 'r02_dateupdate'], 'safe'],
            [['c06_objeto'], 'exist', 'skipOnError' => true, 'targetClass' => Objetos::className(), 'targetAttribute' => ['c06_objeto' => 'c06_id']],
            [['c08_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['c08_persona' => 'c08_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r02_id' => 'Id',
            'c06_objeto' => 'Objeto',
            'c08_persona' => 'Persona',
            'r02_recomendacion' => 'Recomendación',
            'r02_urgencia' => 'Urgencia',
            'r02_fecha' => 'Fecha',
            'r02_status' => 'Estatus',
            'r02_usercreate' => 'Usuario de alta',
            'r02_datecreate' => 'Fecha de alta',
            'r02_userupdate' => 'Usuario de modificación',
            'r02_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjeto()
    {
        return $this->hasOne(Objetos::className(), ['c06_id' => 'c06_objeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['c08_id' => 'c08_persona']);
    }

    public function getRecomendacion(){
        return $this->hasOne(Recomendaciones::className(), ['r01_id' => 'r02_recomendacion']);
    }

    /**
     * Obtener los registros tanto como; de las personas que tengo asignadas o una persona en especifico y 
     * un objeto que tengo asignado o todos los objetos.
     * @param  int $objeto  [description]
     * @param  int $persona [description]
     * @return Registros[] $registros [description]
     */
    public static function getRegistros($persona = null, $objeto = null){
        //OBTENER PERSONAS
        $p = [];
        if(!$persona){
            $personas = Yii::$app->user->identity->mypersons;
            foreach ($personas as $person) {
                $p[] = $person->c08_persona;
            }   
        }else{
            $p[] = $persona;
        }
        //OBTENER OBJETOS
        $o = [];
        if(!$objeto){
            $objetos = Yii::$app->user->identity->myobjects;
            foreach ($objetos as $object) {
                $o[] = $object->c06_objeto;
            }   
        }else{
            $o[] = $objeto;
        }
        $registros = Registros::find()
            ->where(['in', 'c08_persona', $p])
            ->andWhere(['in', 'c06_objeto', $o])
            ->orderBy('r02_fecha DESC')
            ->all();
        return $registros;
    }
}
