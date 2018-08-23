<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 4/6/2017
 * Time: 4:28 PM
 */

namespace app\assets;

use yii\web\AssetBundle;

class DanhsachhoadonviphamAsset extends AssetBundle
{
    public $sourcePath = '@webroot/danhsachhoadonvipham';
    public $js = [
        'knockout-2.2.1.js',
        'danhsachhoadonvipham.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}