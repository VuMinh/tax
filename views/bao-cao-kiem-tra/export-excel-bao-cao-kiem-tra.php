<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use kartik\select2\Select2;
use app\models\Truongdoankiemtra;
use app\models\Baocaokiemtra;

/* @var $this yii\web\View */
/* @var $model Baocaokiemtra */
$this->title = "Xuất báo cáo kiểm tra";

/** @var Truongdoankiemtra[] $truongDoans */
$truongDoans = Truongdoankiemtra::find()->asArray()->all();
$truongDoanData = [];
foreach ($truongDoans as $truongDoan) {
    $truongDoanData[$truongDoan['truongDoan']] = $truongDoan['truongDoan'];
}

/* @var BaoCaoKiemTra[] $doiKiemTras*/

$doiKiemTras = Baocaokiemtra::find()->asArray()->all();
$doiKiemTraData =[];
foreach ($doiKiemTras as $doiKiemTra){
    $doiKiemTraData[$doiKiemTra['doiKiemTra']]= $doiKiemTra['doiKiemTra'];
}


?>
<div class="bao-cao-kiem-tra-export-excel">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="bao-cao-kiem-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-kiem-tra/export-excel-bao-cao-kiem-tra'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'start')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'end')->textInput() ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'truongDoan')->widget(Select2::className(), [
                    'data' => $truongDoanData,
                    'options' => ['placeholder' => 'Chọn trưởng đoàn ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>

            <div class="col-md-6"><?= $form->field($model, 'doiKiemTra2')->widget(Select2::className(), [
                    'data' => $doiKiemTraData,
                    'options' => ['placeholder' => 'Chọn đội kiểm tra ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Export excel'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
