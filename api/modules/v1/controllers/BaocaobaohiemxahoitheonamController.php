<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Huy Hoang
 * Date: 4/14/2017
 * Time: 3:38 PM
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\controllers\actions\MstQdAction;

class BaocaobaohiemxahoitheonamController extends AuthenticationController
{
    public $modelClass = 'app\models\Baocaobaohiemxahoitheonam';
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['mst-qd'] = [
            'class' => MstQdAction::className(),
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess']
        ];
        return $actions;
    }

}