<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\AdminAsset;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        

        <?= Html::a('<label src="" class="fa fa-pencil fa-lg btn-edit "></label>'.Yii::t('rbac-admin', 'Editar'), ['update', 'id' => $model->name], ['class' => 'textButtonEdit']) ?>
        <?php
        echo Html::a('<label src="" class="fa fa-trash fa-lg btn-VerElim "></label>'.Yii::t('rbac-admin', ' Borrar'), ['delete', 'id' => $model->name], [
            'class' => 'textButtonElim',
            'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]);
        ?>
    </p>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            
        ],
    ]);
    ?>
    <div class="row">
        <div class="col-md-5">
            <label class="control-label"><?= Yii::t('rbac-admin', 'Elementos disponibles') ?>:</label>
            <input id="search-avaliable" class="form-control"><br>
            <select id="list-avaliable" class="form-control" multiple size="20" style="width: 100%">
            </select>
        </div>
        <div class="col-md-2 text-center">
            <br>
            <a href="#" id="btn-add" class="textButtonEdit"><label for=""  class="fa fa-angle-double-right btn-edit"></label> Asignar</a>
            <div class="visible-md-block visible-lg-block"><br><br></div>
            <a href="#" id="btn-remove" class="textButtonDelete" style="padding-left: 0px; !important"><label for=""  class="fa fa-angle-double-left btn-delete"></label>Quitar&nbsp;&nbsp;</a><br><br>
       
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label class="control-label"><?= Yii::t('rbac-admin', 'Elementos asignados') ?>:</label>
                <input id="search-assigned" class="form-control"><br>
                <select id="list-assigned" class="form-control" multiple size="20" style="width: 100%">
                </select>
            </div>
        </div>
    </div>
</div>
<?php
$this->render('_script', ['name' => $model->name]);

AdminAsset::register($this);
$properties = Json::htmlEncode([
        'roleName' => $model->name,
        'assignUrl' => Url::to(['assign']),
        'searchUrl' => Url::to(['search']),
    ]);
$js = <<<JS
yii.admin.initProperties({$properties});

$('#search-avaliable').keydown(function () {
    yii.admin.searchRole2('avaliable');
});
$('#search-assigned').keydown(function () {
    yii.admin.searchRole2('assigned');
});
$('#btn-add').click(function () {
    yii.admin.addChild2('assign');
    return false;
});
$('#btn-remove').click(function () {
    yii.admin.addChild2('remove');
    return false;
});

yii.admin.searchRole2('avaliable', true);
yii.admin.searchRole2('assigned', true);
JS;
$this->registerJs($js);

