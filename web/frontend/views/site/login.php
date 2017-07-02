<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::$app->params['title'];

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo" >
        <a href="#" class="title-logo"><?=Yii::$app->params['title_style']?></a>
    </div>
    <!-- /.login-logo -->
    <div class="transparent login-box-body">
        <p class="login-box-msg">Iniciar sesión</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => 'Usuario']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => 'Contraseña']) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>- O -</p>
            <?=Html::a('<i class="fa fa-facebook"></i> Iniciar con Facebook',['auth', 'authclient' => 'facebook'],['class'=>'btn btn-block btn-social btn-facebook btn-flat', 'target'=>'_blank'])?>
            <?=Html::a('<i class="fa fa-google-plus"></i> Iniciar con Google+',['auth', 'authclient' => 'google'],['class'=>'btn btn-block btn-social btn-google-plus btn-flat', 'target'=>'_blank'])?>
<!--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Iniciar con Facebook</a>-->
<!--            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Iniciar con Google+</a>-->
        </div>
        <!-- /.social-auth-links -->

        <a href="<?=\yii\helpers\Url::toRoute(['site/request-password-reset'])?>">Olvide mi contraseña</a><br>
        <a href="<?=\yii\helpers\Url::toRoute(['site/signup'])?>" class="text-center">Registrarme</a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
