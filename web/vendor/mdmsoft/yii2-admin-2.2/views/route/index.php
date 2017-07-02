<?php

use yii\helpers\Html;
use mdm\admin\AdminAsset;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 */
$this->title = Yii::t('rbac-admin', 'Acciones');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="buttonCont">
        <p></p>
        <p style="padding-top: 10px;">
            <a href="<?= Url::toRoute("create") ?>" class="textButtonNew"><label src="" class="fa fa-shield btn-new "></label> Crear acciones</a>
            <br><br>
        </p>
    </div>

<div>
    <div class="row">
        <div class="col-md-5">
            <div  class="form-group">  
                <label class="control-label"><?= Yii::t('rbac-admin', 'Elementos disponibles') ?>:</label>
                <input id="search-avaliable" class="form-control">
                <a href="#" id="btn-refresh"><span class="glyphicon glyphicon-refresh"></span></a><br>
                <select id="list-avaliable" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
        <div class="col-md-2 text-center">
            <br><br>
            <a href="#" id="btn-add" class="textButtonEdit"><label for=""  class="fa fa-angle-double-right btn-edit"></label> Asignar</a>
            <div class="visible-md-block visible-lg-block"><br><br></div>
            <a href="#" id="btn-remove" class="textButtonDelete" style="padding-left: 0px; !important"><label for=""  class="fa fa-angle-double-left btn-delete"></label>Quitar&nbsp;&nbsp;</a>
           <br><br>
           <!--  <a href="#" id="btn-add" class="btn btn-success">&gt;&gt;</a><br>
           <a href="#" id="btn-remove" class="btn btn-danger">&lt;&lt;</a> -->
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="control-label"><?= Yii::t('rbac-admin', 'Elementos asignados') ?>:</label>
                <input id="search-assigned" class="form-control"><br>
                <select id="list-assigned" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
    </div>
</div>
<?php
AdminAsset::register($this);
$properties = Json::htmlEncode([
        'assignUrl' => Url::to(['assign']),
        'searchUrl' => Url::to(['search']),
    ]);
$js = <<<JS
yii.admin.initProperties({$properties});

$('#search-avaliable').keydown(function () {
    yii.admin.searchRoute('avaliable');
});
$('#search-assigned').keydown(function () {
    yii.admin.searchRoute('assigned');
});
$('#btn-add').click(function () {
    yii.admin.assignRoute('assign');
    return false;
});
$('#btn-remove').click(function () {
    yii.admin.assignRoute('remove');
    return false;
});
$('#btn-refresh').click(function () {
    yii.admin.searchRoute('avaliable',1);
    return false;
});

yii.admin.searchRoute('avaliable', 0, true);
yii.admin.searchRoute('assigned', 0, true);
JS;
$this->registerJs($js);

