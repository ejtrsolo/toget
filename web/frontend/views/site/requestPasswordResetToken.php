<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\widgets\Alert;
$this->title = 'Restablecer contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#" class="title-logo"><?=Yii::$app->params['title_style']?></a>
    </div>
    <div class="login-logo"></div>
    <!-- /.login-logo -->
    <div class="transparent login-box-body">
        <?= Alert::widget() ?>
        <p class="login-box-msg"><?= Html::encode($this->title) ?></p>
        <p>Por favor ingresa tu email. Se enviará un link para restablecer tu contraseña.</p>

        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <div class="form-group">
                    <?= Html::a('Regresar', ['site/login'],['class' => 'btn btn-success', 'name' => 'back-button']) ?>
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary pull-right']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
