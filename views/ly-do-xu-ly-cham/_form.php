<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lydoxulycham */
/* @var $bckt app\models\Lydoxulycham */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lydoxulycham-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'mst')->textInput(['readonly' => true, 'value' => $bckt['mst0']['maSoThue']])->label('Mã số thuế') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soQdktId')->textInput(['readonly' => true, 'value' => $bckt['soQdkt']['soQdKiemTra']])->label('Số QĐKT') ?>
        </div>
    </div>

    <?= $form->field($model, 'vuongMacChinhSach')->checkbox(['label' => 'Vướng mắc chính sách']) ?>

    <?= $form->field($model, 'chuaThongNhatSoLieuGiaiTrinhCham')->checkbox(['label' => 'Chưa thống nhất số liệu giải trình chậm']) ?>

    <?= $form->field($model, 'dvCoCongVanXinTamLui')->checkbox(['label' => 'Đơn vị có công văn xin tạm lùi']) ?>

    <?= $form->field($model, 'doiChieuSoLieuVoiCucThue')->checkbox(['label' => 'Chưa thống nhất số liệu giải trình chậm']) ?>

    <?= $form->field($model, 'chuyenHsSangCqCongAnThanhTra')->checkbox(['label' => 'Chuyển HS sang cơ quan Công An Thanh Tra']) ?>

    <?= $form->field($model, 'motSoNnKhac')->checkbox(['label' => 'Một số NN khác']) ?>

    <?= $form->field($model, 'toTrinhBcLanhDao')->checkbox(['label' => 'Tờ trình báo cáo lãnh đạo']) ?>

    <?= $form->field($model, 'trichYeuNoiDungTonDong')->textarea(['rows' => 6])->label('Trích yếu nội dung tồn động') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
