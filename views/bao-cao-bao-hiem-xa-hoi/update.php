<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaobaohiemxahoi */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */
/* @var $baocaobaohiemxahoitheonamModel app\models\Baocaobaohiemxahoitheonam */
/* @var $datevalidation app\models\Baocaobaohiemxahoitheonam */

$this->title = 'Update Baocaobaohiemxahoi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baocaobaohiemxahois', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="baocaobaohiemxahoi-update">

    <h1>Cập nhật BC BHXH</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhxuly' => $quyetdinhxuly,
        'baocaobaohiemxahoitheonamModel' => $baocaobaohiemxahoitheonamModel,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
