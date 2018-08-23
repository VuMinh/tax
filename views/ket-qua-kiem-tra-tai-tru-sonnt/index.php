<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\ExportExcel;
use app\helpers\DateTimeHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KetquakttaitrusonntSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ketquakttaitrusonnts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ketquakttaitrusonnt-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '10-Báo kết quả kiểm tra tại TSNNT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/ket-qua-kiem-tra-tai-tru-sonnt/export-excel-bao-cao-tai-nguoi-nop-thue', ['model' => $model]);
            Modal::end();
            ?>
        </div>
        <div class="pull-left">
            <p>
                <?= Html::a(Yii::t('app', 'Create Ketquakttaitrusonnt'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nguoiNopThueId',
                'value' => 'nguoiNopThue.maSoThue',
                'label' => 'Mã số thuế',
            ],
            [
                'attribute' => 'ghiChu2',
                'value' => 'nguoiNopThue.tenNguoiNop',
                'label' => 'Tên DN',
            ],
            'soQdkt',
            [
                'attribute' => 'ngayQdkt',
                'label' => 'Ngày QDKT',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayQdkt);
                },
            ],
            [
                'attribute' => 'soQdXuLy',
                'label' => 'Số QDXL',
            ],
            [
                'attribute' => 'ngayQdxl',
                'label' => 'Ngày QDXL',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayQdxl);
                },
            ],
            [
                'attribute' => 'soKetLuan',
                'label' => 'Số kết luận',
            ],
            [
                'attribute' => 'ngayKetLuan',
                'label' => 'Ngày QDKL',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayKetLuan);
                },
            ],
            // 'doanhNghiepCoViPham',
            // 'loaiQuyMoDoanhNghiepId',
            // 'ngayTao',
            // 'ngayCapNhat',
            // 'loaiKhuVucDoanhNghiepId',
            // 'soThueTruyThuVat',
            // 'soThueTruyThuTndn',
            // 'soThueTruyThuTncn',
            // 'soThueTruyThuTtdb',
            // 'soThueTruyThuKhac',
            // 'soThueKhongDuocHoan',
            // 'soThueTruyHoan',
            // 'anDinh',
            // 'tienPhat',
            // 'tienKkSai',
            // 'tienPhatNopCham',
            // 'tienPhatViPhamHanhChinhKhac',
            // 'noDongNamTruoc',
            // 'noPhatSinhTrongNam',
            // 'daNopChoNoDongNamTruoc',
            // 'daNopPhatSinhTrongNam',
            // 'conPhaiNopDongNamTruoc',
            // 'conPhaiNopPhatSinhTrongNam',
            // 'soThueDuocGiamTheoKeKhai',
            // 'soThueDuocGiamTheoTtkt',
            // 'chenhLech',
            // 'giamLo',
            // 'giamKhauTru',
            // 'ghiChu1',
            // 'ghiChu2',
            // 'ghiChu3',
            // 'ghiChu4',
            // 'ghiChu5',
            // 'ghiChu6',

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
</div>
