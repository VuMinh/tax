<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\DateTimeHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BaocaochuyenconganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Baocaochuyencongans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaochuyencongan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="pull-right">
            <?php
            \yii\bootstrap\Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '07-Báo cáo hồ sơ chuyển cơ quan CA'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\ExportExcel();
            echo $this->render('/bao-cao-chuyen-cong-an/export-excel-bao-cao-chuyen-cong-an', ['model' => $model]);
            \yii\bootstrap\Modal::end();
            ?>
        </div>
        <div class="pull-left">
            <p>
                <?= Html::a(Yii::t('app', 'Create Baocaochuyencongan'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
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
            ],
            [
                'attribute' => 'ghiChu1',
                'value' => 'mst0.tenNguoiNop',
                'label' => 'Tên DN'
            ],
            'phongChiCuc',
            'soKetLuanThanhKiemTraDaBanHanh',
            [
                'attribute' => 'ngayKetLuan',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayKetLuan);
                },
                'label' => 'Ngày kết luận'
            ],

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
