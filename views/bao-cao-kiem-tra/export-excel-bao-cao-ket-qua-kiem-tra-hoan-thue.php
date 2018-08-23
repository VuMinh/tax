<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaokiemtra */
$this->title = "011- Kết quả kiểm tra hoàn thuế";
?>
<div class="bao-cao-kiem-tra-export-excel">

    <h1>Danh sách báo cáo kiểm tra hoàn thuế</h1>

    <div class="bao-cao-kiem-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-kiem-tra/export-excel-bao-cao-ket-qua-kiem-tra-hoan-thue'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'month')->textInput()->label('Chọn tháng')  ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'year')->textInput()->label('Chọn năm')  ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Export excel'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
