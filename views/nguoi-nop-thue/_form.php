<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nguoinopthue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nguoinopthue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'maSoThue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tenNguoiNop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ghiChu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nganhNgheKdChinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diaChi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailTbThue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tenNganhNgheKdChinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nganhNgheId')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
