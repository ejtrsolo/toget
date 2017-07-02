<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'a02_id',
            'a01_id',
            'a02_name',
            'a02_flastname',
            'a02_slastname',
            // 'a02_photo:ntext',
            // 'g02_state',
            // 'g02_country',
            // 'a02_active',
            // 'a02_usercreate',
            // 'a02_datecreate',
            // 'a02_userupdate',
            // 'a02_dateupdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
