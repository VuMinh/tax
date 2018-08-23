<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use app\models\Chitieukiemtra;
use app\assets\KetquakiemtrataitrusonntAsset;
use app\models\base\Loainoidungkiemtra;
use app\models\base\Loaikhuvucdoanhnghiep;
use app\models\Loaiquymodoanhnghiep;
/* @var $this yii\web\View */
/* @var $model app\models\Ketquakttaitrusonnt */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\DateValidation */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::to(['select']);

KetquakiemtrataitrusonntAsset::register($this);

// danh mục loại khu vực doanh nghiệp
$loaikhuvucdoanhnghiep = ArrayHelper::map(Loaikhuvucdoanhnghiep::find()->asArray()->all(), 'id', 'loaiKhuVuc');
$temp = 16;
for ($i = 1; $i < count($loaikhuvucdoanhnghiep) + 1; $i++) {
    $loaikhuvucdoanhnghiep[$i] = $temp . ' - ' . $loaikhuvucdoanhnghiep[$i];
    $temp++;
}
$loaikhuvucdoanhnghiep[0] = '00 - Không điền khu vực';
ksort($loaikhuvucdoanhnghiep);

// danh mục loại quy mô doanh nghiệp
$loaiquymodoanhnghiep = ArrayHelper::map(Loaiquymodoanhnghiep::find()->asArray()->all(), 'id', 'loaiQuyMo');
$temp = 13;
for ($i = 1; $i < count($loaiquymodoanhnghiep) + 1; $i++) {
    $loaiquymodoanhnghiep[$i] = $temp . ' - ' . $loaiquymodoanhnghiep[$i];
    $temp++;
}
$loaiquymodoanhnghiep[0] = '00 - Không điền quy mô';
ksort($loaiquymodoanhnghiep);

// danh mục loại nội dung kiểm tra
$loainoidungkiemtra = ArrayHelper::map(Loainoidungkiemtra::find()->asArray()->all(), 'id', 'loaiNd');
$temp = 1;
for ($i = 1; $i < count($loainoidungkiemtra) + 1; $i++) {
    $loainoidungkiemtra[$i] = $temp . ' - ' . $loainoidungkiemtra[$i];
    $temp++;
}

$loainoidungkiemtra[0] = '00 - Không điền nội dung';
ksort($loainoidungkiemtra);

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

