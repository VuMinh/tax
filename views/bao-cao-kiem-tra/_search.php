<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BaocaokiemtraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="baocaokiemtra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mst') ?>

    <?= $form->field($model, 'soQdkt') ?>

    <?= $form->field($model, 'qdHtThuocKhRuiRoTrongNam') ?>

    <?= $form->field($model, 'loaiKhuVucId') ?>

    <?php // echo $form->field($model, 'loaiQuyMoId') ?>

    <?php // echo $form->field($model, 'loaiNdktId') ?>

    <?php // echo $form->field($model, 'kiemTraTheoQuyetToanChiDao') ?>

    <?php // echo $form->field($model, 'ngayKyBbkt') ?>

    <?php // echo $form->field($model, 'soQd') ?>

    <?php // echo $form->field($model, 'truyThuThueGtgt') ?>

    <?php // echo $form->field($model, 'truyThuThueTndn') ?>

    <?php // echo $form->field($model, 'truyThuThueTncn') ?>

    <?php // echo $form->field($model, 'truyThuThueKhac') ?>

    <?php // echo $form->field($model, 'truyHoanThueGtgt') ?>

    <?php // echo $form->field($model, 'truyHoanThueTncn') ?>

    <?php // echo $form->field($model, 'truyHoanThueKhac') ?>

    <?php // echo $form->field($model, 'phatTronThue') ?>

    <?php // echo $form->field($model, 'phatHanhChinhKhac') ?>

    <?php // echo $form->field($model, 'phatChamNop') ?>

    <?php // echo $form->field($model, 'phatKhac') ?>

    <?php // echo $form->field($model, 'noDongNamTruocChuyenSang') ?>

    <?php // echo $form->field($model, 'noDongPhatSinhTrongNam') ?>

    <?php // echo $form->field($model, 'daNopDongNamTruoc') ?>

    <?php // echo $form->field($model, 'daNopPhatSinhTruyThu') ?>

    <?php // echo $form->field($model, 'daNopPhatSinhTruyHoan') ?>

    <?php // echo $form->field($model, 'daNopTienPhat') ?>

    <?php // echo $form->field($model, 'thueMienGiamTheoKeKhai') ?>

    <?php // echo $form->field($model, 'thueMienGiamTheoKiemTra') ?>

    <?php // echo $form->field($model, 'mienGiamChenhLech') ?>

    <?php // echo $form->field($model, 'giamKhauTru') ?>

    <?php // echo $form->field($model, 'thueKhongDuocHoan') ?>

    <?php // echo $form->field($model, 'giamLo') ?>

    <?php // echo $form->field($model, 'ghiChu') ?>

    <?php // echo $form->field($model, 'hanhViViPham') ?>

    <?php // echo $form->field($model, 'moTaCachThucPhatHien') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
