<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use frontend\models\Country;
use frontend\models\States;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
$usuarios = User::getUsuarios();
?>
<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Datos del perfil</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="profile-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype' => 'multipart/form-data', 'id'=>'form_perfil']
    ]); ?>

    <?= $form->field($model, 'a01_id')->dropDownList($usuarios) ?>

    <?= $form->field($model, 'a02_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a02_flastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a02_slastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c02_id')->widget(Select2::classname(), [
        'data' => Country::getCountrys(),
        'options' => ['placeholder' => 'Select a country ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'c03_id')->widget(Select2::classname(), [
        'data' => States::getStates(),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= isset($modal) ? '' : $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showUpload' => false,
            'initialPreview'=> $model->isNewRecord ? [] : [
                Yii::$app->params['path_user_photo'].$model->a02_photo,
            ],
            'initialPreviewAsData'=>true,
            'initialCaption'=>"The Moon and the Earth",
            'initialPreviewConfig' => [
                ['caption' => $model->a02_photo],
            ],
        ]
    ]) ?>
    <div class="form-group">
        <?= isset($modal) ? Html::button('Guardar ajax', ['class' => 'btn btn-success', 'id'=>'btn-add-perfil'])  : Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
            </div>
            <!-- /.box-body -->
          </div>

