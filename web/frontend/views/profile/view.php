<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->a02_id;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->a02_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->a02_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'g02_state',
            'g02_country',
            'a02_active',
            'a02_usercreate',
            'a02_datecreate',
            'a02_userupdate',
            'a02_dateupdate',
        ],
    ]) ?>

</div>
