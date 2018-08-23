<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use kartik\select2\Select2;
use kartik\form\ActiveForm;
use kartik\builder\Form;

AppAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\Nganhnghe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nganhnghe-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'maNganhNgheKdChinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tenNganhNgheKdChinh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ghiChu')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
