<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 26/01/2017
 * Time: 8:53
 */

namespace common\models;


use yii\base\Model;

class FromFileUpload extends Model
{
    public $file;
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file', 'id'], 'required'],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'maxSize' => 1024*1024*5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => 'Imagen de perfil',
        ];
    }

}