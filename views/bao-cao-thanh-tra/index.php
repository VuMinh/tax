<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BaocaothanhtraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Baocaothanhtras');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaothanhtra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="row">
        <div class="pull-left">
            <p>
                <?= Html::a(Yii::t('app', 'Create Baocaothanhtra'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>

        <div class="pull-right">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '05b-DS nợ trên 90 ngày các QĐTT của cục thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\ExportExcel();
            echo $this->render('/bao-cao-thanh-tra/export-excel-bao-cao-no-thanh-tra', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => 'STT',
                'headerOptions' => [
                    'style' => 'text-align:center'
                ]
            ],
            [
                'attribute' => 'mst',
                'value' => 'mst0.maSoThue',
                'headerOptions' => [
                    'style' => 'text-align:center;'
                ]
            ],
            [
                'attribute' => 'doiKiemTra',
                'value' => 'mst0.tenNguoiNop',
                'label' => 'Tên DN',
                'headerOptions' => [
                    'style' => 'text-align:center;'
                ]
            ],
            [
                'attribute' => 'soQdThanhTraId',
                'value' => 'soQdThanhTra.soQdThanhTra',
                'headerOptions' => [
                    'style' => 'text-align:center;'
                ]
            ],
            [
                'attribute' => 'truongDoan',
                'headerOptions' => [
                    'style' => 'text-align:center;'
                ]
            ],
            [
                'attribute' => 'soQdTruyThuId',
                'value' => 'soQdTruyThu.soQdTruyThu',
                'headerOptions' => [
                    'style' => 'text-align:center;'
                ]
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

                    /*'delete' => function ($url, $model) {
                        if (Yii::$app->user->identity->username == 'admin') {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'delete'),
                    'data-method' => 'post',
                            ]);
                        }
                        return null;
                    }*/

//                    'delete' => function ($url, $model) {
//                        if (Yii::$app->user->identity->username == 'admin') {
//                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
//                                [
//                                    'title' => Yii::t('app', 'delete'),
//                                    'data-confirm' => 'Ban có chắc muốn xóa mục này không?',
//                                    'data-method' => 'post',
//                                ]);
//                        }
//                    }

                ],
            ],
        ],
    ]); ?>
</div>
