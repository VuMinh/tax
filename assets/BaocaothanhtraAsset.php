<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/6/2017
 * Time: 4:51 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class BaocaothanhtraAsset extends AssetBundle
{
    public $sourcePath = '@webroot/baocaothanhtra';
    public $css = [

    ];
    public $js = [
        'knockout-2.2.1.js',
        'baocaothanhtra.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AngularAsset',
    ];
}