<?php

namespace app\models;

class Ketquakttaitrusonnt extends \app\models\base\Ketquakttaitrusonnt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['soQdkt'],'required']
        ]);
    }
}
