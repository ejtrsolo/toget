<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */

$this->title = Yii::t('rbac-admin', 'Editar Permisos') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Permisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Editar');
?>
<div class="auth-item-update">

	<!-- <h1><?= Html::encode($this->title) ?></h1> -->
	<?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
