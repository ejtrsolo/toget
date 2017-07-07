<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r04_relacion_permisos".
 *
 * @property integer $r04_id
 * @property integer $c08_persona
 * @property integer $c06_objeto
 * @property integer $a01_id
 * @property integer $r04_recomendacion
 * @property integer $r04_urgencia
 * @property integer $r04_status
 * @property integer $r04_usercreate
 * @property string $r04_datecreate
 * @property integer $r04_userupdate
 * @property string $r04_dateupdate
 *
 * @property C06Objetos $c06Objeto
 * @property User $a01
 * @property C08Personas $c08Persona
 */
class RelacionPermisos extends \common\models\ActiveRecordHow
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r04_relacion_permisos';
    }

    public function getPrefix(){ 
        return 'r04';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c08_persona', 'c06_objeto', 'a01_id', 'r04_recomendacion'], 'required'],
            [['c08_persona', 'c06_objeto', 'a01_id', 'r04_recomendacion', 'r04_urgencia', 'r04_status', 'r04_usercreate', 'r04_userupdate'], 'integer'],
            [['r04_datecreate', 'r04_dateupdate'], 'safe'],
            [['c06_objeto'], 'exist', 'skipOnError' => true, 'targetClass' => C06Objetos::className(), 'targetAttribute' => ['c06_objeto' => 'c06_id']],
            [['a01_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['a01_id' => 'id']],
            [['c08_persona'], 'exist', 'skipOnError' => true, 'targetClass' => C08Personas::className(), 'targetAttribute' => ['c08_persona' => 'c08_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r04_id' => 'Id',
            'c08_persona' => 'Persona',
            'c06_objeto' => 'Objeto',
            'a01_id' => 'Usuario',
            'r04_recomendacion' => 'Recomendación',
            'r04_urgencia' => 'Urgencia',
            'r04_status' => 'Estatus',
            'r04_usercreate' => 'Usuario de alta',
            'r04_datecreate' => 'Fecha de alta',
            'r04_userupdate' => 'Usuario de modificación',
            'r04_dateupdate' => 'Fecha de modificación',
        ];
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
    public function getA01()
    {
        return $this->hasOne(User::className(), ['id' => 'a01_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC08Persona()
    {
        return $this->hasOne(C08Personas::className(), ['c08_id' => 'c08_persona']);
    }
}
