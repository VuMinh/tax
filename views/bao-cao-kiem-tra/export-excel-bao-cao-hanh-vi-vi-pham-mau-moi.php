<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 1/29/2018
 * Time: 2:02 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use kartik\select2\Select2;
use app\models\Truongdoankiemtra;
use app\models\Baocaokiemtra;

/* @var $this \yii\web\View */
/* @var $model \app\models\ExportExcel */

$this->title = "Báo cáo hành vi vi phạm mẫu mới";
/** Truongdoankiemtra[] $truongDoans*/
$truongDoans = Truongdoankiemtra::find()->asArray()->all();
$truongDoanData = [];
foreach ($truongDoans as $truongDoan){
    $truongDoanData[$truongDoan['truongDoan']]= $truongDoan['truongDoan'];
}

/** Baocaokiemtra $doiKiemTras*/
$doiKiemTras = Baocaokiemtra::find()->asArray()->all();
$doiKiemTraData=[];
foreach ($doiKiemTras as $doiKiemTra){
    $doiKiemTraData[$doiKiemTra['doiKiemTra']]= $doiKiemTra['doiKiemTra'];
}
?>

<div class="bao-cao-kiem-tra-export-excel">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="bao-cao-kiem-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-kiem-tra/export-excel-bao-cao-hanh-vi-vi-pham-mau-moi'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'start')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'end')->textInput() ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'truongDoan3')->widget(Select2::className(), [
                    'data' => $truongDoanData,
                    'options' => ['placeholder' => 'Chọn trưởng đoàn ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Trưởng đoàn'); ?>
            </div>

            <div class="col-md-6"><?= $form->field($model, 'doiKiemTra5')->widget(Select2::className(), [
                    'data' => $doiKiemTraData,
                    'options' => ['placeholder' => 'Chọn đội kiểm tra ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Đội kiểm tra'); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Export excel'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>





