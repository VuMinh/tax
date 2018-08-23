<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\ExportExcel;
use app\models\ExcelUploadForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BaocaobaohiemxahoiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Baocaobaohiemxahois');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaobaohiemxahoi-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php } ?>

    <div class="row">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '01a-Tình hình trích nộp BHXH - KPCĐ'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-bao-hiem-xa-hoi/export-excel-bao-cao-bao-hiem-xa-hoi', ['model' => $model]);
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
            $bhxh = new ExcelUploadForm();
            echo $this->render('/bao-cao-bao-hiem-xa-hoi/import-excel', ['bhxh' => $bhxh]);
            Modal::end();
            ?>
            <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-download-alt"></span> Tải tệp mẫu'), ['download'], ['class' => 'btn btn-danger ']) ?>
        </div>
    </div>
    <div class="row" style="padding-top:5px">
        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Tình hình trích nộp BHXH - KPCĐ mẫu mới'),
                    'class' => 'btn btn-primary'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-bao-hiem-xa-hoi/export-excel-bao-cao-bao-hiem-xa-hoi-moi', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'mst',
                'value' => 'mst0.maSoThue',
                'label' => 'Mã số thuế'
            ],
            [
                'attribute' => 'ghiChu',
                'value' => 'mst0.tenNguoiNop',
                'label' => 'Người nộp thuế',
            ],
            [
                'attribute' => 'soQdxlId',
                'value' => 'soQdxl.soQdXuLy',
                'label' => 'Số QDXL',
            ],
            [
                'attribute' => 'soQdxl.ngayQdXuLy',
                'label' => 'Ngày QDXL',
                'value' => function ($model) {

                    if ($model->soQdxl && $model->soQdxl->ngayQdXuLy != "") {
                        return \app\helpers\DateTimeHelpers::convertDate($model->soQdxl->ngayQdXuLy);
                    } else {
                        return "";
                    }
                },
            ],
            [
                'attribute' => 'truongDoan',
                'label' => 'Trưởng đoàn',
            ],
            [
                'attribute' => 'ngayTao',
                'label' => 'Ngày tạo',
                'value' => function ($model) {
                    return \app\helpers\DateTimeHelpers::convertDate($model->ngayTao);
                },
            ],
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
