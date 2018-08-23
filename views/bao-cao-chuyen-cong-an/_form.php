<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\builder\Form;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaochuyencongan */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\DateValidation */
/* @var $form yii\widgets\ActiveForm */

use app\assets\BaocaochuyendeconganAsset;
BaocaochuyendeconganAsset::register($this);
$url = \yii\helpers\Url::to(['select']);
?>

<style>
    .style-header {
        background-color: aliceblue;
        border: 1px solid #dbdbdb;
        margin-bottom: 10px;
    }

    .style-h {
        background: #a6e1ec;
        padding: 10px;
        margin-top: 0;
        border-bottom: 1px solid #dbdbdb;
        border-right: 1px solid #dbdbdb;
    }
</style>

<div id="bccdca" class="baocaochuyencongan-form" data-bind="nextFieldOnEnter:true">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Người nộp thuế
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $nguoinopthue,
                'form' => $form,
                'columns' => 3,
                'attributes' => [
                    'maSoThue' => [
                        'type' => Form::INPUT_WIDGET,
                        'label' => 'Mã số thuế',
                        'widgetClass' => Select2::className(),
                        'initValueText' => "", // set the initial display text
                        'options' => [
                            'options' => ['placeholder' => 'Chọn mã số thuế',
                                'data-info' => '1',
                            ],
                            'pluginOptions' => [
                                'minimumInputLength' => 1,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Đang xử lý...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
                                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                                ],
                            ],
                            'pluginEvents' => [
                                "select2:close" => "focusNextInput",
                            ],
                        ],
                    ],
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <label for="usr" style="font-size: 12px;">Tên người nộp</label><br>
            <span
                id="nguoinopthue-tennguoinop"><?= $nguoinopthue->tenNguoiNop ? $nguoinopthue->tenNguoiNop : '' ?></span><br/>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Chi tiết
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'phongChiCuc')->textInput(['maxlength' => true,'value' => 'Chi cục thuế quận Thanh Xuân']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'soKetLuanThanhKiemTraDaBanHanh')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'doanhSo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'thueGtgt')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'tongSoHoaDon')->textInput() ?>
        </div>

        <div class="col-md-3">
            <?= Form::widget([
                'model' => $datevalidation,
                'form' => $form,
                'columns' => 3,
                'attributes' => [
                    'ngayBaoCao' => [
                        'type' => Form::INPUT_TEXT,
                        'label' => 'Ngày báo cáo',
                        'options' => [
                            'placeholder' => 'dd/mm/yyyy',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'data-date' => '1'
                        ],
                    ],
                ]
            ]); ?>
        </div>

        <div class="col-md-3">
            <?= Form::widget([
                'model' => $datevalidation,
                'form' => $form,
                'columns' => 3,
                'attributes' => [
                    'ngayKetLuan' => [
                        'type' => Form::INPUT_TEXT,
                        'label' => 'Ngày kết luận',
                        'options' => [
                            'placeholder' => 'dd/mm/yyyy',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'data-date' => '1'
                        ],
                    ],
                ]
            ]); ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ghiChu')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
