<?php

use yii\helpers\Html;
use app\models\Baocaobaohiemxahoi;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use yii\widgets\InputWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaobaohiemxahoi */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhxuly app\models\Quyetdinhxuly */
/* @var $baocaobaohiemxahoitheonam app\models\Baocaobaohiemxahoitheonam */
/* @var $datevalidation app\models\Baocaobaohiemxahoitheonam */
/* @var $form yii\widgets\ActiveForm */
use app\assets\BaocaobaohiemxahoiAsset;

BaocaobaohiemxahoiAsset::register($this);
$url = \yii\helpers\Url::to(['select']);

?>
<div class="row" style="margin-top:15px;">
    <div class="col-lg-12">
        <div id="bcbhxhform" class="baocaobaohiemxahoi-form" data-bind="nextFieldOnEnter:true"
             ng-controller="bcktCtrl" ng-app="ttxApp">
            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>
            <input type="hidden" id="mst" value="<?= $nguoinopthue->id ?>">
            <input type="hidden" id="qdxl" value="<?= $quyetdinhxuly->id ?>">
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <span> Nhập báo cáo bảo hiểm xã hội<br></span>
                            </h5>
                        </div>
                        <input type="hidden" id="idvalue" value=""/>
                        <input type="hidden" id="idbcbhxhtn" value="">
                        <div class="panel-body">
                            <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                    Người nộp thuế</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $nguoinopthue,
                                            'form' => $form,
                                            'columns' => 3,
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
                            </div>

                            <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                    Quyết định xử lý đầu ra</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $quyetdinhxuly,
                                            'form' => $form,
                                            'columns' => 2,
                                            'attributes' => [
                                                'soQdXuLy' => [
                                                    'type' => Form::INPUT_TEXT,
                                                    'widgetClass' => Select2::className(),
                                                    'label' => '05. Số quyết định xử lý đầu ra',
                                                    'options' => [
                                                        'type' => Form::INPUT_TEXT,
                                                        'options' => ['placeholder' => Yii::t('app', 'Chọn số quyết định đầu ra ...'),
                                                            'data-info' => '1',
                                                        ],
                                                    ]
                                                ],
                                            ]
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= Form::widget([
                                            'model' => $datevalidation,
                                            'form' => $form,
                                            'attributes' => [
                                                'ngayQdXuLy' => ['type' => Form::INPUT_TEXT,
                                                    'label' => '06. Ngày quyết định xử lý',
                                                    'options' => ['placeholder' => 'dd/mm/yyyy',
                                                        'data-date' => '1'
                                                    ],
                                                ]
                                            ],
                                        ]); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="usr" style="font-size: 12px;margin-left: 15px;">07. Phòng chi
                                            cục</label>
                                        <?= $form->field($model, 'phongChiCucThue')->textInput(['maxlength' => true, 'value' => 'Chi cục thuế X'])->label(false) ?>
                                    </div>
                                </div>
                            </div>

                            <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                                <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                                    Hành vi vi phạm</h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <?= Form::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 4,
                                            'attributes' => [
                                                'viPhamBhxh' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '9. Vi phạm BHXH',
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
                                                'viPhamKpcd' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '10. Vi phạm KPCĐ',
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
                                                'coKtndKpcd' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '11. Kiểm tra ND KPCĐ',
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
                                                'coKtndBhxh' => [
                                                    'type' => Form::INPUT_WIDGET,
                                                    'label' => '12. Kiểm tra ND BHXH',
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
                                        ])
                                        ?>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <?= Form::widget([
                                                    'model' => $model,
                                                    'form' => $form,
                                                    'attributes' => [
                                                        'soDvThanhTraKiemTraHoanThanh' => [
                                                            'type' => Form::INPUT_TEXT,
                                                            'label' => '13. Số đơn vị TTKT hoàn thuế',
                                                            'pluginEvents' => [
                                                                "select2:close" => "focusNextInput",
                                                            ],
                                                        ]
                                                    ]
                                                ]
                                            ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;">
                        <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                            Ghi chú </h5>
                        <?= $form->field($model, 'ghiChu')->textarea(['rows' => 2])->label('14. Ghi chú') ?>
                        <div class="row" id="notice">
                        </div>
                    </div>
                    <div style="background-color: aliceblue;border: 1px solid #dbdbdb;margin-bottom: 10px;overflow: scroll;">
                        <h5 style="background: #a6e1ec;padding: 10px;margin-top: 0;border-bottom: 1px solid #dbdbdb;border-right: 1px solid #dbdbdb">
                            BHXH theo năm</h5>
                        <table class="table table-bordered table-hover table-center" style="width: 1300px">
                            <thead>
                            <tr class="">
                                <th>Năm</th>
                                <th>Số lao động đã trích BHXH</th>
                                <th>Số lao động chưa trích BHXH</th>
                                <th>Số lao động trích KPCĐ</th>
                                <th>Số lao động chưa trích KPCĐ</th>
                                <th>Số BHXH phải nộp</th>
                                <th>Số BHXH đã nộp</th>
                                <th>Số KPCĐ phải nộp</th>
                                <th>Số KPCĐ đã nộp</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($baocaobaohiemxahoitheonamModel as $key => $baocaobaohiemxahoitheonam) {
                                ?>
                                <tr>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'namKtbhxh')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[namKtbhxh]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[namKtbhxh]' ])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'laoDongTrichBhxh')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongTrichBhxh]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongTrichBhxh]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'laoDongChuaTrichBhxh')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongChuaTrichBhxh]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongChuaTrichBhxh]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'laoDongTrichKpcd')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongTrichKpcd]','id' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongTrichKpcd]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'laoDongChuaTrichKpcd')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongChuaTrichKpcd]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[laoDongChuaTrichKpcd]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'soBhxhPhaiNop')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[soBhxhPhaiNop]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[soBhxhPhaiNop]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'soBhxhDaNop')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[soBhxhDaNop]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[soBhxhDaNop]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'soKpcdPhaiNop')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[soKpcdPhaiNop]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[soKpcdPhaiNop]'])->label(false) ?></td>
                                    <td><?= $form->field($baocaobaohiemxahoitheonam, 'soKpcdDaNop')->textInput(['maxlength' => true, 'name' => 'Baocaobaohiemxahoitheonam'.$key.'[soKpcdDaNop]', 'id' => 'Baocaobaohiemxahoitheonam'.$key.'[soKpcdDaNop]'])->label(false) ?></td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$css = <<<CSS
    
    #btnthem{
    margin-left: 2px;
    margin-bottom: 10px;
    }
    
    .form-group {
        margin-bottom: 30px;
        padding-left: 10px;
    }
    
    .panel-body {
        padding: 0;
        border: none;
    }

CSS;
$this->registerCss($css, [\yii\web\View::POS_HEAD]);

?>
