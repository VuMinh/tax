<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\form\ActiveForm;
use kartik\builder\Form;

use yii\web\JsExpression;
use app\models\Vanban;
use app\models\Sotheodoisauhoanthue;
use app\assets\SotheodoisauhoanthueAsset;
use app\models\Quyetdinhkiemtra;
use app\models\Quyetdinhthanhtra;
use app\models\Lydohoanthue;
use app\models\Quyetdinhthuhoihoanthue;

SotheodoisauhoanthueAsset::register($this);

$url = \yii\helpers\Url::to(['select']);

/* @var $this yii\web\View */
/* @var $model app\models\SoTheoDoiSauHoanThue */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhkt app\models\Quyetdinhkiemtra */
/* @var $quyetdinhttra app\models\Quyetdinhthanhtra */
/* @var $quyetdinhth app\models\Quyetdinhthuhoihoanthue */
/* @var $lichsunophoanthue app\models\Lichsunopquyhoanthue */
/* @var $vanban app\models\Vanban */
/* @var $quyetdinhxp app\models\Quyetdinhxuphat */
/* @var $datevalidation app\models\DateValidation */
/* @var $form yii\widgets\ActiveForm */

$lydohoanthue = ArrayHelper::map(Lydohoanthue::find()->all(), 'id', 'lyDoHoanThue', 'group');
?>

