<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 22/3/2017
 * Time: 12:02 AM
 */

namespace app\models;

use  Yii;
class Quyetdinhxuly extends base\Quyetdinhxuly
{

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['soQdXuLy'],'required']
        ]);

    }

    public function fields()
    {
        $dateFormat = function ($model, $attr) {
            return Yii::$app->formatter->asDate($model->$attr, 'dd/MM/yyyy');
        };
        return array_merge(parent::fields(), [
            'ngayQdXuLy' => $dateFormat,
        ]);
    }
}