<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SotheodoisauhoanthueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sotheodoisauhoanthue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mst') ?>

    <?= $form->field($model, 'maChuong') ?>

    <?= $form->field($model, 'laToChuc') ?>

    <?= $form->field($model, 'qdId') ?>

    <?php // echo $form->field($model, 'thoiKyThanhTra') ?>

    <?php // echo $form->field($model, 'soVbHoanThueId') ?>

    <?php // echo $form->field($model, 'tienThue') ?>

    <?php // echo $form->field($model, 'tienLai') ?>

    <?php // echo $form->field($model, 'ghiChu') ?>

    <?php // echo $form->field($model, 'kyBaoCao') ?>

    <?php // echo $form->field($model, 'loaiHoanThueId') ?>

    <?php // echo $form->field($model, 'soTienThueThuHoiKyTruocChuyenSang') ?>

    <?php // echo $form->field($model, 'soTienPhatViPhamKyTruocChuyenSang') ?>

    <?php // echo $form->field($model, 'tienChamNopKyTruocChuyenSang') ?>

    <?php // echo $form->field($model, 'soQdThuHoiHoanThue') ?>

    <?php // echo $form->field($model, 'soTienThueThuHoiHoanThue') ?>

    <?php // echo $form->field($model, 'soQdXuPhat') ?>

    <?php // echo $form->field($model, 'soTienPhatViPham') ?>

    <?php // echo $form->field($model, 'tienChamNopXuPhat') ?>

    <?php // echo $form->field($model, 'soQdktSauHoan') ?>

    <?php // echo $form->field($model, 'thoiKyThanhTraSauHoanThue') ?>

    <?php // echo $form->field($model, 'soTienThueThuHoiDaNop') ?>

    <?php // echo $form->field($model, 'soTienPhatViPhamDaNop') ?>

    <?php // echo $form->field($model, 'tienChamNopDaNop') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