<div id="kqkttnntform" class="ketquakttaitrusonnt-form" data-bind="nextFieldOnEnter:true">

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
            <label for="usr" style="font-size: 12px;">Tên người nộp</label><br>
            <span id="nguoinopthue-tennguoinop"><?= $nguoinopthue->tenNguoiNop ? $nguoinopthue->tenNguoiNop : '' ?></span><br/>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Chỉ tiêu kiểm tra
                </h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ghiChu1')->textInput(['maxlength' => true])->label('Trưởng đoàn') ?>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'chiTieuKiemTraId' => [
                        'type' => Form::INPUT_WIDGET,
                        'label' => '02. Chỉ tiêu kiểm tra',
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => ArrayHelper::map(Chitieukiemtra::find()->asArray()->all(), 'id', 'chiTieuKiemTra'),
                            'options' => ['placeholder' => Yii::t('app', 'Select a chiTieuKiemTra...'),
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
            <?= $form->field($model, 'nhiemVuKiemTra')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $datevalidation,
                'form' => $form,
                'columns' => 3,
                'attributes' => [
                    'ngayTao' => [
                        'type' => Form::INPUT_TEXT,
                        'label' => 'Ngày tạo',
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
                <h4 class="style-h">Quyết định kiểm tra</h4>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soQdkt')->textInput(['maxlength' => true])->label('04. Số QDKT') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($datevalidation, 'ngayQdkt')->textInput(['placeholder' => 'dd/mm/yyyy'])->label('05. Ngày QDKT') ?>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'tienDoThucHien' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => ['0' => '0 - Dở dang','1' => '1 - Hoàn thành'],
                            'options' => ['placeholder' => Yii::t('app', 'Chọn tiến độ...'),
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
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'loaiNoiDungChuyenDeId' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => $loainoidungkiemtra,
                            'options' => ['placeholder' => Yii::t('app', 'Select a loaiNdktId ...'),
                                'data-info' => '1',
                            ],
                            'pluginEvents' => [
                                "select2:close" => "focusNextInput",
                            ],
                        ],
                        'label' => 'Loại nội dung chuyên đề'
                    ],
                ]
            ]); ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Quyết định xử lý
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soQdXuLy')->textInput(['maxlength' => true])->label('08. Số QD xử lý') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($datevalidation, 'ngayQdxl')->textInput(['placeholder' => 'dd/mm/yyyy'])->label('09. Ngày tháng') ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Kết luận kiểm tra
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soKetLuan')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($datevalidation, 'ngayKetLuan')->textInput(['placeholder' => 'dd/mm/yyyy'])->label('11. Ngày tháng') ?>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'doanhNghiepCoViPham' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => ['0' => '0 - Không vi phạm','1' => '1 - Vi phạm'],
                            'options' => ['placeholder' => Yii::t('app', 'Chọn tiến độ...'),
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
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Phân loại
            </div>
        </div>
        <div class="col-md-3">
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'loaiQuyMoDoanhNghiepId' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => $loaiquymodoanhnghiep,
                            'options' => ['placeholder' => Yii::t('app', 'Select a loaiQuyMoId...'),
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
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'loaiKhuVucDoanhNghiepId' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => $loaikhuvucdoanhnghiep,
                            'options' => ['placeholder' => Yii::t('app', 'Select a loaiKhuVucId ...'),
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
            <?= Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 4,
                'attributes' => [
                    'ghiChu6' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => Select2::className(),
                        'options' => [
                            'data' => ['20' => '20 - DNTW','21' => '21 - DNĐP'],
                            'options' => ['placeholder' => Yii::t('app', 'Chọn phân cấp ...'),
                                'data-info' => '1',
                            ],
                            'pluginEvents' => [
                                "select2:close" => "focusNextInput",
                            ],
                        ],
                        'label' => '20-21. Phân cấp Quản lý'
                    ],
                ]
            ]); ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Số thuế truy thu
            </div>
        </div>
        <div style="padding: 10px">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="usr" style="font-size: 12px;margin-left: 5px;">22. Tổng số: <code style="font-size: 20px;"><span id="22"></span> (ĐV: đồng)</code></label><br>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'soThueTruyThuVat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'soThueTruyThuTndn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'soThueTruyThuTncn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'soThueTruyThuTtdb')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'soThueTruyThuKhac')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Số thuế truy hoàn + ấn định
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soThueKhongDuocHoan')->textInput(['maxlength' => true])->label('28. Số thuế không được hoàn') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soThueTruyHoan')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'anDinh')->textInput(['maxlength' => true])->label('30. Ấn định') ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Tiền phạt
            </div>
        </div>
        <div style="padding: 10px">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="usr" style="font-size: 12px;margin-left: 5px;">31. Tổng cộng tiền phạt: <code style="font-size: 20px;"><span id="31"></span> (ĐV: đồng)</code></label><br>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tienPhat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tienKkSai')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tienPhatNopCham')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tienPhatViPhamHanhChinhKhac')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h"></h4>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="usr" style="font-size: 12px;margin-left: 15px;">36. Tổng số thuế phải nộp sau TTKT (truy thu+phạt+truy hoàn): <code style="font-size: 20px;"><span id="36"></span> (ĐV: đồng)</code></label><br>
            </div>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Nợ đọng
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'noDongNamTruoc')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'noPhatSinhTrongNam')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Đã nộp
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'daNopChoNoDongNamTruoc')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'daNopPhatSinhTrongNam')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Còn phải nộp
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'conPhaiNopDongNamTruoc')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'conPhaiNopPhatSinhTrongNam')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row style-header">
        <div class="row">
            <div class="col-md-3">
                <h4 class="style-h">
                    Số thuế truy hoàn + ấn định
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soThueDuocGiamTheoKeKhai')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'soThueDuocGiamTheoTtkt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'chenhLech')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'giamLo')->textInput(['maxlength' => true])->label('46. Giảm lỗ') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'giamKhauTru')->textInput(['maxlength' => true])->label('47. Giảm khấu trừ') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
