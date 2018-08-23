<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Loaivanban;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Vanban */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vanban-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'soVb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ghiChu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ngayVb')->textInput() ?>

    <?= $form->field($model, 'loaiVanBanId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Loaivanban::find()->asArray()->all(), 'id', 'tenLoaiVb'),
        'options' => ['placeholder' => Yii::t('app', 'Select a loai van ban ...')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
