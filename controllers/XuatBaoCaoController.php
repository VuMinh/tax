<?php
/**
 * Created by PhpStorm.
 * User: HungNV
 * Date: 29/5/2017
 * Time: 10:18 AM
 */

namespace app\controllers;


use yii\web\Controller;

class XuatBaoCaoController extends Controller
{
    public function actionIndex(){
       return $this->render('index');
    }
}