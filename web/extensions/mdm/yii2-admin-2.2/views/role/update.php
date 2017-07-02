<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 */
$this->title = Yii::t('rbac-admin', 'Editar Rol').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Roles'), 'url' => ['index']];
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
