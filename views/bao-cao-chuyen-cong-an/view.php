<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\DateTimeHelpers;
/* @var $this yii\web\View */
/* @var $model app\models\Baocaochuyencongan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Baocaochuyencongans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaochuyencongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Baocaochuyencongans'), ['index    '], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Baocaochuyencongan'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'phongChiCuc',
            'mst',
            [
                'attribute' => 'mst0.maSoThue',
            ],
            [
                'attribute' => 'mst0.tenNguoiNop',
            ],
            'soKetLuanThanhKiemTraDaBanHanh',
            [
                'attribute' => 'ngayKetLuan',
                'value' => DateTimeHelpers::convertDate($model->ngayKetLuan),
                'label' => 'Ngày kết luận'
            ],
            [
                'attribute' => 'doanhSo',
                'value' => number_format($model->doanhSo,0,',', ',')
            ],
            [
                'attribute' => 'thueGtgt',
                'value' => number_format($model->thueGtgt)
            ],
            [
                'attribute' => 'thueGtgt',
                'value' => number_format($model->thueGtgt)
            ],
            [
                'attribute' => 'tongSoHoaDon',
                'value' => number_format($model->tongSoHoaDon)
            ],
            [
                'attribute' => 'ngayBaoCao',
                'value' => DateTimeHelpers::convertDate($model->ngayBaoCao),
                'label' => 'Ngày ngày báo cáo'
            ],
            'ghiChu',
            [
                'attribute' => 'ngayCapNhat',
                'value' => DateTimeHelpers::convertDate($model->ngayCapNhat),
                'label' => 'Ngày cập nhật'
            ],
        ],
    ]) ?>

</div>
