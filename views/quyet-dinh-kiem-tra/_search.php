<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuyetdinhkiemtraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quyetdinhkiemtra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'soQdKiemTra') ?>

    <?= $form->field($model, 'ngayQdKiemTra') ?>

    <?= $form->field($model, 'noDongKyTruocChuyenSang') ?>

    <?= $form->field($model, 'phatSinhTrongKy') ?>

    <?php // echo $form->field($model, 'nienDoKiemTra') ?>

    <?php // echo $form->field($model, 'truongDoanId') ?>

    <?php // echo $form->field($model, 'ngayCongBoQdkt') ?>

    <?php // echo $form->field($model, 'ngayTrinhVbTamDungKt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
