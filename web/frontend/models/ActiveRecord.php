<?php

namespace frontend\models;

use yii\db\Expression;
use Yii;

class ActiveRecord extends \yii\db\ActiveRecord {

    public function beforeValidate()
    {
        if (!Yii::$app->request->post())
            return parent::beforeValidate();

        if ($this->isNewRecord) {
            $usercreate = $this->getPrefix()."_usercreate"; //Usuario de Alta
            $this->$usercreate = Yii::$app->user->id ? Yii::$app->user->id : null;

            $active = $this->getPrefix()."_active"; //Situación
            $this->$active = 1;

        } else {
            $userupdate = $this->getPrefix()."_userupdate"; //Usuario de Modificacion
            $this->$userupdate= Yii::$app->user->id;

            //Fecha de modificación
            $fec_mod = $this->getPrefix()."_dateupdate";
            $this->$fec_mod = new Expression('NOW()');
        }
        return parent::beforeValidate();
    }

    //Sobreescribir el método de Eliminar
    public function delete() {

        $column1 = $this->getPrefix() . "_active"; //Situación
        $column2 = $this->getPrefix() . "_userupdate"; //Usuario de Modificacion
        $column3 = $this->getPrefix() . "_dateupdate"; //Fecha Modificacion

        $atributtes = [$column1, $column2, $column3];

        $this->$column1 = -1;
        $this->$column2 = Yii::$app->user->id;
        $this->$column3 = new Expression('NOW()');

        return $this->update(false, $atributtes);
    }
    public function borrar(){
        return parent::delete();
    }

}
