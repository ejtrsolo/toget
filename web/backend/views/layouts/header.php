<?php
use yii\helpers\Html;
use common\models\Profile;

/* @var $this \yii\web\View */
/* @var $content string */
Yii::$app->name=Yii::$app->params['title'];
/** @var Profile $profile */
$profile = Profile::findOne(['a01_id'=>Yii::$app->user->id]);
?>

<header class="main-header" style="position: fixed; width: 100%;">

    <?= Html::a('<span class="logo-mini">AA</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="label label-warning">10</span>
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= Yii::$app->user->isGuest ? '' : Yii::$app->params['path_user_photo'].$profile->a02_photo ?>" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= Yii::$app->user->isGuest ? '' : Yii::$app->params['path_user_photo'].$profile->a02_photo ?>" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->user->isGuest ? '': Yii::$app->params['path_user_photo'].$profile->a02_photo ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=Yii::$app->user->isGuest ? '': $profile->a02_name?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <div class="box box-widget widget-user" style="margin-bottom: 0px;">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-green-active">
                                <h3 class="widget-user-username"><?=Yii::$app->user->isGuest ? '':$profile->a02_name?></h3>
                                <h5 class="widget-user-desc"><?=Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->type->g02_descrip?></h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= Yii::$app->user->isGuest ? '' : Yii::$app->params['path_user_photo'].$profile->a02_photo ?>" alt="Imagen de usuario">
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-12 text-center">
                                    <span class="description-text">&nbsp;</span><br>
                                    <h5 class="description-header">Miembro desde el <?=Yii::$app->user->isGuest ? '' : \common\models\Utils::getFormatDateMiembro($profile->a02_datecreate)?></h5>
                                </div>
                            </div>
                        </div>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=\yii\helpers\Url::toRoute(['profile/view'])?>" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Salir',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
            </ul>
        </div>
    </nav>
</header>
