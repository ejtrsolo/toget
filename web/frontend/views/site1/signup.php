<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/* @var $modelprofile \common\models\Profile */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use common\models\Option;
use common\models\Profile;

$this->title = 'Registrarme';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#" class="title-logo"><?=Yii::$app->params['title_style']?></a>
    </div>
    <div class="login-logo"></div>
    <!-- /.login-logo -->
    <div class="transparent login-box-body">
        <p class="login-box-msg"><?= Html::encode($this->title) ?></p>
        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'options'=>['enctype' => 'multipart/form-data'],
        ]); ?>
        <div class="social-auth-links text-center">
            <?=Html::a('<i class="fa fa-facebook"></i> Registrarme con Facebook',['auth', 'authclient' => 'facebook'],['class'=>'btn btn-block btn-social btn-facebook btn-flat', 'target'=>'_blank'])?>
            <?=Html::a('<i class="fa fa-google-plus"></i> Registrarme con Google+',['auth', 'authclient' => 'google'],['class'=>'btn btn-block btn-social btn-google-plus btn-flat', 'target'=>'_blank'])?>
        </div>
        <p>Datos de usuario</p>
        <hr style="margin-top: 0px; margin-bottom: 20px;">

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <p>Datos personales</p>
        <hr style="margin-top: 0px; margin-bottom: 20px;">

        <?= $form->field($modelprofile, 'a02_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelprofile, 'a02_flastname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelprofile, 'a02_slastname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelprofile, 'file')->widget(FileInput::classname(), [
            'options' => ['multiple'=>false, 'accept' => 'image/*'],
            'pluginOptions' => [
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  'Seleccionar foto'
            ],
        ]) ?>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
        </div>
        <div class="form-group pull-right" style="margin-top: 24px">
            <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
        </div>
        <div class="form-group" style="margin-top: 40px">
            <?= Html::a('Regresar', ['site/login'],['class' => 'btn btn-success btn-flat', 'name' => 'back-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
