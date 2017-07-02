<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\User;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\widgets\Select2;
use frontend\models\Profile;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
//$this->registerJsFile(Yii::getAlias('@web').'/js/perfiles_index.js', ['depends'=>[yii\web\JqueryAsset::className()]]);
?>
<div class="profile-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?php Pjax::begin(['id'=>'grid_perfiles']); ?>
        <div class="box box-success" id="box-perfiles">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de perfiles</h3>
            
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <p>
        <?= Html::button('Crear perfil ajax', ['class' => 'btn btn-success pull-right', 'id'=>'btn-modal']) ?>
        <?= Html::a('Crear perfil', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'a02_id',
            [
                'attribute'=>'a01_id',
                'format' => 'raw',
                'filter' => Select2::widget([
                    'model'=>$searchModel,
                    'attribute' => 'a01_id',
                    'data' => User::getUsuarios2(),
                    'options' => ['placeholder' => 'Select a user ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                'value' => function ($model){
                    $user = $model->user;
                    return $user->username;
                }
            ],
            //'user.username',
            //'a01_id',
            'a02_name',
            'a02_flastname',
            'a02_slastname',
            // 'a02_photo:ntext',
            // 'c03_id',
            // 'c02_id',
            // 'a02_active',
            // 'a02_usercreate',
            // 'a02_datecreate',
            // 'a02_userupdate',
            // 'a02_dateupdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
            </div>
            <!-- /.box-body -->
          </div>
   
</div>
    <?php Pjax::end(); ?>
<input type="hidden" id="url-guardar-perfil" value="<?=Url::toRoute(['perfiles/guardar-ajax'])?>">
<?php 
        Modal::begin([
            'header'=>'<h4>Agregar perfil</h4>',
            'id'=>'add_perfil',
            //'size'=>'modal-lg',
         ]);

        echo "<div id='modalContent'>";
        $model = new Profile();
        echo $this->render('_form', [
            'model'=>$model,
            'modal'=>true,
        ]);
        echo "</div>";
        Modal::end();

$script = "
    $('body').on('click', '#btn-modal', function(e){
        $('#add_perfil').modal('show');
    });
    $('#btn-add-perfil').click(function(e){
        var refresh = '<div id=\"refresh-simbolo\" class=\"overlay\"><i class=\"fa fa-refresh fa-spin\"></i></div>';
        var form = $('#form_perfil');
        var url = $('#url-guardar-perfil').val();
        $('#box-perfiles').append(refresh);
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            dataType: 'JSON',
            success: function (respuesta){
                if(!respuesta.error){
                    //Actualizar el contenido del grid
                    $('#add_perfil').modal('hide');
                    $.pjax.reload({container: '#grid_perfiles'});
                }else{
                    alert(respuesta.mensaje);
                }
            },
            error: function (a, b, c){
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });
";
$this->registerJs($script);