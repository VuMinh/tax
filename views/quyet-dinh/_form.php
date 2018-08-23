<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Quyetdinh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quyetdinh-form" data-bind="nextFieldOnEnter:true">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'soQd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngayQd')->textInput() ?>

    <?= $form->field($model, 'noDongKyTruocChuyenSang')->textInput() ?>

    <?= $form->field($model, 'phatSinhTrongKy')->textInput() ?>

    <?= $form->field($model, 'nienDoKiemTra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truongDoanKiemTra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngayCongBoQdkt')->textInput() ?>

    <?= $form->field($model, 'ngayTrinhVbTamDungKt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
