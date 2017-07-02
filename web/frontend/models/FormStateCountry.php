<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 28/10/2016
 * Time: 10:01 PM
 */

namespace frontend\models;


use yii\base\Model;

class FormStateCountry extends Model
{
    public $state;
    public $country;

    public function rules()
    {
        return [
            [['state', 'country'], 'required'],
            [['state', 'country'], 'string', 'max' => 100],
        ];
    }
    public function attributeLabels()
    {
        return [
            'state' => 'Estado',
            'country' => 'País',
        ];
    }
}