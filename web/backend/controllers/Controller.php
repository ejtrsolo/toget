<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 15/01/2017
 * Time: 8:23
 */

namespace backend\controllers;

use Yii;
use common\models\User;

class Controller extends \yii\web\Controller {
    public function beforeAction($event)
    {
        $routes = ['login', 'error', 'request-password-reset', 'request-password'];
        $action = Yii::$app->controller->action->id;
        if(Yii::$app->user->isGuest){
            if(!in_array($action, $routes)){
                return $this->redirect(Yii::$app->params['path_host_super'].'/site/login');
            }
        }else{
            if(Yii::$app->user->identity->tipo != User::ADMINISTRADOR){
                return $this->redirect(Yii::$app->params['path_host'].'/site/login');
            }
        }

        return parent::beforeAction($event);
    }
}