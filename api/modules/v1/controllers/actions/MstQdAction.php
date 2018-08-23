<?php

namespace app\api\modules\v1\controllers\actions;

use app\models\Nguoinopthue;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;

class MstQdAction extends \yii\rest\ViewAction
{
    public function run($mstQd)
    {
        /* @var $modelClass ActiveRecordInterface */
        $modelClass = $this->modelClass;
        $keys = ['mst', 'soQdxlId'];

        $values = explode(',', $mstQd);
        if (count($keys) === count($values)) {
            $model = $modelClass::findAll(array_combine($keys, $values));
        } else {
            throw new NotFoundHttpException("Object not found: $mstQd");
        }
        if(!$model) {
            $model = [];
        }

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }
        return $model;
    }
}