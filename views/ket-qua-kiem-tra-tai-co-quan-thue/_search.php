<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KetquakiemtrataicoquanthueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ketquakiemtrataicoquanthue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'phongBan') ?>

    <?= $form->field($model, 'ngayTao') ?>

    <?= $form->field($model, 'trangThaiHoSoId') ?>

    <?= $form->field($model, 'ngayCapNhat') ?>

    <?php // echo $form->field($model, 'tongThueDieuChinhTang') ?>

    <?php // echo $form->field($model, 'tongThueDieuChinhGiam') ?>

    <?php // echo $form->field($model, 'anDinh') ?>

    <?php // echo $form->field($model, 'giamKhauTru') ?>

    <?php // echo $form->field($model, 'giamLo') ?>

    <?php // echo $form->field($model, 'tienDuocMineTang') ?>

    <?php // echo $form->field($model, 'tienDuocMienGiam') ?>

    <?php // echo $form->field($model, 'nguoiNopThueId') ?>

    <?php // echo $form->field($model, 'ghiChu1') ?>

    <?php // echo $form->field($model, 'ghiChu2') ?>

    <?php // echo $form->field($model, 'ghiChu3') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
