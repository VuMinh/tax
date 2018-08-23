<?php

namespace app\models;

use Yii;

class Baocaothanhtra extends base\Baocaothanhtra
{
    public function fields()
    {

        $intFormat = function ($model, $attr) {
            return $model->$attr ? explode('.',$model->$attr)[0] : '';
        };

        return array_merge(parent::fields(), [
            'vatTruyThu' => $intFormat,
            'tndn' => $intFormat,
            'ttdb' => $intFormat,
            'tncn' => $intFormat,
            'monBai' => $intFormat,
            'tienPhat1020' => $intFormat,
            'tienPhat005' => $intFormat,
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLichsunopthanhtraOrder()
    {
        return $this->hasMany(Lichsunopthanhtra::className(), ['soQdThanhTra' => 'id'])->orderBy('ngayNop DESC')->one();
    }
//    public function getLichsunopthanhtras()
//    {
//        return $this->hasOne(Lichsunopthanhtra::className(), ['soQdThanhTra' => 'id'])->orderBy(['ngayNop' => SORT_DESC]);
//    }
}
