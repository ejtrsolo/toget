<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */

$this->title = $model->a02_id;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->a02_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->a02_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro que quieres borrar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'a02_id',
            'a01_id',
            'a02_name',
            'a02_flastname',
            'a02_slastname',
            'a02_photo:ntext',
            'c03_id',
            'c02_id',
            'a02_status',
            'a02_usercreate',
            'a02_datecreate',
            'a02_userupdate',
            'a02_dateupdate',
        ],
    ]) ?>

</div>
