<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 4/2/2017
 * Time: 3:51 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class BaocaobaohiemxahoiAsset extends AssetBundle
{
    public $sourcePath = '@webroot/baocaobaohiemxahoi';
    public $js = [
        'knockout-2.2.1.js',
//        'baocaobaohiemxahoi.js',
        'bcbhxh.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
    ];


}