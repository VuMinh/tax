<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DanhsachhoadonviphamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="danhsachhoadonvipham-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ngayBaoCao') ?>

    <?= $form->field($model, 'coQuanQuanLyThueDnMua') ?>

    <?= $form->field($model, 'mstDnMua') ?>

    <?= $form->field($model, 'kyHieuHoaDon') ?>

    <?php // echo $form->field($model, 'soHoaDon') ?>

    <?php // echo $form->field($model, 'ngayPhatHanhHoaDon') ?>

    <?php // echo $form->field($model, 'tenHangHoa') ?>

    <?php // echo $form->field($model, 'giaTriHangChuaThue') ?>

    <?php // echo $form->field($model, 'thueVat') ?>

    <?php // echo $form->field($model, 'dauHieuViPham') ?>

    <?php // echo $form->field($model, 'tenChuDn') ?>

    <?php // echo $form->field($model, 'cmt') ?>

    <?php // echo $form->field($model, 'ngayThayDoiChuSoHuuGanNhat') ?>

    <?php // echo $form->field($model, 'ngayThayDoiDiaDiemGanNhat') ?>

    <?php // echo $form->field($model, 'thongBaoBoTron') ?>

    <?php // echo $form->field($model, 'ngayBoTron') ?>

    <?php // echo $form->field($model, 'coQuanThueQuanLyDnBan') ?>

    <?php // echo $form->field($model, 'mstDnBan') ?>

    <?php // echo $form->field($model, 'coQuanThueRaQdxl') ?>

    <?php // echo $form->field($model, 'ghiChu') ?>

    <?php // echo $form->field($model, 'ghiChu1') ?>

    <?php // echo $form->field($model, 'ghiChu2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
