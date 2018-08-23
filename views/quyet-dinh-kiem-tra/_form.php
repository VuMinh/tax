<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Quyetdinhkiemtra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quyetdinhkiemtra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'soQdKiemTra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngayQdKiemTra')->textInput() ?>

    <?= $form->field($model, 'noDongKyTruocChuyenSang')->textInput() ?>

    <?= $form->field($model, 'phatSinhTrongKy')->textInput() ?>

    <?= $form->field($model, 'nienDoKiemTra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truongDoanId')->textInput() ?>

    <?= $form->field($model, 'ngayCongBoQdkt')->textInput() ?>

    <?= $form->field($model, 'ngayTrinhVbTamDungKt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
