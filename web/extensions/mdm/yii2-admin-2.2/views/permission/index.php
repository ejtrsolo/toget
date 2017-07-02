<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */

$this->title = Yii::t('rbac-admin', 'Permisos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <div class="buttonCont">
        <p></p>
        <p style="padding-top: 10px;">
             <a href="<?= Url::toRoute("create") ?>" class="textButtonNew"><label src="" class="fa fa-lock btn-new "></label>
            Crear permiso</a>
       <!--  <?= Html::a(Yii::t('rbac-admin', 'Crear Permisos'), ['create'], ['class' => 'btn btn-success']) ?> -->
        </p>
    </div>

    <?php
    Pjax::begin([
        'enablePushState'=>false,
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Nombre'),
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Descripción'),
            ],
            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]);
    Pjax::end();
    ?>

</div>
