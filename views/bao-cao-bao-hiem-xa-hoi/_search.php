<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BaocaobaohiemxahoiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="baocaobaohiemxahoi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mst') ?>

    <?= $form->field($model, 'soQdxlId') ?>

    <?= $form->field($model, 'viPhamBhxh') ?>

    <?= $form->field($model, 'viPhamKpcd') ?>

    <?php // echo $form->field($model, 'ghiChu') ?>

    <?php // echo $form->field($model, 'coKtndKpcd') ?>

    <?php // echo $form->field($model, 'coKtndBhxh') ?>

    <?php // echo $form->field($model, 'soDvThanhTraKiemTraHoanThanh') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
