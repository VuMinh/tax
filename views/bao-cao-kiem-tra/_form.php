<?php

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use app\models\Nguoinopthue;
use app\models\base\Nganhnghe;
use app\models\Quyetdinhkiemtra;
use app\models\Loaikhuvucdoanhnghiep;
use app\models\Loainoidungkiemtra;
use app\models\Loaiquymodoanhnghiep;
use yii\bootstrap\Html;
use app\models\Truongdoankiemtra;
use yii\web\JsExpression;

use app\assets\BaocaokiemtraAsset;

BaocaokiemtraAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Baocaokiemtra */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhkiemtra app\models\Quyetdinhkiemtra */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */
/* @var $truongdoankiemtra app\models\Truongdoankiemtra */
/* @var $lichsunopsaukiemtra app\models\Lichsunopsaukiemtra */
/* @var $datevalidation app\models\DateValidation */
/* @var $form yii\widgets\ActiveForm */

// danh mục loại khu vực doanh nghiệp
$loaikhuvucdoanhnghiep = ArrayHelper::map(Loaikhuvucdoanhnghiep::find()->asArray()->all(), 'id', 'loaiKhuVuc');
$temp = 20;
for ($i = 1; $i < count($loaikhuvucdoanhnghiep) + 1; $i++) {
    $loaikhuvucdoanhnghiep[$i] = $temp . ' - ' . $loaikhuvucdoanhnghiep[$i];
    $temp++;
}
$loaikhuvucdoanhnghiep[0] = '00 - Không điền khu vực';
ksort($loaikhuvucdoanhnghiep);

// danh mục loại quy mô doanh nghiệp
$loaiquymodoanhnghiep = ArrayHelper::map(Loaiquymodoanhnghiep::find()->asArray()->all(), 'id', 'loaiQuyMo');
$temp = 24;
for ($i = 1; $i < count($loaiquymodoanhnghiep) + 1; $i++) {
    $loaiquymodoanhnghiep[$i] = $temp . ' - ' . $loaiquymodoanhnghiep[$i];
    $temp++;
}
$loaiquymodoanhnghiep[0] = '00 - Không điền quy mô';
ksort($loaiquymodoanhnghiep);

// danh mục loại nội dung kiểm tra
$loainoidungkiemtra = ArrayHelper::map(Loainoidungkiemtra::find()->asArray()->all(), 'id', 'loaiNd');
$temp = 27;
//workaround: Chuyển loại ngân hàng lên thứ 29
$resultArr = [];
for ($i = 1; $i < count($loainoidungkiemtra) + 1; $i++) {
    if($temp == 29) {
        $resultArr[$i] = $temp . ' - ' . $loainoidungkiemtra[count($loainoidungkiemtra)];
        $temp++;
        $i++;
    }
    $index = $i < 3 ? $i : $i - 1;
    $resultArr[$i] = $temp . ' - ' . $loainoidungkiemtra[$index];
    $temp++;
}

$resultArr[0] = '00 - Không điền nội dung';
$loainoidungkiemtra = $resultArr;
ksort($loainoidungkiemtra);

$url = \yii\helpers\Url::to(['select']);

?>

