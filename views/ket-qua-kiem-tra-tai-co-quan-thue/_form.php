<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use app\models\Trangthaihoso;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ketquakiemtrataicoquanthue */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\DateValidation */
/* @var $form yii\widgets\ActiveForm */

// danh mục trạng thái hồ sơ
$trangthaihoso = ArrayHelper::map(Trangthaihoso::find()->asArray()->all(), 'id', 'trangThaiHs');

use app\assets\KetquakiemtrataicoquanthueAsset;

KetquakiemtrataicoquanthueAsset::register($this);

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
<div id="kqkttcptform" class="ketquakiemtrataicoquanthue-form" data-bind="nextFieldOnEnter:true">

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
                        'label' => '01. Mã số thuế',
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
            <label for="usr" style="font-size: 12px;">02. Tên người nộp</label><br>
            <span id="nguoinopthue-tennguoinop"><?= $nguoinopthue->tenNguoiNop ? $nguoinopthue->tenNguoiNop : '' ?></span><br/>
        </div>
    </div>
    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Trạng thái
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phongBan')->textInput(['maxlength' => true])->label('06. Phòng ban') ?>
        </div>

        <div class="col-md-3">
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'trangThaiHoSoId' => [
                        'type' => Form::INPUT_WIDGET,
                        'label' => '07. Trạng thái HS',
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => $trangthaihoso,
                            'options' => ['placeholder' => Yii::t('app', 'Select a trangThaiHoSoId...'),
                                'data-info' => '1',
                            ],
                            'pluginEvents' => [
                                "select2:close" => "focusNextInput",
                            ],
                        ],
                    ],
                ]
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ghiChu1')->textInput(['maxlength' => true])->label('08. Người nhập') ?>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $datevalidation,
                'form' => $form,
                'columns' => 3,
                'attributes' => [
                    'ngayTao' => [
                        'type' => Form::INPUT_TEXT,
                        'label' => '6. Ngày tạo',
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
    </div>
    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Tổng thuế
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tongThueDieuChinhTang')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tongThueDieuChinhGiam')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h" style="width: 400px">
                    Ấn định + Giảm khấu trừ + Giảm lỗ
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'anDinh')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'giamKhauTru')->textInput(['maxlength' => true])->label('12. Giảm khấu trừ') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'giamLo')->textInput(['maxlength' => true])->label('13. Giảm lỗ') ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Miễn giảm
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tienDuocMineTang')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tienDuocMienGiam')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
