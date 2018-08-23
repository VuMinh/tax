<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\ExportExcel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SoTheoDoiSauHoanThueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Sotheodoisauhoanthues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="so-theo-doi-sau-hoan-thue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="pull-left">
            <?= Html::a(Yii::t('app', 'Create Sotheodoisauhoanthue'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '07aQTr-Sổ theo dõi QDTT, KT sau hoàn thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-mau-7a', ['model' => $model]);
            Modal::end();
            ?>

            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '08aQTr-HT-Sổ theo dõi QDTT, KT sau hoàn thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-mau-8a', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>
    <div class="row" style="padding-top:5px">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '08bQTr-HT-BC THKQ thực hiện các KĐTT, KT sau hoàn thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-kiem-tra-sau-hoan-mau8b', ['model' => $model]);

            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '011- Kết quả kiểm tra hoàn thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-ket-qua-kiem-tra-hoan-thue', ['model' => $model]);
            Modal::end();
            ?>

            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '07bQTr-HT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-mau-7b', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => 'STT',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ],
                'contentOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
            [
                'attribute' => 'mst',
                'value' => 'mst0.maSoThue',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ],
                'contentOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
            [
                'attribute' => 'laToChuc',
                'value' => 'mst0.tenNguoiNop',
                'label' => 'Tên DN',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ],
                'contentOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
            [
                'attribute' => 'soQdThanhTraId',
                'value' => 'soQdThanhTra.soQdThanhTra',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ],
                'contentOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
            [
                'attribute' => 'soQdKtId',
                'value' => 'soQdKt.soQdKiemTra',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ],
                'contentOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
            [
                'attribute' => 'soVbHoanThueId',
                'value' => 'soVbHoanThue.soVb',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ],
                'contentOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
//            'qdId',
            // 'thoiKyThanhTra',
//            'soQdThanhTra',
//            'soQdKiemTra',
//            'soVb',
            // 'soVbHoanThueId',
            // 'tienThue',
            // 'tienLai',
            // 'ghiChu:ntext',
            // 'kyBaoCao',
            // 'loaiHoanThueId',
            // 'soTienThueThuHoiKyTruocChuyenSang',
            // 'soTienPhatViPhamKyTruocChuyenSang',
            // 'tienChamNopKyTruocChuyenSang',
            // 'soQdThuHoiHoanThue',
            // 'soTienThueThuHoiHoanThue',
            // 'soQdXuPhat',
            // 'soTienPhatViPham',
            // 'tienChamNopXuPhat',
            // 'soQdktSauHoan',
            // 'thoiKyThanhTraSauHoanThue',
            // 'soTienThueThuHoiDaNop',
            // 'soTienPhatViPhamDaNop',
            // 'tienChamNopDaNop',
//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
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
    <?php Pjax::end(); ?>
</div>