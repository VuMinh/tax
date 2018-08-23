<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/9/2017
 * Time: 12:25 AM
 */

namespace app\models;

use Yii;

class Quyetdinhthanhtra extends base\Quyetdinhthanhtra
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['soQdThanhTra'],'required']
        ]);

    }

    public function fields()
    {
        $dateFormat = function ($model, $attr) {
            return $model->$attr ? Yii::$app->formatter->asDate($model->$attr, 'dd/MM/yyyy') : null;
        };

        return array_merge(parent::fields(), [
            'ngayQdThanhTra' => $dateFormat,
        ]);
    }
}