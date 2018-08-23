<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\ExportExcel;
use app\helpers\DateTimeHelpers;
use app\models\Lichsunopsaukiemtra;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BaocaokiemtraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Baocaokiemtras') . ' :';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaokiemtra-index">

    <h1><?= Html::encode($this->title) . ' <span style="color: red"> Xuất vào 24 hàng tháng</span>' ?></h1>
    <div class="row">
        <div class="pull-left">
            <p>
                <?= Html::a(Yii::t('app', 'Create Baocaokiemtra'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '05a-BC nợ kiểm tra'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\DateExcelExport();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-no-kiem-tra', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '012-BC số tồn'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-so-ton', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '03-BC Hành Vi vi phạm'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-hanh-vi-vi-pham', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '02-BC chi tiết KQKT tại trụ sở NNT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-kiem-tra', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>
    <div class="row">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Xuất BC Giao Ban'),
                    'class' => 'btn btn-warning'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-giao-ban-thang', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'BC THKT tại trụ sở NNT'),
                    'class' => 'btn btn-warning'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-tinh-hinh-kiem-tra', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'BC Tồn trên 30 ngày'),
                    'class' => 'btn btn-warning'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-danh-sach-quyet-dinh-tren-30-ngay', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>

    <div class="row" style="padding-top:10px">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Báo cáo HVVP mẫu mới'),
                    'class' => 'btn btn-primary'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-hanh-vi-vi-pham-mau-moi', ['model' => $model]);
            Modal::end();
            ?>

            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Báo cáo tồn >30 ngày mẫu mới'),
                    'class' => 'btn btn-primary'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-ton-tren30-ngay-mau-moi', ['model' => $model]);
            Modal::end();
            ?>

            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '02-BC chi tiết KT mẫu mới'),
                    'class' => 'btn btn-primary'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-kiem-tra-chi-tiet-mau-moi', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>

</div>
<?php
$count = 1;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'header' => 'STT',
        ],

        ['attribute' => 'mst',
            'value' => 'mst0.maSoThue',
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'attribute' => 'doiKiemTra',
            'value' => 'mst0.tenNguoiNop',
            'label'=> 'Tên người nộp thuế',
            'headerOptions' => [
                'style' => 'text-align:center; width:350px;',
            ],
            'contentOptions' => [
                'width:350px;'
            ]
        ],
        [
            'attribute' => 'soQdktId',
            'value' => 'soQdkt.soQdKiemTra',
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'attribute' => 'soQdkt.ngayQdKiemTra',
            'label' => 'Ngày QDKT',
            'value' => function ($model) {
                if ($model->soQdkt && $model->soQdkt->ngayQdKiemTra != "") {
                    return DateTimeHelpers::convertDate($model->soQdkt->ngayQdKiemTra);
                } else {
                    return "";
                }
            },
        ],
        [
            'attribute' => 'soQdkt.ngayTao',
            'label' => 'Ngày Tạo <br> QDKT',
            'encodeLabel' => false,
            'value' => function ($model) {
                if ($model->soQdkt && $model->soQdkt->ngayTao != "") {
                    return DateTimeHelpers::convertDate($model->soQdkt->ngayTao);
                } else {
                    return "";
                }
            },
        ],
        [
            'attribute' => 'soQdXuLy.ngayTao',
            'label' => 'Ngày tạo <br> QDXL',
            'encodeLabel' => false,
            'value' => function ($model) {
                if ($model->soQdXuLy && $model->soQdXuLy->ngayTao != "") {
                    return DateTimeHelpers::convertDate($model->soQdXuLy->ngayTao);
                } else {
                    return "Còn tồn";
                }
            },
        ],
        [
            'attribute' => 'soQdXuLyId',
            'value' => function ($model) {
                /** @var \app\models\Baocaokiemtra $model */
                if ($model->soQdXuLy && $model->soQdXuLy->soQdXuLy != "") {
                    return $model->soQdXuLy->soQdXuLy;
                } else {
                    return "Còn tồn";
                }
            },
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'attribute' => 'ghiChu2',
            'label' => 'Ngày QDXL',
            'value' => function ($model) {
                if ($model->soQdXuLy && $model->soQdXuLy->soQdXuLy != "") {
                    return DateTimeHelpers::convertDate($model->soQdXuLy->ngayQdXuLy);
                } else {
                    return "";
                }
            },
        ],
        [
            'attribute' => 'truongDoan',
            'value' => 'soQdkt.truongDoan.truongDoan',
            'label' => 'Trưởng đoàn',
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'attribute' => 'qdHtThuocKhRuiRoTrongNam',
            'label' => 'Trong KH:1<br>Ngoài KH:0',
            'value' => function ($model) {
                /** @var \app\models\Baocaokiemtra $model */
                return $model->qdHtThuocKhRuiRoTrongNam == 1 ? 1 : 0;
            },
            'encodeLabel' => false,
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'label' => 'Tổng truy thu<br>ĐV: đồng',
            'value' => function ($model) {
                return number_format($model->truyThuThueGtgt + $model->truyThuThueTndn + $model->truyThuThueTncn + $model->truyThuThueKhac + $model->truyHoanThueGtgt + $model->truyHoanThueTncn + $model->truyHoanThueKhac + $model->phatTronThue + $model->phatHanhChinhKhac1020 + $model->phatChamNop + $model->phatKhac, 0, ',', ',');
            },
            'encodeLabel' => false,
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'label' => 'Tổng nợ<br>ĐV: đồng',
            'value' => function ($model) {
                $x = Lichsunopsaukiemtra::find()->where(['=', 'soQdktId', $model->id])->orderBy('thoiDiemNop DESC')->one();

                if ($x) {
                    return number_format($model->truyThuThueGtgt + $model->truyThuThueTndn + $model->truyThuThueTncn + $model->truyThuThueKhac + $model->truyHoanThueGtgt + $model->truyHoanThueTncn + $model->truyHoanThueKhac + $model->phatTronThue + $model->phatHanhChinhKhac1020 + $model->phatChamNop + $model->phatKhac
                        + $model->noDongNamTruocChuyenSang + $model->noDongPhatSinhTrongNam
                        - $x->daNopDongNamTruoc - $x->daNopPhatSinhTruyThu - $x->daNopPhatSinhTruyHoan - $x->daNopTienPhat, 0, ',', ',');
                }
                return 0;
            },

            'encodeLabel' => false,
            'headerOptions' => [
                'style' => 'text-align:center; width:120px;'
            ],
            'contentOptions' => [
                'style' => 'width:120px'
            ]
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Thao tác',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => '{view}{update}{delete}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('app', 'view'),
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    if (Yii::$app->user->identity->username == 'admin') {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            'data-confirm' => 'Ban có chắc muốn xóa mục này không?',
                            'data-method' => 'post',
                        ]);
                    }
                    return null;
                }
            ],
        ],
    ],
]); ?>
