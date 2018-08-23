<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 3/28/2017
 * Time: 3:41 PM
 */
namespace app\api\modules\v1\controllers\actions;
use app\models\Nguoinopthue;
class ViewAction extends \yii\rest\ViewAction
{
    public function run($id)
    {
        $model = Nguoinopthue::find()->where(['or',['id' => $id], ['maSoThue' => $id]])->one();
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }
        return $model;
    }
}