<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuyetdinhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quyetdinh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'soQd') ?>

    <?= $form->field($model, 'ngayQd') ?>

    <?= $form->field($model, 'noDongKyTruocChuyenSang') ?>

    <?= $form->field($model, 'phatSinhTrongKy') ?>

    <?php // echo $form->field($model, 'nienDoKiemTra') ?>

    <?php // echo $form->field($model, 'truongDoanKiemTra') ?>

    <?php // echo $form->field($model, 'ngayCongBoQdkt') ?>

    <?php // echo $form->field($model, 'ngayTrinhVbTamDungKt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
