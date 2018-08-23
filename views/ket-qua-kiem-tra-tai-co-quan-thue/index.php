<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\ExportExcel;
use app\helpers\DateTimeHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KetquakiemtrataicoquanthueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ketquakiemtrataicoquanthues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ketquakiemtrataicoquanthue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="row">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '09-Báo cáo kết quả kiểm tra tại TSCQT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/ket-qua-kiem-tra-tai-co-quan-thue/export-excel-bao-cao-tai-co-quan-thue', ['model' => $model]);
            Modal::end();
            ?>
        </div>
        <div class="pull-left">
            <p>
                <?= Html::a(Yii::t('app', 'Create Ketquakiemtrataicoquanthue'), ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'ghiChu1',
                'label' => 'Người nhập',
            ],
            [
                'attribute' => 'ghiChu3',
                'value' => 'trangThaiHoSo.trangThaiHs',
                'label' => 'Trạng thái hồ sơ',
            ],
            [
                'attribute' => 'ngayTao',
                'label' => 'Ngày tạo',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayTao);
                },
            ],
            [
                'attribute' => 'ngayCapNhat',
                'label' => 'Ngày cập nhật',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayCapNhat);
                },
            ],

            // 'tongThueDieuChinhTang',
            // 'tongThueDieuChinhGiam',
            // 'anDinh',
            // 'giamKhauTru',
            // 'giamLo',
            // 'tienDuocMineTang',
            // 'tienDuocMienGiam',
            // 'nguoiNopThueId',
            // 'ghiChu1',
            // 'ghiChu2',
            // 'ghiChu3',

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
