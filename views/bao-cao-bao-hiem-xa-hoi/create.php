<?php

use yii\helpers\Html;
use app\models\Baocaobaohiemxahoi;
use app\controllers\BaocaobaobaohiemxahoiController;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaobaohiemxahoi */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */
/* @var $baocaobaohiemxahoitheonamModel app\models\Baocaobaohiemxahoitheonam */
/* @var $datevalidation app\models\Baocaobaohiemxahoitheonam */

$this->title = Yii::t('app', 'Create Baocaobaohiemxahoi');
$this->params['breadcrumbs'][] = ['label' => 'Baocaobaohiemxahois', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaobaohiemxahoi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhxuly' => $quyetdinhxuly,
        'baocaobaohiemxahoitheonamModel' => $baocaobaohiemxahoitheonamModel,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
