<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sotheodoisauhoanthue */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhttra app\models\Quyetdinhthanhtra */
/* @var $lydohoanthue app\models\Lydohoanthue */
/* @var $vanban app\models\Vanban */
/* @var $quyetdinhxp app\models\Quyetdinhxuphat */
/* @var $quyetdinhth app\models\Quyetdinhthuhoihoanthue */
/* @var $quyetdinhkt app\models\Quyetdinhkiemtra */
/* @var $lichsunophoanthue app\models\Lichsunopquyhoanthue */
/* @var $datevalidation app\models\DateValidation */

$this->title = Yii::t('app', 'Cập nhật sổ theo dõi sau hoàn thuế: ', [
    ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sotheodoisauhoanthues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="so-theo-doi-sau-hoan-thue-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhttra' => $quyetdinhttra,
        'vanban' => $vanban,
        'quyetdinhxp' => $quyetdinhxp,
        'quyetdinhth' => $quyetdinhth,
        'quyetdinhkt' => $quyetdinhkt,
        'lichsunophoanthue' => $lichsunophoanthue,
        'datevalidation' => $datevalidation,
    ]) ?>

</div>
