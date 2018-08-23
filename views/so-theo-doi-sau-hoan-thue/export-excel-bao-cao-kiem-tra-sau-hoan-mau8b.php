<?php
/**
 * Created by PhpStorm.
 * User: MinhVT
 * Date: 5/12/2017
 * Time: 3:32 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use kartik\select2\Select2;
use app\models\Truongdoankiemtra;

/* @var $this yii\web\View */
/* @var $model ExportExcel */
$this->title = "Xuất báo cáo kiểm tra sau hoàn thuế 24 hàng tháng";

?>
<div class="so-theo-doi-sau-hoan-thue-export-excel">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="so-theo-doi-sau-hoan-thue-form">

        <?php $form = ActiveForm::begin([
            'action' => ['so-theo-doi-sau-hoan-thue/export-excel-bao-cao-kiem-tra-sau-hoan-mau8b'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'start')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'end')->textInput() ?></div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Export excel'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>


