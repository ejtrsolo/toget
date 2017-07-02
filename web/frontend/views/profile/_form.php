<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'a01_id')->textInput() ?>

    <?= $form->field($model, 'a02_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a02_flastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a02_slastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a02_photo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'g02_state')->textInput() ?>

    <?= $form->field($model, 'g02_country')->textInput() ?>

    <?= $form->field($model, 'a02_active')->textInput() ?>

    <?= $form->field($model, 'a02_usercreate')->textInput() ?>

    <?= $form->field($model, 'a02_datecreate')->textInput() ?>

    <?= $form->field($model, 'a02_userupdate')->textInput() ?>

    <?= $form->field($model, 'a02_dateupdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
