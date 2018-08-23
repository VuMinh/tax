<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaokiemtra */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhkiemtra app\models\Quyetdinhkiemtra */
/* @var $truongdoankiemtra app\models\Truongdoankiemtra */
/* @var $lichsunopsaukiemtra app\models\Lichsunopsaukiemtra */
/* @var $datevalidation app\models\DateValidation */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */

$this->title = Yii::t('app', 'Cập nhật báo cáo kiểm tra: ') . $quyetdinhkiemtra->soQdKiemTra;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Baocaokiemtras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="baocaokiemtra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhkiemtra' => $quyetdinhkiemtra,
        'quyetdinhxuly' => $quyetdinhxuly,
        'truongdoankiemtra' => $truongdoankiemtra,
        'lichsunopsaukiemtra' => $lichsunopsaukiemtra,
        'datevalidation' => $datevalidation
    ]) ?>

</div>

<?php
return $this->registerJsFile('@web/baocaokiemtra/display_bao_cao_kiem_tra.js', ['depends' => [\app\assets\AppAsset::className()]]);
?>
