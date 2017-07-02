<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use mdm\admin\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel panel-primary">
    <div class="panel-heading">Datos del permiso</div>
    <div class="panel-body">
    <div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
           <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?> 
        </div>
        <div class="col-md-6">
           <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
           <?= $form->field($model, 'ruleName')->textInput(['id'=>'rule-name']) ?> 
        </div>
        <div class="col-md-6"> 
           <?= $form->field($model, 'data')->textarea(['rows' => 1]) ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo Html::submitButton('<label type="submit" class="fa fa-check btn-guardar"></label>'.($model->isNewRecord ? Yii::t('rbac-admin', 'Guardar') : Yii::t('rbac-admin', 'Guardar cambios')), [
                    'class' => $model->isNewRecord ? 'textButtonguardar' : 'textButtonguardar']);
                ?>
            </div>
        </div>
    </div>    

    <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
<?php
AutocompleteAsset::register($this);

$options = Json::htmlEncode([
    'source' => array_keys(Yii::$app->authManager->getRules())
]);
$this->registerJs("$('#rule-name').autocomplete($options);");