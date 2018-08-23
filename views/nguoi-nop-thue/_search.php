<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NguoinopthueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nguoinopthue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'maSoThue') ?>

    <?= $form->field($model, 'tenNguoiNop') ?>

    <?= $form->field($model, 'ghiChu') ?>

    <?= $form->field($model, 'nganhNgheKdChinh') ?>

    <?php // echo $form->field($model, 'diaChi') ?>

    <?php // echo $form->field($model, 'emailTbThue') ?>

    <?php // echo $form->field($model, 'tenNganhNgheKdChinh') ?>

    <?php // echo $form->field($model, 'nganhNgheId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
