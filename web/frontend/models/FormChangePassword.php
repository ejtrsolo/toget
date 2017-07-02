<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 29/10/2016
 * Time: 08:05 AM
 */

namespace frontend\models;


use common\models\User;
use yii\base\Model;

class FormChangePassword extends Model{
    public $old_password;
    public $new_password;
    public $repeat_password;
    public $id;

    private $_user;

    public function rules()
    {
        return [
            [['old_password', 'new_password', 'repeat_password'], 'required'],
            [['id'], 'safe'],
            [['old_password', 'new_password', 'repeat_password'], 'string', 'max' => 100],
            ['repeat_password', 'compare', 'compareAttribute' => 'new_password', 'message' => 'Las contraseñas no coinciden'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'old_password' => 'Contraseña actual',
            'new_password' => 'Nueva contraseña',
            'repeat_password' => 'Repetir contraseña',
        ];
    }
    public function validatePassword()
    {
        $user = $this->getUser();
        return ($user && $user->validatePassword($this->old_password));
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity($this->id);
        }
        return $this->_user;
    }
}