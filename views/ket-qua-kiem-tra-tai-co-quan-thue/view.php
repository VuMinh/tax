<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\DateTimeHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Ketquakiemtrataicoquanthue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ketquakiemtrataicoquanthues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ketquakiemtrataicoquanthue-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Ketquakiemtrataicoquanthues'), ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Create Ketquakiemtrataicoquanthue'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'nguoiNopThue.maSoThue',
            'nguoiNopThue.tenNguoiNop',
            'phongBan',
            'trangThaiHoSo.trangThaiHs',
            [
                'attribute' => 'ghiChu1',
                'label' => 'Người nhập',
            ],
            [
                'attribute' => 'tongThueDieuChinhTang',
                'value' => number_format($model->tongThueDieuChinhTang,0,',', ','),
                'label' => 'Tổng thuế điều chỉnh tăng'
            ],
            [
                'attribute' => 'tongThueDieuChinhGiam',
                'value' => number_format($model->tongThueDieuChinhGiam,0,',', ','),
                'label' => 'Tổng thuế điều chỉnh giảm'
            ],
            [
                'attribute' => 'anDinh',
                'value' => number_format($model->anDinh,0,',', ','),
                'label' => 'Ấn định'
            ],
            [
                'attribute' => 'giamKhauTru',
                'value' => number_format($model->giamKhauTru,0,',', ',')
            ],
            [
                'attribute' => 'giamLo',
                'value' => number_format($model->giamLo,0,',', ',')
            ],
            [
                'attribute' => 'tienDuocMineTang',
                'value' => number_format($model->tienDuocMineTang,0,',', ','),
                'label' => 'Tiền được miễn tăng'
            ],
            [
                'attribute' => 'tienDuocMienGiam',
                'value' => number_format($model->tienDuocMienGiam,0,',', ','),
                'label' => 'Tiền được miễn giảm'
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
        ],
    ]) ?>

</div>
