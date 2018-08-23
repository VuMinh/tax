<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 22/3/2017
 * Time: 12:07 AM
 */

namespace app\models;


class Nguoinopthue extends base\Nguoinopthue
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['maSoThue'],'required']
        ]);

    }
}