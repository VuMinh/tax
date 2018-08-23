<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LydoxulychamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lydoxulycham-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mst') ?>

    <?= $form->field($model, 'soQdktId') ?>

    <?= $form->field($model, 'ngayBc') ?>

    <?= $form->field($model, 'vuongMacChinhSach') ?>

    <?php // echo $form->field($model, 'chuaThongNhatSoLieuGiaiTrinhCham') ?>

    <?php // echo $form->field($model, 'dvCoCongVanXinTamLui') ?>

    <?php // echo $form->field($model, 'doiChieuSoLieuVoiCucThue') ?>

    <?php // echo $form->field($model, 'chuyenHsSangCqCongAnThanhTra') ?>

    <?php // echo $form->field($model, 'motSoNnKhac') ?>

    <?php // echo $form->field($model, 'toTrinhBcLanhDao') ?>

    <?php // echo $form->field($model, 'trichYeuNoiDungTonDong') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
