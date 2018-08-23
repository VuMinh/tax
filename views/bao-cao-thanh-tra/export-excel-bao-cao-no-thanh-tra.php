<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ExportExcel;
use kartik\select2\Select2;
use app\models\Truongdoankiemtra;

/* @var $this yii\web\View */
/* @var $model ExportExcel */
$this->title = "Xuất báo cáo nợ thanh tra";

?>
<div class="bao-cao-no-thanh-tra">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="bao-cao-no-thanh-tra-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-thanh-tra/export-excel-bao-cao-no-thanh-tra'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'start')->textInput()->label('Ngày báo cáo') ?></div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Export excel'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>


