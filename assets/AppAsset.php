<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'sbadmin/vendor/metisMenu/metisMenu.min.css',
        'sbadmin/dist/css/sb-admin-2.css',
        'sbadmin/vendor/font-awesome/css/font-awesome.min.css',
        'css/dropdown.css',
    ];
    public $js = [
        'sbadmin/vendor/metisMenu/metisMenu.min.js',
        'sbadmin/vendor/raphael/raphael.min.js',
        'sbadmin/dist/js/sb-admin-2.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
