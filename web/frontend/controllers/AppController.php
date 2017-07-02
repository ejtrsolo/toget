<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 25/08/2016
 * Time: 08:09 PM
 */

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\AccessControl;

use frontend\models\LoginForm;
use frontend\models\Travel;


class AppController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::className(),
                //'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ]
        ];
    }

    public function actionLogin(){
        $model = new LoginForm();
        $mensaje = '';
        $error = true;
        $errores = [];
        if ($model->load(Yii::$app->request->post())) {
            if($model->login()){
                $error = false;
                $mensaje = "Entrando...";
            }else{
                $mensaje = 'Se encontró un error al entrar. Intente de nuevo.';
                $errores = Utils::getErrors($model);
            }
            //return $this->goBack();
        } else {
            $mensaje = "Solo se puede acceder por post a este método.";
        }
        return [
            'error' => $error,
            'mensaje' => $mensaje,
            'errores' => $errores
        ];
    }
    public function actionCreateTravel(){
        $model = new Travel();
        if ($model->load(Yii::$app->request->post())) {
            $model->g02_repeat = Travel::OPTION_UNA_VEZ;
            if($model->save()){
                $error = false;
                $mensaje = "Listo.";
            }else{
                $mensaje = 'Se encontraron errores al guardar. Intente de nuevo.';
                $errores = Utils::getErrors($model);
            }
            //return $this->goBack();
        } else {
            $mensaje = "Solo se puede acceder por post a este método.";
        }
        return [
            'error' => $error,
            'mensaje' => $mensaje,
            'errores' => $errores
        ];
    }
    public function actionTravelIndex(){
        $travel_list = Travel::getTravels(Yii::$app->user->id ? Yii::$app->user->id : 1);
        $travels = [];
        foreach ($travel_list as $key => $t) {
            $travels[] = $t->attributes;
        }
        return $travels;
    }
    public function actionOptionsTime(){
        $hours = [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
        ];
        $minutes = [
            '00',
            '05',
            '10',
            '15',
            '20',
            '25',
            '30',
            '35',
            '40',
            '45',
            '50',
            '55',
            '60',
        ];
        $pa = ['am', 'pm'];
        return [
            'hours'=>$hours,
            'minutes'=>$minutes,
            'time'=>$pa,
        ];
    }



}
