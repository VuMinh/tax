<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\base\SoTheoDoiSauHoanThue */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhttra app\models\Quyetdinhthanhtra */
/* @var $lydohoanthue app\models\Lydohoanthue */
/* @var $vanban app\models\Vanban */
/* @var $quyetdinhxp app\models\Quyetdinhxuphat */
/* @var $quyetdinhth app\models\Quyetdinhthuhoihoanthue */
/* @var $quyetdinhkt app\models\Quyetdinhkiemtra */
/* @var $lichsunophoanthue app\models\Lichsunopquyhoanthue */
$this->title = Yii::t('app', 'Create SoTheoDoiSauHoanThue');
$this->params['breadcrumbs'][] = ['label' => 'Sotheodoisauhoanthues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="so-theo-doi-sau-hoan-thue-create">

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