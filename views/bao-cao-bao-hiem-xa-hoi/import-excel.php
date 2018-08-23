<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Nguoinopthue */

$this->title = Yii::t('app', 'Cập nhật dữ liệu báo cáo BHXH');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nguoinopthue-import-excel">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nguoinopthue-form">

        <?php $form = ActiveForm::begin([
            'action' => ['bao-cao-bao-hiem-xa-hoi/import-excel'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($bhxh, 'excelFile')->fileInput()->label('Chọn tệp') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Nhập dữ liệu'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
