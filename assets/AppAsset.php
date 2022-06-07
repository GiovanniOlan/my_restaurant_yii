<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        // Main Template
        'template/main/css/nucleo-icons.css',
        'template/main/css/black-dashboard.css',
        'template/main/css/black-dashboard.min.css.map', //Nuevo
        'template/main/css/black-dashboard.min.css', //Nuevo
        'template/main/demo/demo.css',
        'https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800',
        'https://use.fontawesome.com/releases/v5.0.6/css/all.css',
    ];
    public $js = [
        // Main Template
        //'template/main/js/core/jquery.min.js',
        'template/main/js/core/popper.min.js',
        'template/main/js/core/bootstrap.min.js',
        'template/main/js/plugins/perfect-scrollbar.jquery.min.js',
        'template/main/js/plugins/bootstrap-notify.js',
        'template/main/js/black-dashboard.min.js?v=1.0.0',
        //'template/main/demo/demo.js',
        'https://cdn.trackjs.com/agent/v3/latest/t.js',
        // 'template/main/',
        // 'template/main/',
        // 'template/main/',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
