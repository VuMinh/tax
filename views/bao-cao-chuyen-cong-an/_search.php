<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BaocaochuyenconganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="baocaochuyencongan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'phongChiCuc') ?>

    <?= $form->field($model, 'mst') ?>

    <?= $form->field($model, 'soKetLuanThanhKiemTraDaBanHanh') ?>

    <?= $form->field($model, 'doanhSo') ?>

    <?php // echo $form->field($model, 'thueGtgt') ?>

    <?php // echo $form->field($model, 'tongSoHoaDon') ?>

    <?php // echo $form->field($model, 'ngayBaoCao') ?>

    <?php // echo $form->field($model, 'ngayCapNhat') ?>

    <?php // echo $form->field($model, 'ngayKetLuan') ?>

    <?php // echo $form->field($model, 'ghiChu') ?>

    <?php // echo $form->field($model, 'ghiChu1') ?>

    <?php // echo $form->field($model, 'ghiChu2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
