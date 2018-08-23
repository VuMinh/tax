<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaothanhtra */
/* @var $quyetdinhtruythu app\models\Quyetdinhtruythu */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhttra app\models\Quyetdinhthanhtra */
/* @var $lichsunopthanhtra app\models\Lichsunopthanhtra */

$this->title = Yii::t('app', 'Update Baocaothanhtra'). $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baocaothanhtras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="baocaothanhtra-update">

    <h1>Cập nhật báo cáo nợ thanh tra</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'quyetdinhtruythu' => $quyetdinhtruythu,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhttra' => $quyetdinhttra,
        'lichsunopthanhtra' => $lichsunopthanhtra,
    ]) ?>

</div>
