<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 26/01/2017
 * Time: 8:22
 */
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $form = ActiveForm::begin([
    'action' => ['profile/change-image', 'id'=>$model->id],
    'options'=>['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->field($model, 'file')->widget(\kartik\widgets\FileInput::className(),[
    'options'=>[
        'multiple'=>false
    ],
    'pluginOptions' => [
        //'uploadUrl' => Url::to(['/profile/change-image', 'id'=>$model->id]),
        'showUpload' => false,
    ]
]) ?>

<?= Html::submitButton('Guardar cambios', ['class' =>  'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
