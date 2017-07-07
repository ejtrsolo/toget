<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c04_mensajes".
 *
 * @property integer $c04_id
 * @property integer $c05_tipo
 * @property string $c04_mensaje
 * @property integer $g02_tipo_mjs
 * @property integer $c04_status
 * @property integer $c04_usercreate
 * @property string $c04_datecreate
 * @property integer $c04_userupdate
 * @property string $c04_dateupdate
 *
 * @property Tipos $tipo
 * @property Option $tipomjs
 */
class Mensajes extends \common\models\ActiveRecordHow
{
    const COMBO_TIPO = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c04_mensajes';
    }

    public function getPrefix(){ 
        return 'c04';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c05_tipo', 'c04_mensaje', 'g02_tipo_mjs'], 'required'],
            [['c05_tipo', 'g02_tipo_mjs', 'c04_status', 'c04_usercreate', 'c04_userupdate'], 'integer'],
            [['c04_datecreate', 'c04_dateupdate'], 'safe'],
            [['c04_mensaje'], 'string', 'max' => 500],
            [['c05_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipos::className(), 'targetAttribute' => ['c05_tipo' => 'c05_id']],
            [['g02_tipo_mjs'], 'exist', 'skipOnError' => true, 'targetClass' => Option::className(), 'targetAttribute' => ['g02_tipo_mjs' => 'g02_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c04_id' => 'Id',
            'c05_tipo' => 'Tipo de objeto',
            'c04_mensaje' => 'Mensaje',
            'g02_tipo_mjs' => 'Tipo de mensaje',
            'c04_status' => 'Estatus',
            'c04_usercreate' => 'Usuario de alta',
            'c04_datecreate' => 'Fecha de alta',
            'c04_userupdate' => 'Usuario de modificación',
            'c04_dateupdate' => 'Fecha de modificación',
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
    public function getTipomjs()
    {
        return $this->hasOne(Option::className(), ['g02_id' => 'g02_tipo_mjs']);
    }

    public static function getMensaje($tipo, $urgencia){
        $g02 = Option::findOne(['g01_id'=>Mensajes::COMBO_TIPO, 'g02_value'=>$urgencia]);
        return Mensajes::findOne(['c05_tipo'=>$tipo, 'g02_tipo_mjs'=>$g02->g02_id]);
    }
}
