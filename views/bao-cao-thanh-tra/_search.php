<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BaocaothanhtraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="baocaothanhtra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'soQdThanhTraId') ?>

    <?= $form->field($model, 'mst') ?>

    <?= $form->field($model, 'truongDoan') ?>

    <?= $form->field($model, 'vatTruyThu') ?>

    <?php // echo $form->field($model, 'tndn') ?>

    <?php // echo $form->field($model, 'ttdb') ?>

    <?php // echo $form->field($model, 'tncn') ?>

    <?php // echo $form->field($model, 'monBai') ?>

    <?php // echo $form->field($model, 'tienPhat1020') ?>

    <?php // echo $form->field($model, 'tienPhat005') ?>

    <?php // echo $form->field($model, 'soQdTruyThuId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
