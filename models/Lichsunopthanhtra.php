<?php

namespace app\models;

use Yii;

class Lichsunopthanhtra extends base\Lichsunopthanhtra
{
    public function fields()
    {

        $intFormat = function ($model, $attr) {
            return $model->$attr ? explode('.',$model->$attr)[0] : '';
        };

        return array_merge(parent::fields(), [
            'daNopThue' => $intFormat,
        ]);
    }
}
