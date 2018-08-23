<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaobaohiemxahoi */
/* @var $baohiemxahoitheonam app\models\Baocaobaohiemxahoitheonam[] */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baocaobaohiemxahois', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//var_dump($baohiemxahoitheonam);die;
?>
<div class="baocaobaohiemxahoi-view">
    <?php if(Yii::$app->session->hasFlash('success')){?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Baocaobaohiemxahois'), ['index    '], ['class' => 'btn btn-success']) ?>
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
        echo $this->render('/bao-cao-bao-hiem-xa-hoi/import-excel', ['bhxh' => $bhxh]);
        Modal::end();
        ?>
    </p>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'mst0.maSoThue',
            ],
            [
                'attribute' => 'mst0.tenNguoiNop',
            ],
            'soQdxl.soQdXuLy',
            [
                'attribute' => 'soQdxl.ngayQdXuLy',
                'label' => 'Ngày QDXL',
                'value' => function($model){
                    if ($model->soQdxl && $model->soQdxl->ngayQdXuLy != "") {
                        return \app\helpers\DateTimeHelpers::convertDate($model->soQdxl->ngayQdXuLy);
                    } else {
                        return "";
                    }

                },
            ],
            [
                'attribute' => 'truongDoan',
                'label' => 'Trưởng đoàn'
            ],
            [
                'attribute' => 'viPhamBhxh',
                'label' => 'Vi phạm, dấu hiệu vi phạm Về  BHXH'
            ],
            [
                'attribute' => 'viPhamKpcd',
                'label' => 'Vi phạm, dấu hiệu vi phạm Về KPCĐ'
            ],
            [
                'attribute' => 'coKtndKpcd',
                'label' => 'Có kiểm tra nội dung Về  BHXH'
            ],
            [
                'attribute' => 'coKtndBhxh',
                'label' => 'Có kiểm tra nội dung Về KPCĐ'
            ],
            [
                'attribute' => 'soDvThanhTraKiemTraHoanThanh',
                'label' => 'Số lượng đơn vị thanh tra kiểm tra hoàn thành trong tháng '
            ],
            [
                'attribute' => 'ghiChu',
                'label' => 'Ghi chú'
            ],
        ],
    ]) ?>

    <table class="table table-bordered table-hover table-center">
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
        <?php for($i=0; $i<count($baohiemxahoitheonam); $i++) { ?>
            <tr class="float-right">
                <td><?=  $baohiemxahoitheonam[$i]['namKtbhxh']?></td>
                <td><?=  $baohiemxahoitheonam[$i]['laoDongTrichBhxh']?></td>
                <td><?=  $baohiemxahoitheonam[$i]['laoDongChuaTrichBhxh']?></td>
                <td><?=  $baohiemxahoitheonam[$i]['laoDongTrichKpcd']?></td>
                <td><?=  $baohiemxahoitheonam[$i]['laoDongChuaTrichKpcd']?></td>
                <td><?=  number_format($baohiemxahoitheonam[$i]['soBhxhPhaiNop'], 0, ',', ',');?></td>
                <td><?=  number_format($baohiemxahoitheonam[$i]['soBhxhDaNop'], 0, ',', ',');?></td>
                <td><?=  number_format($baohiemxahoitheonam[$i]['soKpcdPhaiNop'], 0, ',', ',');?></td>
                <td><?=  number_format($baohiemxahoitheonam[$i]['soKpcdDaNop'], 0, ',', ',');?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>


</div>
