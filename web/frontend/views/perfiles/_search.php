<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'a02_id') ?>

    <?= $form->field($model, 'a01_id') ?>

    <?= $form->field($model, 'a02_name') ?>

    <?= $form->field($model, 'a02_flastname') ?>

    <?= $form->field($model, 'a02_slastname') ?>

    <?php // echo $form->field($model, 'a02_photo') ?>

    <?php // echo $form->field($model, 'c03_id') ?>

    <?php // echo $form->field($model, 'c02_id') ?>

    <?php // echo $form->field($model, 'a02_active') ?>

    <?php // echo $form->field($model, 'a02_usercreate') ?>

    <?php // echo $form->field($model, 'a02_datecreate') ?>

    <?php // echo $form->field($model, 'a02_userupdate') ?>

    <?php // echo $form->field($model, 'a02_dateupdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
