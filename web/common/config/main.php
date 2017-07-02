<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'language'=>'es',
	'timezone'=>'America/Mexico_City',
	'aliases' => [
		'@mdm/admin' => '@app/extensions/mdm/yii2-admin-2.2',
		//'@mdm/admin' => '@app/vendor/mdmsoft/yii2-admin-2.2',
		//'@mdm/admin' => '@app/vendor/mdm/yii2-admin-2.7',
		// for example: '@mdm/admin' => '@app/extensions/mdm/yii2-admin-2.0.0',
	],
	'modules' => [
		'gridview' =>  [
			'class' => '\kartik\grid\Module',
			// enter optional module parameters below - only if you need to
			// use your own export download action or custom translation
			// message source
			'downloadAction' => 'gridview/export/download',
			// 'i18n' => []
		],
		'admin' => [
			'class' => 'mdm\admin\Module',

			//'layout' => 'left-menu',
			'mainLayout' => '@app/views/layouts/main.php',

			'controllerMap' => [
				'assignment' => [
					'class' => 'mdm\admin\controllers\AssignmentController',
					'userClassName' => 'app\models\Users',
					'idField' => 'id',
					'usernameField' => 'username',
					'fullnameField' => 'profile.a02_name',
					'extraColumns' => [
					],
				],
			],
		],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'authClientCollection' => [
			'class' => 'yii\authclient\Collection',
			'clients' => [
				'facebook' => [
					'class' => 'yii\authclient\clients\Facebook',
					'clientId' => '1761999924078204',
					'clientSecret' => '4dbc2e251619f650045b316bb3bcae6a',
				],
				'google' => [
					'class' => 'yii\authclient\clients\Google',
					'clientId' => '688192315683-9s2afo428r96ac86hhhlb4olpu0085ig.apps.googleusercontent.com',
					'clientSecret' => 'jniSh6i6AteuzzlOlxUxE80p',
				],
			],
		],
		'authManager' => [
			//'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
			'class' => 'yii\rbac\DbManager'
		],
        /*
        'view' => [
	        'theme' => [
	            'pathMap' => [
	               '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
	            ],
	        ],
	    ],
	    */
	    'assetManager' => [
	        'bundles' => [
	            'dmstr\web\AdminLteAsset' => [
	                'skin' => "skin-green",
	            ],
	        ],
	    ],
    ],
	'as access' => [
		//'class' => 'mdm\admin\classes\AccessControl',
		'class' => 'mdm\admin\components\AccessControl',
		'allowActions' => [
			'site/*',
			'profile/*',
			'admin/*',
			'gii/*',
			'debug/*',
			'colores/*',
			'colores2/*',
			'mensajes/*',
			'amigos/*',
			'noticias/*',
			'calendario/*',
			'objetos/*',
			'some-controller/some-action',
			// The actions listed here will be allowed to everyone including guests.
			// So, 'admin/*' should not appear here in the production, of course.
			// But in the earlier stages of your development, you may probably want to
			// add a lot of actions here until you finally completed setting up rbac,
			// otherwise you may not even take a first step.
		]
	],
];
