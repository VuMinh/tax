<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/5/2017
 * Time: 5:21 PM
 */

namespace app\models;

use Yii;

class Quyetdinhtruythu extends base\Quyetdinhtruythu
{

    public function fields()
    {
        $dateFormat = function ($model, $attr) {
            return $model->$attr ? Yii::$app->formatter->asDate($model->$attr, 'dd/MM/yyyy') : null;
            return Yii::$app->formatter->asDate($model->$attr, 'dd/MM/yyyy');
        };
        return array_merge(parent::fields(), [
            'ngayQdTruyThu' => $dateFormat,
        ]);
    }
}