<div id="bcktform">

    <div class="row" style="margin-top:15px;">
        <div class="col-lg-12">
            <!-- .panel-heading -->
            <div class="baocaokiemtra-form" data-bind="nextFieldOnEnter:true">
                <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL,]); ?>
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span>Người nộp thuế</span>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'doiKiemTra' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '1. Đội kiếm tra',
                                                ]
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $nguoinopthue,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'maSoThue' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '2. Mã số thuế',
                                                    'widgetClass' => Select2::className(),
                                                    'initValueText' => "", // set the initial display text
                                                    'options' => [
                                                        'options' => ['placeholder' => 'Chọn mã số thuế',
                                                            'data-info' => '1',
                                                        ],
                                                        'pluginOptions' => [
                                                            'minimumInputLength' => 1,
                                                            'language' => [
                                                                'errorLoading' => new JsExpression("function () { return 'Đang xử lý...'; }"),
                                                            ],
                                                            'ajax' => [
                                                                'url' => $url,
                                                                'dataType' => 'json',
                                                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                                            ],
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
                                        <label for="usr" style="font-size: 12px;">3. Tên DN kiểm tra</label><br>
                                        <span id="nguoinopthue-tennguoinop"><?= $nguoinopthue->tenNguoiNop ? $nguoinopthue->tenNguoiNop : '' ?></span><br/>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'nganhNgheKinhDoanh' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '4. Ngành nghề kinh doanh',
                                                    'widgetClass' => Select2::className(),
                                                    'options' => [
                                                        'data' => ArrayHelper::map(Nganhnghe::find()->asArray()->all(), 'id', 'maNganhNgheKdChinh'),
                                                        'options' => ['placeholder' => Yii::t('app', 'Select a maNganhNgheKdChinh...'),
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
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="nhapquyetdinhdauvao" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseOne">I. Nhập Quyết định kiểm tra đầu vào</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" style="height: auto;">
                                <div class="panel-body">
                                    <div
                                        style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                    Quyết định kiểm tra</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $quyetdinhkiemtra,
                                                        'form' => $form,
                                                        'columns' => 4,
                                                        'attributes' => [
                                                            'soQdKiemTra' => [
                                                                'type' => Form::INPUT_TEXT,
                                                                'label' => '5. Số',
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
                                                            'ngayQdKiemTra' => [
                                                                'type' => Form::INPUT_TEXT,
                                                                'label' => '6. Ngày',
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
                                                <div class="col-md-6">
                                                    <?= Form::widget([
                                                        'model' => $quyetdinhkiemtra,
                                                        'form' => $form,
                                                        'columns' => 2,
                                                        'attributes' => [
                                                            'noDongKyTruocChuyenSang' => [
                                                                'type' => Form::INPUT_WIDGET,
                                                                'label' => '7. Cho nợ đọng kỳ trước chuyển sang',
                                                                'widgetClass' => Select2::className(),
                                                                'options' => [
                                                                    'data' => ['0' => '0 - Không', '1' => '1 - có'],
                                                                    'options' => ['placeholder' => Yii::t('app', 'Select a true or false ...'),
                                                                        'data-info' => '1',
                                                                    ],
                                                                    'pluginEvents' => [
                                                                        "select2:close" => "focusNextInput",
                                                                    ],
                                                                ],
                                                            ],
                                                            'phatSinhTrongKy' => [
                                                                'type' => Form::INPUT_WIDGET,
                                                                'label' => '8. Cho phát sinh trong kỳ',
                                                                'widgetClass' => Select2::className(),
                                                                'options' => [
                                                                    'data' => ['0' => '0 - Không', '1' => '1 - có'],
                                                                    'options' => ['placeholder' => Yii::t('app', 'Select a true or false ...'),
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
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $quyetdinhkiemtra,
                                                        'form' => $form,
                                                        'columns' => 4,
                                                        'attributes' => [
                                                            'nienDoKiemTra' => [
                                                                'type' => Form::INPUT_TEXT,
                                                                'label' => '9. Niên độ kiểm tra',
                                                                'options' => [
                                                                    'pluginOptions' => [
                                                                        'allowClear' => true
                                                                    ],
                                                                ],
                                                            ]
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $truongdoankiemtra,
                                                        'form' => $form,
                                                        'columns' => 4,
                                                        'attributes' => [
                                                            'truongDoan' => [
                                                                'type' => Form::INPUT_TEXT,
                                                                'label' => '10. Trưởng đoàn kiểm tra',
                                                            ]
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= Form::widget([
                                                        'model' => $datevalidation,
                                                        'form' => $form,
                                                        'columns' => 2,
                                                        'attributes' => [
                                                            'ngayCongBoQdkt' => [
                                                                'type' => Form::INPUT_TEXT,
                                                                'label' => '11. Ngày công bố quyết định kiểm tra',
                                                                'options' => [
                                                                    'placeholder' => 'dd/mm/yyyy',
                                                                    'data-date' => '1'
                                                                ]
                                                            ],

                                                            'ngayTrinhVbTamDungKt' => [
                                                                'type' => Form::INPUT_TEXT,
                                                                'label' => '12. Ngày trình VB tạm dừng KT',
                                                                'options' => [
                                                                    'placeholder' => 'dd/mm/yyyy',
                                                                    'data-date' => '1'
                                                                ]
                                                            ],
                                                        ]
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-3">-->
<!--                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">Tiến độ thực hiện kiểm tra</h5>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div style="padding: 10px">-->
<!--                                            <div class="row">-->
<!--                                                <div class="form-group col-md-4">-->
<!--                                                    <label for="usr" style="font-size: 12px;">13. Đang kiểm tra</label>-->
<!--                                                </div>-->
<!--                                                <div class="form-group col-md-4">-->
<!--                                                    <label for="usr" style="font-size: 12px;">14. Tổng cộng</label>-->
<!--                                                </div>-->
<!--                                                <div class="form-group col-md-4">-->
<!--                                                    <label for="usr" style="font-size: 12px;">15. Hoàn thành cho nợ đọng kỳ trước</label>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="row">-->
<!--                                                <div class="form-group col-md-4">-->
<!--                                                    <label for="usr" style="font-size: 12px;">16. Hoàn thành cho phát sinh trong kỳ</label>-->
<!--                                                </div>-->
<!--                                                <div class="form-group col-md-6">-->
<!--                                                    <label for="usr" style="font-size: 12px;">17. Trong đó: Cuộc KT có số thuế truy thu</label>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <div
                                        style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                    QĐ hoàn thành thuộc kế hoạch</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 4,
                                                        'attributes' => [
                                                            'qdHtThuocKhRuiRoTrongNam' => [
                                                                'type' => Form::INPUT_WIDGET,
                                                                'label' => '18. Trong Kế hoạch rủi ro xây dựng trong năm',
                                                                'widgetClass' => Select2::className(),
                                                                'options' => [
                                                                    'data' => ['0' => '0 - không', '1' => '1 - có'],
                                                                    'options' => ['placeholder' => Yii::t('app', 'Select a true or false ...'),
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
                                        </div>
                                    </div>
                                    <div
                                        style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                    Phân loại</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px">
                                            <?= Form::widget([
                                                'model' => $model,
                                                'form' => $form,
                                                'columns' => 4,
                                                'attributes' => [
                                                    'loaiKhuVucId' => [
                                                        'type' => Form::INPUT_WIDGET,
                                                        'label' => '20-23. Phân loại doanh nghiệp hoàn thành theo khu vực',
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
                                                    'loaiQuyMoId' => [
                                                        'type' => Form::INPUT_WIDGET,
                                                        'label' => '24-26.Phân loại doanh nghiệp hoàn thành theo qui mô',
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
                                                    'loaiNdktId' => [
                                                        'type' => Form::INPUT_WIDGET,
                                                        'label' => '27-43.Phân loại Nội dung kiểm tra hoặc chuyên đề kiểm tra',
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
                                                    ],
                                                    'kiemTraTheoQuyetToanChiDao' => [
                                                        'type' => Form::INPUT_WIDGET,
                                                        'label' => '44.Kiểm tra theo quyết toán, chỉ đạo …...',
                                                        'widgetClass' => Select2::className(),
                                                        'options' => [
                                                            'data' => ['0' => '0 - không', '1' => '1 - có'],
                                                            'options' => ['placeholder' => Yii::t('app', 'Select a true or false ...'),
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
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="nhapquyetdinhdaura" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo">II. Nhập quyết định xử lý đầu ra</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">Quyết định xử lý</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $datevalidation,
                                                        'form' => $form,
                                                        'attributes' => [
                                                            'ngayKyBbkt' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '45. Ngày ký Biên bản kiểm tra',
                                                                'options' => ['placeholder' => 'dd/mm/yyyy',
                                                                    'data-date' => '1'
                                                                ],
                                                            ],
                                                        ],
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $datevalidation,
                                                        'form' => $form,
                                                        'attributes' => [
                                                            'soQdxl' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '46. Số QĐ xử phạt vi phạm PL về thuế',
                                                            ],
                                                        ],
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $datevalidation,
                                                        'form' => $form,
                                                        'attributes' => [
                                                            'ngayQdXuLy' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '47. Ngày tháng ra QD xử lý',
                                                                'options' => ['placeholder' => 'dd/mm/yyyy',
                                                                    'data-date' => '1'
                                                                ],
                                                            ]
                                                        ],
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">Kết quả xử lý sau kiểm tra</h5>
                                                </div>
                                            </div>
                                            <div style="padding: 10px">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="usr" style="font-size: 12px;">48. Tổng cộng truy thu, thu hồi hoàn và phạt: <code style="font-size: 20px;"><span id="48"></span> (ĐV: đồng)</code></label><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                        Truy thu thuế</h5>
                                                </div>
                                            </div>
                                            <div style="padding: 10px">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="usr" style="font-size: 12px;">49. Cộng thuế truy thu:
                                                            <code style="font-size: 20px;"><span id="49"></span> (ĐV: đồng)</code></label><br>
                                                    </div>
                                                </div>
                                                <?= Form::widget([
                                                    'model' => $model,
                                                    'form' => $form,
                                                    'columns' => 4,
                                                    'attributes' => [
                                                        'truyThuThueGtgt' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '50. Thuế GTGT',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'truyThuThueTndn' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '51. Thuế TNDN',
                                                            'options' => [
                                                                'data-int' => '1',
                                                            ]
                                                        ],
                                                        'truyThuThueTncn' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '52. Thuế TNCN',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'truyThuThueKhac' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '53. Thuế khác',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                    ]
                                                ]); ?>
                                            </div>
                                        </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                        Truy hoàn thuế</h5>
                                                </div>
                                            </div>
                                            <div style="padding: 10px">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="usr" style="font-size: 12px;">54. Cộng thuế truy hoàn:
                                                            <code style="font-size: 20px;"><span id="54"></span> (ĐV: đồng)</code></label><br>
                                                    </div>
                                                </div>
                                                <?= Form::widget([
                                                    'model' => $model,
                                                    'form' => $form,
                                                    'columns' => 4,
                                                    'attributes' => [
                                                        'truyHoanThueGtgt' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '55. Thuế GTGT',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'truyHoanThueTncn' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '56. Thuế TNCN',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'truyHoanThueKhac' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '57. Thuế khác',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                    ]
                                                ]); ?>
                                            </div>
                                        </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                        Phạt</h5>
                                                </div>
                                            </div>
                                            <div style="padding: 10px">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="usr" style="font-size: 12px;">58.Cộng phạt:
                                                            <code id="tongphat" style="font-size: 20px;"><span id="58"></span> (ĐV: đồng)</code></label><br>
                                                    </div>
                                                </div>
                                                <?= Form::widget([
                                                    'model' => $model,
                                                    'form' => $form,
                                                    'columns' => 4,
                                                    'attributes' => [
                                                        'phatTronThue' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '59. Về HV trốn lậu thuế (Phạt lần thuế)',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'phatHanhChinhKhac1020' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '60. Về vi phạm HC khác (10%-20%)',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'phatChamNop' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '61. Phạt  chậm nộp ( Tiền phạt 0.05%)',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                        'phatKhac' => ['type' => Form::INPUT_TEXT,
                                                            'label' => '62. Phạt khác',
                                                            'options' => [
                                                                'data-int' => '1'
                                                            ]
                                                        ],
                                                    ]
                                                ]); ?>
                                            </div>
                                        </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">Miễn, giảm ưu đãi thuế</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 3,
                                                        'attributes' => [
                                                            'thueMienGiamTheoKeKhai' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '75. Số thuế được miễn giảm ưu đãi',
                                                                'options' => ['data-int' => '1'],
                                                                'format' => ['decimal', 0]
                                                            ],
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 3,
                                                        'attributes' => [
                                                            'thueMienGiamTheoKiemTra' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '76. Số thuế miễn giảm ưu đãi theo KT',
                                                                'options' => ['data-int' => '1'],
                                                            ],
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 3,
                                                        'attributes' => [
                                                            'mienGiamChenhLech' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '77. Chênh lệch',
                                                                'options' => ['data-int' => '1'],
                                                            ]
                                                        ]
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 3,
                                                        'attributes' => [
                                                            'giamKhauTru' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '78. Giảm khấu trừ',
                                                                'options' => ['data-int' => '1'],
                                                            ]
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 3,
                                                        'attributes' => [
                                                            'thueKhongDuocHoan' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '79. Số thuế không được hoàn',
                                                                'options' => ['data-int' => '1'],
                                                            ]
                                                        ]
                                                    ]); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?= Form::widget([
                                                        'model' => $model,
                                                        'form' => $form,
                                                        'columns' => 3,
                                                        'attributes' => [
                                                            'giamLo' => ['type' => Form::INPUT_TEXT,
                                                                'label' => '80. Giảm lỗ',
                                                                'options' => ['data-int' => '1'],
                                                            ]
                                                        ]
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <?= $form->field($model, 'ghiChu')->textInput()->label('81.Ghi chú (Nhập đúng kì BC từ 25 tháng này tới 25 tháng sau: 1-đúng, 0-sai)') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="notruythu" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseThree">III. Nợ sau truy thu</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">

                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                                    Đọng kỳ trước chuyển sang</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="usr" style="font-size: 12px;">63. Tổng cộng:
                                                        <code style="font-size: 20px;"><span id="63"></span> (ĐV: đồng)</code></label><br>
                                                </div>
                                            </div>
                                            <?= Form::widget([
                                                'model' => $model,
                                                'form' => $form,
                                                'columns' => 4,
                                                'attributes' => [
                                                    'noDongNamTruocChuyenSang' => ['type' => Form::INPUT_TEXT,
                                                        'label' => '64. Nợ cho số năm trước',
                                                        'options' => [
                                                            'data-int' => '1'
                                                        ]
                                                    ],
                                                    'noDongPhatSinhTrongNam' => ['type' => Form::INPUT_TEXT,
                                                        'label' => '65. Nợ phát sinh trong năm',
                                                        'options' => [
                                                            'data-int' => '1'
                                                        ]
                                                    ],
                                                ]
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">Đã nộp vào NSNN</h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="usr" style="font-size: 12px;">66. Tổng cộng đã nộp vào NSNN:
                                                        <code style="font-size: 20px;"><span id="66"></span> (ĐV: đồng)</code></label><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="usr" style="font-size: 12px;">68. Tổng cộng nộp cho số phát sinh:
                                                        <code style="font-size: 20px;"><span id="68"></span> (ĐV: đồng)</code></label><br>
                                                </div>
                                            </div>
                                            <?= Form::widget([
                                                'model' => $lichsunopsaukiemtra,
                                                'form' => $form,
                                                'columns' => 4,
                                                'attributes' => [
                                                    'daNopDongNamTruoc' => ['type' => Form::INPUT_TEXT,
                                                        'label' => '67. Nộp cho số đọng năm trước',
                                                        'options' => [
                                                            'data-int' => '1'
                                                        ]
                                                    ],
                                                    'daNopPhatSinhTruyThu' => ['type' => Form::INPUT_TEXT,
                                                        'label' => '69. Nộp cho truy thu',
                                                        'options' => [
                                                            'data-int' => '1'
                                                        ]
                                                    ],
                                                    'daNopPhatSinhTruyHoan' => ['type' => Form::INPUT_TEXT,
                                                        'label' => '70. Nộp cho truy hoàn',
                                                        'options' => [
                                                            'data-int' => '1'
                                                        ]],
                                                    'daNopTienPhat' => ['type' => Form::INPUT_TEXT,
                                                        'label' => '71. Nộp tiền phạt',
                                                        'options' => [
                                                            'data-int' => '1'
                                                        ]],
                                                ]
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">Đọng chuyển kỳ sau </h5>
                                            </div>
                                        </div>
                                        <div style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="usr" style="font-size: 12px;">72. Tổng cộng</label>
                                                    <code style="font-size: 20px;"><span id="72"></span > (ĐV: đồng)</code><br/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="usr" style="font-size: 12px;">73. Nợ năm trước</label>
                                                    <code style="font-size: 20px;"><span id="73"></span> (ĐV: đồng)</code><br/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="usr" style="font-size: 12px;">74. Phát sinh trong năm</label>
                                                    <code style="font-size: 20px;"><span id="74"></span> (ĐV: đồng)</code><br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a id="hanhvi" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFour">IV. Hành vi vi phạm</a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body" style="padding: 0">
                                    <div style="background-color: aliceblue;">
                                        <div style="padding: 10px">
                                            <?= $form->field($model, 'hanhViViPham')->textarea(['rows' => 6])->label('82. Hành vi vi phạm') ?>

                                            <?= $form->field($model, 'moTaCachThucPhatHien')->textarea(['rows' => 6])->label('83. Mô tả cách thức thực hiện') ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <!-- .panel-body -->
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->

