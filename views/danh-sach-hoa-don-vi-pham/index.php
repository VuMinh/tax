<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\DateTimeHelpers;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DanhsachhoadonviphamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Danhsachhoadonviphams');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="danhsachhoadonvipham-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->session->hasFlash('error')){?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php } else if(Yii::$app->session->hasFlash('success')) {?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php }?>
    <div class="row">
        <div class="pull-left">
            <p>
                <?= Html::a(Yii::t('app', 'Create Danhsachhoadonvipham'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '06- Tổng hợp dữ liệu VP trên biên bản TT, KT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\ExportExcel();
            echo $this->render('/danh-sach-hoa-don-vi-pham/export-excel-bao-cao-hoa-don-vi-pham', ['model' => $model]);
            Modal::end();
            ?>
            <?php
                Modal::begin([
                    'toggleButton' => [
                        'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Nhập dữ liệu'),
                        'class' => 'btn btn-warning'
                    ],
                    'closeButton' => [
                        'label' => Yii::t('app', 'Close'),
                        'class' => 'btn btn-danger btn-sm pull-right',
                    ],
                    'size' => 'modal-md',
                ]);
                $bhxh = new \app\models\ExcelUploadForm();
                echo $this->render('/danh-sach-hoa-don-vi-pham/import-excel', ['bhxh' => $bhxh]);
                Modal::end();
            ?>
            <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-download-alt"></span> Tải tệp mẫu'), ['download'], ['class' => 'btn btn-danger ']) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'STT',
                'headerOptions' => [
                    'style' => 'text-align:center; width:20px;'
                ],
                'contentOptions' => [
                    'style' => 'width:20px'
                ],
                'value' => function ($model) {
                    $hoadon = \app\models\Danhsachhoadonvipham::find()->all();
                    foreach ($hoadon as $key => $value) {
                        if ($model->id == $value['id'])
                            return $key + 1;
                    }

                    return 0;
                }

            ],
            [
                'attribute' => 'ghiChu',
                'value' => 'mstDnMua0.maSoThue',
                'label' => 'MST DN mua'
            ],
            [
                'attribute' => 'ghiChu1',
                'value' => 'mstDnMua0.tenNguoiNop',
                'label' => 'DN mua'
            ],
            'tenChuDn',
            [
                'attribute' => 'ngayBaoCao',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayBaoCao);
                },
            ],
             'soHoaDon',
             'ngayPhatHanhHoaDon',
             'tenHangHoa',
//             'giaTriHangChuaThue',
//             'thueVat',
//             'dauHieuViPham:ntext',
//             'tenChuDn',
//             'cmt',
//             'ngayThayDoiChuSoHuuGanNhat',
//             'ngayThayDoiDiaDiemGanNhat',
//             'thongBaoBoTron',
//             'ngayBoTron',
//             'coQuanThueQuanLyDnBan',
//             'coQuanThueRaQdxl',
//             'ghiChu',
            // 'ghiChu1',
            // 'ghiChu2',

//            ['class' => 'yii\grid\ActionColumn'],
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
</div>
