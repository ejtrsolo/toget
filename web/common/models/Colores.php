<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c01_colores".
 *
 * @property integer $c01_id
 * @property string $c01_nombre
 * @property integer $c01_r
 * @property integer $c01_g
 * @property integer $c01_b
 * @property integer $c01_status
 * @property integer $c01_usercreate
 * @property string $c01_datecreate
 * @property integer $c01_userupdate
 * @property string $c01_dateupdate
 *
 * @property Relacion[] $relaciones
 */
class Colores extends \common\models\ActiveRecordHow
{
    public $color;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c01_colores';
    }

    public function getPrefix(){ 
        return 'c01';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c01_nombre', 'c01_r', 'c01_g', 'c01_b', 'color'], 'required'],
            [['c01_r', 'c01_g', 'c01_b', 'c01_status', 'c01_usercreate', 'c01_userupdate'], 'integer'],
            [['c01_datecreate', 'c01_dateupdate'], 'safe'],
            [['c01_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c01_id' => 'Id',
            'c01_nombre' => 'Nombre',
            'c01_r' => 'Rojo (Red)',
            'c01_g' => 'Verde (Green)',
            'c01_b' => 'Azul (Blue)',
            'c01_status' => 'Estatus',
            'c01_usercreate' => 'Usuario de alta',
            'c01_datecreate' => 'Fecha de alta',
            'c01_userupdate' => 'Usuario de modificación',
            'c01_dateupdate' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelaciones()
    {
        return $this->hasMany(Relacion::className(), ['c01_color' => 'c01_id']);
    }
}
