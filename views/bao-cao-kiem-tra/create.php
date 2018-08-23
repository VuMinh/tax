<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Baocaokiemtra */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhkiemtra app\models\Quyetdinhkiemtra */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */
/* @var $truongdoankiemtra app\models\Truongdoankiemtra */
/* @var $lichsunopsaukiemtra app\models\Lichsunopsaukiemtra */
/* @var $datevalidation app\models\DateValidation */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */
$this->title = Yii::t('app', 'Create Baocaokiemtra');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Baocaokiemtras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaokiemtra-create">

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhkiemtra' => $quyetdinhkiemtra,
        'truongdoankiemtra' => $truongdoankiemtra,
        'quyetdinhxuly' => $quyetdinhxuly,
        'lichsunopsaukiemtra' => $lichsunopsaukiemtra,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
