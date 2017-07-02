<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 28/10/2016
 * Time: 09:16 PM
 */
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $modelsc frontend\models\FormStateCountry */
/* @var $form_file_upload \common\models\FromFileUpload */
/* @var $modelcp frontend\models\FormChangePassword */
/* @var $modeluser \common\models\User */

$this->title = 'Mi perfil - '.$model->a02_name;
//$this->params['breadcrumbs'][] = $this->title;
$this->blocks['content-header']='';
?>
<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" style="width: 100px; height: 100px;" src="<?=Yii::$app->params['path_user_photo'].$model->a02_photo?>" alt="User profile picture">

                <h3 id="complete_name" class="profile-username text-center"><?=$model->a02_name.' '.$model->a02_flastname?></h3>

                <p id="location" class="text-muted text-center"><?=$modelsc->state.', '.$modelsc->country.'.'?></p>

                <a href="#" class="btn btn-primary btn-flat btn-block" data-toggle="modal" data-target="#change_photo">
                    <b>Cambiar foto</b>
                </a>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <!--<li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Actividad</a></li>
                <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Linea del tiempo</a></li>-->
                <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Editar perfil</a></li>
                <li><a href="#change" data-toggle="tab" aria-expanded="false">Cambiar contraseña</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?=Yii::$app->params['path_user_photo'].'default.png'?>" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.
                        </p>
                        <ul class="list-inline">
                            <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                            </li>
                            <li class="pull-right">
                                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                    (5)</a></li>
                        </ul>

                        <input class="form-control input-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-envelope bg-blue"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Read more</a>
                                    <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-user bg-aqua"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="settings">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-profile',
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'options'=>['onsubmit'=>'return false;'],
                        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
                    ]); ?>

                        <input type="hidden" id="url-profile" value="<?=Url::toRoute(['profile/save-profile'])?>">

                        <span class="title-section">DATOS DE USUARIO</span>
                        <hr class="hr-mine">
                        <?=$form->field($modeluser, 'username')->textInput(['readonly'=>true])?>
                        <?=$form->field($modeluser, 'email')->textInput(['placeholder'=>'Email'])?>
                        <span class="title-section">DATOS PERSONALES</span>
                        <hr class="hr-mine">
                        <?=$form->field($model, 'a02_name')->textInput(['placeholder'=>'Nombre'])?>
                        <?=$form->field($model, 'a02_flastname')->textInput(['placeholder'=>'Apellido paterno'])?>
                        <?=$form->field($model, 'a02_slastname')->textInput(['placeholder'=>'Apellido materno'])?>
                        <?=$form->field($modelsc, 'country')->widget(\kartik\widgets\TypeaheadBasic::className(),[
                            'data' => \frontend\models\Country::getCountrysOnly(),
                            'options' => ['placeholder' => 'País'],
                            'pluginOptions' => ['highlight'=>true],
                        ])?>
                        <?=$form->field($modelsc, 'state')->widget(\kartik\widgets\TypeaheadBasic::className(),[
                            'data' => \frontend\models\States::getStatesOnly(),
                            'options' => ['placeholder' => 'Estado'],
                            'pluginOptions' => ['highlight'=>true],
                        ])?>
                        <?=$form->field($model, 'a02_id')->hiddenInput()->label(false)?>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <button type="reset" class="btn btn-default btn-flat">Reestablecer</button>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" id="btn-save-profile" class="btn btn-success btn-flat pull-right" value="Guardar cambios">
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>

                <div class="tab-pane" id="change">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-password',
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'options'=>['onsubmit'=>'return false;'],
                        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
                    ]); ?>
                    <input type="hidden" id="url-password" value="<?=Url::toRoute(['profile/save-password'])?>">
                    <span class="title-section">CAMBIO DE CONTRASEÑA</span>
                    <hr class="hr-mine">
                    <?=$form->field($modelcp, 'old_password')->passwordInput(['placeholder' => '*****************'])?>

                    <?=$form->field($modelcp, 'new_password')->passwordInput(['placeholder' => 'Nueva contraseña'])?>

                    <?=$form->field($modelcp, 'repeat_password')->passwordInput(['placeholder' => 'Repetir contraseña'])?>

                    <?=$form->field($modelcp, 'id')->hiddenInput()->label(false)?>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <button type="reset" class="btn btn-default btn-flat">Reestablecer</button>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" id="btn-save-password" class="btn btn-success btn-flat pull-right" value="Guardar cambios">
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
</div>
<?php
Modal::begin([
    'header'=>'<h4>Cambiar foto</h4>',
    'id'=>'change_photo',
    'size'=>'modal-lg',
]);
echo "<div id='modalContent'>";
echo $this->render('_photo', ['model'=>$form_file_upload]);
echo "</div>";
Modal::end();

$this->registerJsFile(Yii::getAlias('@web').'/js/my-profile.js', ['depends' => [yii\web\JqueryAsset::className()]]);