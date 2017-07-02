<?php

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'css/page.css',
        'js/sweetalert/sweetalert.css',
    ];
    public $js = [
        'js/sweetalert/sweetalert.min.js',
        'js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
