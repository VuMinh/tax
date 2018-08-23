<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use app\models\Baocaokiemtra;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaokiemtra */


/** @var Baocaokiemtra[] $doiKiemTras*/

$doiKiemTras = Baocaokiemtra::find()->asArray()->all();
$doiKiemTraData =[];
foreach ($doiKiemTras as $doiKiemTra){
    $doiKiemTraData[$doiKiemTra['doiKiemTra']]= $doiKiemTra['doiKiemTra'];
}

$this->title = "Xuất báo cáo số tồn";
?>
<div class="bao-cao-kiem-tra-export-excel">

    <h1>Xuất báo cáo nợ kiểm tra</h1>

    <div class="bao-cao-kiem-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-kiem-tra/export-excel-bao-cao-no-kiem-tra'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'day')->textInput(['placeholder' => 'dd/mm/yyyy'])->label('Chọn mốc thời gian') ?></div>
            <div class="col-md-6"><?= $form->field($model, 'doiKiemTra')->widget(Select2::className(), [
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
