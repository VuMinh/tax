<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use kartik\select2\Select2;
use app\models\Truongdoankiemtra;
use app\models\Baocaokiemtra;

/* @var $this yii\web\View */
/* @var $model ExportExcel */

/* @var Baocaokiemtra[] $doiKiemTras*/
$doiKiemTras = Baocaokiemtra::find()->asArray()->all();
$doiKiemTraData =[];
foreach ($doiKiemTras as $doiKiemTra){
    $doiKiemTraData[$doiKiemTra['doiKiemTra']]= $doiKiemTra['doiKiemTra'];
}

$this->title = "Xuất báo cáo giao ban tháng";

?>
<div class="bao-cao-kiem-tra-export-excel">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="bao-cao-kiem-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-kiem-tra/export-excel-bao-cao-giao-ban-thang'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'start')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'end')->textInput() ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'doiKiemTra3')->widget(Select2::className(), [
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


