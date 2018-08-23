<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use kartik\select2\Select2;
use app\models\Truongdoankiemtra;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model ExportExcel */
$this->title = "Xuất Báo cáo báo hiểm xã hội";

/** @var Truongdoankiemtra[] $truongDoans */
$truongDoans = Truongdoankiemtra::find()->asArray()->all();
$truongDoanData = [];
foreach ($truongDoans as $truongDoan) {
    $truongDoanData[$truongDoan['truongDoan']] = $truongDoan['truongDoan'];
}

?>
<div class="bao-cao-kiem-tra-export-excel">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="bao-cao-kiem-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-bao-hiem-xa-hoi/export-excel-bao-cao-bao-hiem-xa-hoi'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'start')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'end')->textInput() ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'truongDoan2')->widget(Select2::className(), [
                    'data' => $truongDoanData,
                    'options' => ['placeholder' => 'Chọn trưởng đoàn ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Trưởng đoàn'); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Export excel'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