<div id="stdshform" class="so-theo-doi-sau-hoan-thue-form">
    <div class="row" style="margin-top:15px;">
        <!-- .panel-heading -->
        <div class="sotheodoisauhoanthue-form" data-bind="nextFieldOnEnter:true">
            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL,]); ?>
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <span>I. Theo dõi sau hoàn thuế</span>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= Form::widget([
                                        'model' => $nguoinopthue,
                                        'form' => $form,
                                        'columns' => 4,
                                        'attributes' => [
                                            'maSoThue' => [
                                                'type' => Form::INPUT_WIDGET,
                                                'widgetClass' => Select2::className(),
                                                'label' => '1. Mã số thuế',
                                                'options' => [
                                                    'options' => ['placeholder' => Yii::t('app', 'Select a mst ...'),
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
                                                ]
                                            ],
                                        ]
                                    ]); ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="usr" style="font-size: 12px;">2. Tên doanh nghiệp</label><br>
                                    <span
                                            id="nguoinopthue-tennguoinop"><?= $nguoinopthue->tenNguoiNop ? $nguoinopthue->tenNguoiNop : '' ?></span><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a id="quyetdinhkiemtra-thanhtra" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseTwo">
                                    II. Quyết định kiểm tra/thanh tra</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body">
                                <div class="row">
                                    <!--create table QDKT-->
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'attributes' => [
                                                'loaiQd' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => 'Loại Quyết định',
                                                    'widgetClass' => Select2::className(),
                                                    'options' => [
                                                        'data' => ['1' => '0 - QĐ Kiểm tra', '2' => '1 - QĐ Thanh tra'],
                                                        'options' => ['placeholder' => Yii::t('app', 'Select a QĐ...'),
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
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 1,
                                            'attributes' => [
                                                'soQd' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'widgetClass' => Select2::className(),
                                                    'label' => '3-4. Số QĐKT/Số QĐTT',
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 1,
                                            'attributes' => [
                                                'ngayQdKiemTra' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'widgetClass' => Select2::className(),
                                                    'label' => '5. Ngày QD(dd/mm/yyyy)',
                                                    'options' => [
                                                        'placeholder' => 'dd/mm/yyyy',
                                                        'data-date' => '1',
                                                    ],
                                                ],
                                            ]
                                        ]); ?>

                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'attributes' => [
                                                'thoiKyThanhTra' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '6. Thời kỳ TTra',
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'maChuong' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '7. Mã chương',
                                                ]
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'laToChuc' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '8. Tổ chức/cá nhân',
                                                    'widgetClass' => Select2::className(),
                                                    'options' => [
                                                        'data' => ['0' => '0 - Cá nhân', '1' => '1 - Tổ chức'],
                                                        'options' => ['placeholder' => Yii::t('app', 'Select a organization...'),
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
                                <a id="truonghophoanthue" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseOne">III. Trường hợp hoàn thuế</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'loaiHoanThueId' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '9. Trường hợp hoàn thuế',
                                                    'widgetClass' => Select2::className(),
                                                    'options' => [
                                                        'data' => $lydohoanthue,
                                                        'options' => [
                                                            'placeholder' => Yii::t('app', 'Select a organization...'),
                                                            'data-info' => '1',
                                                        ],
                                                        'pluginEvents' => [
                                                            "select2:close" => "focusNextInput",
                                                        ],
                                                    ],
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soThueDeNghiHoan' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '10. Số thuế đề nghị hoàn',
                                                ],
                                                'soThueKhongDuocHoan' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '11. Số thuế không được hoàn',
                                                ],
                                            ],
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a id="quyetdinhthuhoi" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseThree">IV. Quyết định thu hồi</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $quyetdinhth,
                                            'form' => $form,
                                            'columns' => 3,
                                            'attributes' => [
                                                'soQdThuHoiHoan' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '12. Số quyết định thu hồi hoàn',
                                                    'options' => [
                                                        'pluginEvents' => [
                                                            "select2:close" => "focusNextInput",
                                                        ],
                                                    ]
                                                ]
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 3,
                                            'attributes' => [
                                                'ngayQdThuHoiHoan' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '13. Ngày QD(dd/mm/yyyy)',
                                                    'options' => [
                                                        'placeholder' => 'dd/mm/yyyy',
                                                        'data-date' => '1'
                                                    ],
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $quyetdinhth,
                                            'form' => $form,
                                            'columns' => 3,
                                            'attributes' => [
                                                'soTienThueThuHoi' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '14. Số tiền thuế thu hồi',
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
                                <a id="quyetdinhxuphat" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseFour">V. Quyết định xử phạt</a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $quyetdinhxp,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'soQdXuPhat' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '15. Số quyết định xử phạt',
                                                    'options' => [
                                                        'pluginEvents' => [
                                                            "select2:close" => "focusNextInput",
                                                        ],
                                                    ]
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'ngayQdXuPhat' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '16. Ngày QDXP(dd/mm/yyyy)',
                                                    'options' => [
                                                        'placeholder' => 'dd/mm/yyyy',
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                        'data-date' => '1'
                                                    ],
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= Form::widget([
                                            'model' => $quyetdinhxp,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soTienPhatViPham' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '17. Số tiền vi phạm',
                                                ],
                                                'tienChamNop' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '18. Tiền chậm nộp',
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a id="vanbanhoanthue" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseFive">VI. Văn bản hoàn thuế</a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <!--create table QDKT-->
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $vanban,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'soVb' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '19. Số VB hoàn thuế',
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'ngayVb' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '20. Ngày VB(dd/mm/yyyy)',
                                                    'options' => [
                                                        'placeholder' => 'dd/mm/yyyy',
                                                        'data-date' => '1'
                                                    ],
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= Form::widget([
                                            'model' => $vanban,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soTienThue' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '21. Số tiền thuế',
                                                ],
                                                'soTienLai' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '22. Số tiền lãi',
                                                ]
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
                                <a id="danopnsnn" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseSix">VII. Đã nộp NSNN</a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $lichsunophoanthue,
                                            'form' => $form,
                                            'attributes' => [
                                                'daNopThueThuHoi' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '23. Số thuế thu hồi',
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= Form::widget([
                                            'model' => $quyetdinhxp,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soTienPhatViPham' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '24. Tiền phạt vi phạm',
                                                ],
                                                'tienChamNop' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '25. Tiền chậm nộp',
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?= $form->field($model, 'chiTietHanhViViPham')->textarea(['rows' => 6])->label('26. Chi tiết HVVP') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?= $form->field($model, 'ghiChu')->textarea(['rows' => 6])->label('27. Ghi chú') ?>
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
    </div>
</div>
