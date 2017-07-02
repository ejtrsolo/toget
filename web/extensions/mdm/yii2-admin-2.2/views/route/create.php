<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\Route $model
 * @var ActiveForm $form
 */

$this->title = Yii::t('rbac-admin', 'Crear Acciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Acciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <h1><?= Yii::t('rbac-admin', 'Crear Acciones') ?></h1> -->
<div class="panel panel-primary">
    <div class="panel-heading">Datos de las acciones</div>
    <div class="panel-body">
	<div class="create">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'route') ?>

		<div class="form-group">
			<?= Html::submitButton('<label type="submit" class="fa fa-check btn-guardar"></label>'.Yii::t('rbac-admin', 'Guardar'), ['class' => 'textButtonguardar']) ?>
		</div>
	<?php ActiveForm::end(); ?>

	</div>
	</div>
</div><!-- create -->
