<?php
namespace mdm\admin\models;
/**
 * Route
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Route extends \yii\base\Model
{
    /**
     * @var string Route value. 
     */
    public $route;
    
     public function attributeLabels(){
        return [
            "route" =>"Acción ",
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return[
            [['route'],'safe'],
        ];
    }
}
