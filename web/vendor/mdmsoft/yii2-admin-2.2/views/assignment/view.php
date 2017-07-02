<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use mdm\admin\AdminAsset;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yii\web\IdentityInterface */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('rbac-admin', 'Asignación') . ' : ' . $userName;;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Asignación'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;
?>
<div class="assignment-index">
  
    <div class="row">
        <div class="col-md-5">
            <label for="" class="control-label"><?= Yii::t('rbac-admin', 'Elementos disponibles') ?>:</label>
            <input id="search-avaliable" class="form-control"><br>
            <select class="form-control"id="list-avaliable" multiple size="20" style="width: 100%">
            </select>
        </div>
        <div class="col-md-2 text-center">
            <br><br><br><br>
            <a href="#" id="btn-assign" class="textButtonEdit"><label for=""  class="fa fa-angle-double-right btn-edit"></label>Asignar</a>
            <div class="visible-md-block visible-lg-block"><br><br></div>
            <a href="#" id="btn-revoke" class="textButtonDelete" style="padding-left: 0px; !important"><label for=""  class="fa fa-angle-double-left btn-delete"></label>Quitar&nbsp;&nbsp;</a>
            <br><br>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="" class="control-label"> <?= Yii::t('rbac-admin', 'Elementos asignados') ?>:</label>
                <input id="search-assigned" class="form-control"><br>
                <select class="form-control"id="list-assigned" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
    </div>
</div>
<?php
AdminAsset::register($this);
$properties = Json::htmlEncode([
        'userId' => $model->{$idField},
        'assignUrl' => Url::to(['assign']),
        'searchUrl' => Url::to(['search']),
    ]);
$js = <<<JS
yii.admin.initProperties({$properties});

$('#search-avaliable').keydown(function () {
    yii.admin.searchAssignmet('avaliable');
});
$('#search-assigned').keydown(function () {
    yii.admin.searchAssignmet('assigned');
});
$('#btn-assign').click(function () {
    yii.admin.assign('assign');
    return false;
});
$('#btn-revoke').click(function () {
    yii.admin.assign('revoke');
    return false;
});

yii.admin.searchAssignmet('avaliable', true);
yii.admin.searchAssignmet('assigned', true);
JS;
$this->registerJs($js);

