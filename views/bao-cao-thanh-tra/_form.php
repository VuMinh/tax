<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use app\assets\BaocaothanhtraAsset;
use yii\web\JsExpression;
use app\models\base\Quyetdinhthanhtra;
use app\models\Baocaothanhtra;
use app\models\Nguoinopthue;
use app\models\Quyetdinhtruythu;
BaocaothanhtraAsset::register($this);
$url = \yii\helpers\Url::to(['select']);
/* @var $this yii\web\View */
/* @var $model app\models\Baocaothanhtra */
/* @var $quyetdinhttra app\models\Quyetdinhthanhtra */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhtruythu app\models\Quyetdinhtruythu */
/* @var $lichsunopthanhtra app\models\Lichsunopthanhtra */
/* @var $datevalidation app\models\DateValidation */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="row" style="margin-top:15px;">
        <!-- .panel-heading -->
        <div class="baocaothanhtra-form" data-bind="nextFieldOnEnter:true">
            <input type="hidden" id="idvalue" value=""/>
            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL,]); ?>
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <span>I. Kiểm tra</span>
                            </h4>
                        </div>
                        <div class="panel-body disable_load">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= Form::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'columns' => 1,
                                        'attributes' => [
                                            'doiKiemTra' => [
                                                'type' => Form::INPUT_TEXT,
                                                'label' => '1. Đội kiểm tra',
                                            ],
                                        ]
                                    ]); ?>
                                </div>
                                <div class="col-md-3">
                                    <?= Form::widget([
                                        'model' => $nguoinopthue,
                                        'form' => $form,
                                        'attributes' => [
                                            'maSoThue' => [
                                                'type' => Form::INPUT_WIDGET,
                                                'widgetClass' => Select2::className(),
                                                'label' => '2. MST',
                                                'options' => [
                                                    'options' => ['placeholder' => Yii::t('app', 'Select a mst...'),
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
                                    <label for="usr" style="font-size: 12px;">3. Tên Dv</label><br>
                                    <span id="tendoanhnghiep"><?= $nguoinopthue->tenNguoiNop ? $nguoinopthue->tenNguoiNop : '' ?></span><br/>
                                </div>
                                <div class="col-md-3">
                                    <?= Form::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'columns' => 1,
                                        'attributes' => [
                                            'truongDoan' => [
                                                'type' => Form::INPUT_TEXT,
                                                'label' => '4. Trưởng đoàn',
                                            ]
                                        ]
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a id="quyetdinhthanhtra" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseOne">II. Quyết định thanh tra</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" style="height: auto;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $quyetdinhttra,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soQdThanhTra' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '5. QD thanh tra',
                                                ],
                                            ],
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 1,
                                            'attributes' => [
                                                'ngayQdThanhTra' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '6. Ngày(dd/mm/yyyy)',
                                                    'options' => ['placeholder' => Yii::t('app', 'dd/mm/yyyy'),
                                                        'data-date' => '1',
                                                    ],
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
                                <a id="tongthuthue" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseThree">III. Tổng thu</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="" style="font-size: 12px">7. Tổng thu</label>
                                        <code style="font-size: 20px;"><span id="7"></span> đ</code><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'vatTruyThu' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '8. VAT',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ],
                                                'tndn' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '9. TNDN',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ],
                                                'ttdb' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '10. TTBD',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ],
                                                'tncn' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '11. TNCN',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'monBai' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '12. Môn bài',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ],
                                                'tienPhat005' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '13. Thu khác',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ],
                                                'tienPhat1020' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '14. Tiền phạt',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
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
                                <a id="qdtruythu" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseFour">IV. Quyết đinh truy thu</a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $quyetdinhtruythu,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soQdTruyThu' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '15. Số QD truy thu',
                                                ],
                                            ]
                                        ]) ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'ngayQdTruyThu' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '16. Ngày QD(dd/mm/yyyy)',
                                                    'options' => ['placeholder' => Yii::t('app', 'dd/mm/yyyy'),
                                                        'data-date' => '1',
                                                    ],
                                                ]
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
                                <a id="nopthanhtra" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseFive">V. Lịch sử nộp thanh tra</a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $lichsunopthanhtra,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'daNopThue' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'label' => '17. Số tiền doanh nghiệp đã nộp',
                                                    'options' => [
                                                        'data-int' => '1',
                                                    ]
                                                ]
                                            ]
                                        ]) ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" style="font-size: 12px;">19. Số tiền DN chưa nộp</label><br>
                                        <code style="font-size: 20px;"><span id="19"></span> đ</code><br>
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
        </div>
    </div>

<?php ActiveForm::end(); ?>

<?php