<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\AdminAsset;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Permisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

 <!--    <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <a href="<?= Url::toRoute(['update', 'id' => $model->name]) ?>" class="textButtonEdit"><label src="" class="fa fa-pencil btn-edit"></label>
                Editar</a>


       <!--  <?= Html::a(Yii::t('rbac-admin', 'Editar'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?> -->
        
        <a href="<?= Url::toRoute(['delete', 'id' => $model->name]) ?>" class="textButtonDelete" data-confirm="¿Esta seguro de borrar el permiso?" data-method="post"><label src="" class="fa fa-trash fa-lg btn-delete "></label>
        Borrar</a>


       <!--  <?php
       echo Html::a(Yii::t('rbac-admin', 'Borrar'), ['delete', 'id' => $model->name], [
           'class' => 'textButtonEdit',
           'data-confirm' => Yii::t('rbac-admin', 'Esta seguro de borrar el permiso?'),
           'data-method' => 'post',
       ]);
       ?>
        -->
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            'ruleName',
            'data:ntext',
        ],
    ]);
    ?>
    <div class="row">
        <div class="col-md-5">
            <label class="control-label"><?= Yii::t('rbac-admin', 'Elementos disponibles') ?>:</label>
            <input id="search-avaliable" class="form-control"><br>
            <select class="form-control" id="list-avaliable" multiple size="20" style="width: 100%">
            </select>
        </div>
        <div class="col-md-2 text-center">
            <br>
            <a href="#" id="btn-add" class="btn textButtonEdit"><label for=""  class="fa fa-angle-double-right btn-edit"></label>Asignar</a>
            <div class="visible-md-block visible-lg-block"><br><br></div>
            <a href="#" id="btn-remove" class="btn textButtonDelete" style="padding-left: 0px; !important"><label for=""  class="fa fa-angle-double-left btn-delete"></label>Quitar&nbsp;&nbsp;</a>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="" class="control-label"><?= Yii::t('rbac-admin', 'Elementos asignados') ?>:</label>
                <input id="search-assigned" class="form-control"><br>
                <select id="list-assigned" class="form-control" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
    </div>

</div>
<?php
AdminAsset::register($this);
$properties = Json::htmlEncode([
        'roleName' => $model->name,
        'assignUrl' => Url::to(['assign']),
        'searchUrl' => Url::to(['search']),
    ]);
$js = <<<JS
yii.admin.initProperties({$properties});

$('#search-avaliable').keydown(function () {
    yii.admin.searchRole('avaliable');
});
$('#search-assigned').keydown(function () {
    yii.admin.searchRole('assigned');
});
$('#btn-add').click(function () {
    yii.admin.addChild('assign');
    return false;
});
$('#btn-remove').click(function () {
    yii.admin.addChild('remove');
    return false;
});

yii.admin.searchRole('avaliable', true);
yii.admin.searchRole('assigned', true);
JS;
$this->registerJs($js);

