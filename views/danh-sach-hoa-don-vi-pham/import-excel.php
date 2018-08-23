<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Nguoinopthue */

$this->title = Yii::t('app', 'Cập nhật dữ liệu Danh sách hóa đơn vị phạm');
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nguoinopthue-form">

        <?php $form = ActiveForm::begin([
            'action' => ['danh-sach-hoa-don-vi-pham/import-excel'],
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($bhxh, 'excelFile')->fileInput()->label('Chọn tệp') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Nhập dữ liệu'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
