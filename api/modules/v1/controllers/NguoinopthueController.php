<?php

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\controllers\actions\ViewAction;
class NguoinopthueController extends AuthenticationController
{
    public $modelClass = 'app\models\Nguoinopthue';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['view'] = [
            'class' => ViewAction::className(),
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess']
        ];
        return $actions;
    }
}
