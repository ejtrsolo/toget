<?php
use common\models\Relacion;
use common\models\Profile;
$this->registerJsFile(Yii::$app->homeUrl.'js/slimScroll/jquery.slimscroll.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<aside class="main-sidebar">

    <section class="sidebar" style="position: fixed; width: 230px;">

        <!-- Sidebar user panel -->
        <div class="user-panel" >
            <div class="pull-left image">
                <img style="height: 45px;" src="<?=Yii::$app->user->isGuest ? '': Yii::$app->params['path_user_photo'].Profile::findOne(['a01_id'=>Yii::$app->user->id])->a02_photo ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->isGuest ? '': Profile::findOne(['a01_id'=>Yii::$app->user->id])->a02_name?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        -->
        <?php
            $amigos = Relacion::getAmigos(Yii::$app->user->id);
            $items[]=['label' => 'Inicio','icon'=>'fa fa-home','url'=>Yii::$app->homeUrl];
            foreach ($amigos as $amigo) {
                $color=$amigo->color;
                $persona=$amigo->persona;
                $template = '<a href="{url}" class="hover" style="background-color: rgb('.$color->c01_r.', '.$color->c01_g.', '.$color->c01_b.');">{icon} <span class="sidebar-mine">{label}</span></a>';
                $items[]=[
                    'label'=>$persona->c08_nombre,
                    'icon' => 'fa fa-user',
                    'url' => '#',
                    'template' => '<a href="{url}" class="sidebar-mine" style="background-color: rgb('.$color->c01_r.', '.$color->c01_g.', '.$color->c01_b.');"><img alt="'.$persona->c08_nombre.'" width="40px" src="'.Yii::$app->params['path_person_photo'].$persona->c08_imagen.'"> {label}<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
                    'items' => [
                        [
                            'label' => 'Noticias', 
                            'icon' => 'fa fa-n', 
                            'url' => ['/noticias/index', 'id'=>$persona->c08_id],
                            'template' => $template,
                        ],
                        [
                            'label' => 'Amigos', 
                            'icon' => 'fa fa-u', 
                            'url' => ['/amigos/index', 'id'=>$persona->c08_id],
                            'template' => $template,
                        ],
                        [
                            'label' => 'Recomendación', 
                            'icon' => 'fa fa-l',    
                            'url' => ['/calendario/create', 'id'=>$persona->c08_id],
                            'template' => $template,
                        ],
                        [
                            'label' => 'Ver calendario', 
                            'icon' => 'fa fa-s', 
                            'url' => ['/calendario/index', 'id'=>$persona->c08_id],
                            'template' => $template,
                        ],
                        [
                            'label' => 'Objetos', 
                            'icon' => 'fa fa-s', 
                            'url' => ['/objetos/index', 'id'=>$persona->c08_id],
                            'template' => $template,
                        ],
                    ]
                ];
            }
            $items[]=[
                        'label' => 'Gestión de permisos',
                        'icon' => 'fa fa-unlock-alt',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Asignación', 'icon' => 'fa fa-tachometer', 'url' => ['/admin/assignment'],],
                            ['label' => 'Rol', 'icon' => 'fa fa-tag', 'url' => ['/admin/role'],],
                            ['label' => 'Permisos', 'icon' => 'fa fa-lock', 'url' => ['/admin/permission'],],
                            ['label' => 'Acciones', 'icon' => 'fa fa-shield', 'url' => ['/admin/route'],],
                        ]
                    ];
            $items[]=[
                        'label' => 'Catálogos',
                        'icon' => 'fa fa-folder',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Colores', 'icon' => 'fa fa-tint', 'url' => ['/colores/index'],],
                            ['label' => 'Mensajes', 'icon' => 'fa fa-commenting', 'url' => ['/mensajes/index'],],
                        ]
                    ];
            $items[]=['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']];
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $items
            ]
        ) ?>

    </section>

</aside>