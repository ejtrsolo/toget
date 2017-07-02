<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r01_recomendaciones".
 *
 * @property integer $r01_id
 * @property integer $c08_persona
 * @property integer $a01_id
 * @property integer $c06_objeto
 * @property string $r01_fecha_inicio
 * @property string $r01_fecha_fin
 * @property integer $r01_repeticion_tiempo
 * @property string $r01_hora
 * @property double $r01_duracion_leds
 * @property string $r01_descripcion
 * @property integer $r01_status
 * @property integer $r01_usercreate
 * @property string $r01_datecreate
 * @property integer $r01_userupdate
 * @property string $r01_dateupdate
 *
 * @property Personas $persona
 * @property Profile $usuario
 * @property User $user
 * @property Objetos $objeto
 */
class Recomendaciones extends \common\models\ActiveRecordHow
{
    const COMBO_REPETICION = 3;
    const OP_UNA = 7;
    const OP_DIA = 8;
    const OP_SEMANA = 9;
    const OP_MES = 10;
    const OP_ANIO = 11;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r01_recomendaciones';
    }

    public function getPrefix(){ 
        return 'r01';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c08_persona', 'a01_id', 'c06_objeto', 'r01_fecha_inicio', 'r01_repeticion_tiempo', 'r01_hora', 'r01_duracion_leds'], 'required'],
            [['c08_persona', 'a01_id', 'c06_objeto', 'r01_repeticion_tiempo', 'r01_status', 'r01_usercreate', 'r01_userupdate'], 'integer'],
            [['r01_fecha_inicio', 'r01_fecha_fin', 'r01_hora', 'r01_datecreate', 'r01_dateupdate'], 'safe'],
            [['r01_duracion_leds'], 'number'],
            ['r01_fecha_fin', function($attribute, $params){
                if($this->r01_repeticion_tiempo == Recomendaciones::OP_DIA ||
                    $this->r01_repeticion_tiempo == Recomendaciones::OP_SEMANA ||
                    $this->r01_repeticion_tiempo == Recomendaciones::OP_MES ||
                    $this->r01_repeticion_tiempo == Recomendaciones::OP_ANIO){
                    $this->addError($attribute, 'Fecha de fin no puede estar vacia.');
                }
            }, 'skipOnEmpty' => false, 'skipOnError' => false],
            [['r01_descripcion'], 'string', 'max' => 400],
            [['c08_persona'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['c08_persona' => 'c08_id']],
            [['a01_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['a01_id' => 'id']],
            [['c06_objeto'], 'exist', 'skipOnError' => true, 'targetClass' => Objetos::className(), 'targetAttribute' => ['c06_objeto' => 'c06_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r01_id' => 'Id',
            'c08_persona' => 'Persona',
            'a01_id' => 'Usuario',
            'c06_objeto' => 'Objeto',
            'r01_fecha_inicio' => 'Fecha de inicio',
            'r01_fecha_fin' => 'Fecha de fin',
            'r01_repeticion_tiempo' => 'Repetición',
            'r01_hora' => 'Hora',
            'r01_duracion_leds' => 'Duración de led´s',
            'r01_descripcion' => 'Descripción',
            'r01_status' => 'Estatus',
            'r01_usercreate' => 'Usuario de alta',
            'r01_datecreate' => 'Fecha de alta',
            'r01_userupdate' => 'Usuario de modificación',
            'r01_dateupdate' => 'Fecha de modificación',
        ];
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
    public function getObjeto()
    {
        return $this->hasOne(Objetos::className(), ['c06_id' => 'c06_objeto']);
    }
    public function getRelacion(){
        return Relacion::findOne(['a01_id'=>$this->a01_id, 'c08_persona'=>$this->c08_persona]);
    }

    public static function getEventos(){
        $events = [];
        $eventos = Recomendaciones::find()->where(['r01_status'=>1])->all();
        foreach ($eventos as $e) {
            $objeto = $e->objeto;
            $color = $e->getRelacion()->color;
            $event = new \yii2fullcalendar\models\Event();
            $event->id = 1;
            $event->title = $objeto->c06_nombre;
            $event->description = $objeto->c06_nombre.': '.$e->r01_descripcion;
            $event->start = date('Y-m-d\TH:i:s\Z', strtotime($e->r01_fecha_inicio.' '.$e->r01_hora));
            $event->end = date('Y-m-d\TH:i:s\Z', strtotime($e->r01_fecha_fin));
            $event->color = Utils::getRGBtoHexa($color->c01_r, $color->c01_g, $color->c01_b);
            $events[] = $event;
        }
        return $events;
    }
}
