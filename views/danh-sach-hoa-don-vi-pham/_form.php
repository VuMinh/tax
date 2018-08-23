<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use app\assets\DanhsachhoadonviphamAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Danhsachhoadonvipham */
/* @var $form yii\widgets\ActiveForm */
/* @var $nguoimua app\models\Danhsachhoadonvipham */
/* @var $datevalidation app\models\Danhsachhoadonvipham */
DanhsachhoadonviphamAsset::register($this);

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

<div class="danhsachhoadonvipham-form" id="hdvpform" data-bind="nextFieldOnEnter:true">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h5 class="style-h">
                    Doanh nghiệp mua
                </h5>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'coQuanQuanLyThueDnMua')->textInput(['maxlength' => true])->label('02. Cơ quan quản lý thuế') ?>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $nguoimua,
                'form' => $form,
                'columns' => 3,
                'attributes' => [
                    'maSoThue' => [
                        'type' => Form::INPUT_WIDGET,
                        'label' => '04. Mã số thuế',
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
            <label for="usr" style="font-size: 12px;">03. Tên doanh nghiệp</label><br>
            <span
                id="nguoimua"><?= $nguoimua->tenNguoiNop ? $nguoimua->tenNguoiNop : '' ?></span><br/>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h5 class="style-h">
                    Thông tin hóa đơn
                </h5>
            </div>
        </div>
        <div class="row" style="margin: 0 3px">
            <div class="col-md-3">
                <?= $form->field($model, 'kyHieuHoaDon')->textInput(['maxlength' => true])->label('05. Kí hiệu hóa đơn') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'soHoaDon')->textInput(['maxlength' => true])->label('06. Số hóa đơn') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($datevalidation, 'ngayPhatHanhHoaDon')->textInput()->label('07. Ngày phát hành hóa đơn') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'tenHangHoa')->textInput(['maxlength' => true])->label('08. Tên hàng hóa') ?>
            </div>
        </div>
        <div class="row" style="margin: 0 3px">
            <div class="col-md-3">
                <?= $form->field($model, 'giaTriHangChuaThue')->textInput(['maxlength' => true])->label('09. Giá trị hàng chưa thuế') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'thueVat')->textInput(['maxlength' => true])->label('10. Thuế GTGT') ?>
            </div>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h5 class="style-h">
                    Dấu hiệu vi phạm
                </h5>
            </div>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'dauHieuViPham')->textarea(['rows' => 6])->label('11. Dấu hiệu vi phạm') ?>
        </div>

    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h5 class="style-h">
                    Doanh nghiệp bán
                </h5>
            </div>
        </div>
        <div class="row" style="margin: 0 3px">
            <div class="col-md-3">
                <?= $form->field($model, 'tenChuDn')->textInput(['maxlength' => true])->label('12. Tên chủ DN') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'cmt')->textInput(['maxlength' => true])->label('13. CMT') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($datevalidation, 'ngayThayDoiChuSoHuuGanNhat')->textInput()->label('14. Ngày thay đổi chủ sở hữu gần nhất') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($datevalidation, 'ngayThayDoiDiaDiemGanNhat')->textInput()->label('15. Ngày thay đổi địa điểm gần nhất') ?>
            </div>
        </div>
        <div class="row" style="margin: 0 3px">
            <div class="col-md-3">
                <?= $form->field($model, 'thongBaoBoTron')->textInput(['maxlength' => true])->label('16. Thông báo bỏ trốn') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($datevalidation, 'ngayBoTron')->textInput()->label('17. Ngày bỏ trốn') ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'coQuanThueQuanLyDnBan')->textInput(['maxlength' => true])->label('18. Cơ quan thuế quản lý') ?>
            </div>
        </div>
        <div class="row" style="margin: 0 3px">
            <div class="col-md-3">
                <?= $form->field($model, 'mstDnBan')->textInput(['maxlength' => true])->label('19. Mã số thuế') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'tenDnBan')->textInput(['maxlength' => true])->label('20. Tên doanh nghiệp') ?>
            </div>

        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h5 class="style-h">
                    Chi tiết
                </h5>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'coQuanThueRaQdxl')->textInput(['maxlength' => true])->label('21. Cơ quan thuế đã ra quyết định xử lý hoặc đơn vị đã tự điều chỉnh (tích X)') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'ghiChu')->textInput(['maxlength' => true])->label('22. Ghi chú') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
