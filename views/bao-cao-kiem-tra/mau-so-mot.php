<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use app\helpers\DateTimeHelpers;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BaocaokiemtraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Baocaokiemtras');
$this->params['breadcrumbs'][] = $this->title;

$a = $model->day;
?>

<div class="baocaokiemtra-index">

    <div class="danhsachbaocaoqua30ngay-form">
        <?php $form = ActiveForm::begin(); ?>
        <h3>Mốc thời gian xuất báo cáo</h3>
        <div class="col-md-6">
            <?= $form->field($model, 'day')->textInput(['placeholder' => "dd/mm/yyyy"])->label(false) ?>
        </div>
        <div class="form-group">
            <div class="row">
                <?= Html::submitButton('Tạo danh sách', ['class' => 'btn btn-primary']) ?>
                <div class="pull-right">
                    <p>
                        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-download-alt"></span> Xuất ra'),
                            ['export-excel-danh-sach-quyet-dinh-tren-30-ngay', 'time'=>$model->day],
                            ['class' => 'btn btn-info pull-right']) ?>
                    </p>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <h1>Danh sách chưa có QĐXL tồn trên 30 ngày</h1>
    <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => 'STT',
                'contentOptions' => [
                    'style' => 'width:5px'
                ]
            ],
            [
                'label' => 'Lý do chậm',
                'value' => function ($data) {
                    return Html::a(Yii::t('app', ' {modelClass}', [
                        'modelClass' => '<span class="	glyphicon glyphicon-edit"></span>',
                    ]), ['ly-do-xu-ly-cham/create', 'soQdktId' => $data->id], ['class' => 'btn btn-success', 'id' => 'popupModal']
                    );
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'mst',
                'value' => 'mst0.maSoThue',

            ],
            [
                'attribute' => 'doiKiemTra',
                'value' => 'mst0.tenNguoiNop',
            ],
            [
                'attribute' => 'soQdkt.soQdKiemTra',
                'label' => 'Số QĐKT',
            ],
            [
                'attribute' => 'soQdkt.ngayQdKiemTra',
                'label' => 'Ngày QĐKT',
                'value' => function($model){
                    if ($model->soQdkt && $model->soQdkt->ngayQdKiemTra != "") {
                        return DateTimeHelpers::convertDate($model->soQdkt->ngayQdKiemTra);
                    } else {
                        return "";
                    }
                },
            ],
            [
                'attribute' => 'soQdXuLy.soQdXuLy',
                'label' => 'Số QĐXL'
            ],
            [
                'attribute' => 'soQdXuLy.ngayQdXuLy',
                'label' => 'Ngày QĐXL',
                'value' => function($model){
                    if ($model->soQdXuLy && $model->soQdXuLy->soQdXuLy != "") {
                        return DateTimeHelpers::convertDate($model->soQdXuLy->ngayQdXuLy);
                    } else {
                        return "";
                    }
                },
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
