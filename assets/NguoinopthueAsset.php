<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 3/30/2017
 * Time: 4:10 AM
 */

namespace app\assets;


use yii\web\AssetBundle;

class NguoinopthueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/dropdown.css',
        'sbadmin/vendor/metisMenu/metisMenu.min.css',
        'sbadmin/dist/css/sb-admin-2.css',
        'sbadmin/vendor/font-awesome/css/font-awesome.min.css',
        'css/loading.css'
    ];
    public $js = [
        'js/knockout-2.2.1.js',
        'js/enter-to-tab.js',
        'js/dropdown.js',
        'sbadmin/vendor/metisMenu/metisMenu.min.js',
        'sbadmin/vendor/raphael/raphael.min.js',
        'dist/js/sb-admin-2.js',
        'nguoinopthue/save.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}