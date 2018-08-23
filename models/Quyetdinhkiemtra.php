<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 22/3/2017
 * Time: 12:07 AM
 */

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Quyetdinhkiemtra extends base\Quyetdinhkiemtra
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['soQdKiemTra'],'required']
        ]);

    }

    public function fields()
    {
        $dateFormat = function ($model, $attr) {
            return $model->$attr ? Yii::$app->formatter->asDate($model->$attr, 'dd/MM/yyyy') : null;
        };
        return array_merge(parent::fields(), [
            'ngayQdKiemTra' => $dateFormat,
            'ngayCongBoQdkt' => $dateFormat,
            'ngayTrinhVbTamDungKt' => $dateFormat,
        ]);
    }

}