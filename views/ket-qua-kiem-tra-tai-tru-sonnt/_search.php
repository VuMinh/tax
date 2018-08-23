<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KetquakttaitrusonntSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ketquakttaitrusonnt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'chiTieuKiemTraId') ?>

    <?= $form->field($model, 'nhiemVuKiemTra') ?>

    <?= $form->field($model, 'soQdkt') ?>

    <?= $form->field($model, 'ngayQdkt') ?>

    <?php // echo $form->field($model, 'nguoiNopThueId') ?>

    <?php // echo $form->field($model, 'noiDungChuyenDe') ?>

    <?php // echo $form->field($model, 'tienDoThucHien') ?>

    <?php // echo $form->field($model, 'soQdXuLy') ?>

    <?php // echo $form->field($model, 'ngayQdxl') ?>

    <?php // echo $form->field($model, 'soKetLuan') ?>

    <?php // echo $form->field($model, 'ngayKetLuan') ?>

    <?php // echo $form->field($model, 'doanhNghiepCoViPham') ?>

    <?php // echo $form->field($model, 'loaiQuyMoDoanhNghiepId') ?>

    <?php // echo $form->field($model, 'ngayTao') ?>

    <?php // echo $form->field($model, 'ngayCapNhat') ?>

    <?php // echo $form->field($model, 'loaiKhuVucDoanhNghiepId') ?>

    <?php // echo $form->field($model, 'soThueTruyThuVat') ?>

    <?php // echo $form->field($model, 'soThueTruyThuTndn') ?>

    <?php // echo $form->field($model, 'soThueTruyThuTncn') ?>

    <?php // echo $form->field($model, 'soThueTruyThuTtdb') ?>

    <?php // echo $form->field($model, 'soThueTruyThuKhac') ?>

    <?php // echo $form->field($model, 'soThueKhongDuocHoan') ?>

    <?php // echo $form->field($model, 'soThueTruyHoan') ?>

    <?php // echo $form->field($model, 'anDinh') ?>

    <?php // echo $form->field($model, 'tienPhat') ?>

    <?php // echo $form->field($model, 'tienKkSai') ?>

    <?php // echo $form->field($model, 'tienPhatNopCham') ?>

    <?php // echo $form->field($model, 'tienPhatViPhamHanhChinhKhac') ?>

    <?php // echo $form->field($model, 'noDongNamTruoc') ?>

    <?php // echo $form->field($model, 'noPhatSinhTrongNam') ?>

    <?php // echo $form->field($model, 'daNopChoNoDongNamTruoc') ?>

    <?php // echo $form->field($model, 'daNopPhatSinhTrongNam') ?>

    <?php // echo $form->field($model, 'conPhaiNopDongNamTruoc') ?>

    <?php // echo $form->field($model, 'conPhaiNopPhatSinhTrongNam') ?>

    <?php // echo $form->field($model, 'soThueDuocGiamTheoKeKhai') ?>

    <?php // echo $form->field($model, 'soThueDuocGiamTheoTtkt') ?>

    <?php // echo $form->field($model, 'chenhLech') ?>

    <?php // echo $form->field($model, 'giamLo') ?>

    <?php // echo $form->field($model, 'giamKhauTru') ?>

    <?php // echo $form->field($model, 'ghiChu1') ?>

    <?php // echo $form->field($model, 'ghiChu2') ?>

    <?php // echo $form->field($model, 'ghiChu3') ?>

    <?php // echo $form->field($model, 'ghiChu4') ?>

    <?php // echo $form->field($model, 'ghiChu5') ?>

    <?php // echo $form->field($model, 'ghiChu6') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
