<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sotheodoisauhoanthue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sotheodoisauhoanthues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sotheodoisauhoanthue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sotheodoisauhoanthue'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'mst0.maSoThue',
            'maChuong',
            [
                'attribute' => 'laToChuc',
                'value' => function ($model) {
                    /** @var $model \app\models\Sotheodoisauhoanthue */
                    return $model->laToChuc == 0 ? 'Tổ chức' : 'Cá nhân';
                },
            ],
            /* 'qd.soQd',
             'thoiKyThanhTra',
             'soVbHoanThue.soVb',
             'tienThue',
             'tienLai',
             'ghiChu:ntext',
             'kyBaoCao:date',
             'loaiHoanThue.lyDoHoanThue',
             'soTienThueThuHoiKyTruocChuyenSang',
             'soTienPhatViPhamKyTruocChuyenSang',
             'tienChamNopKyTruocChuyenSang',
             'soQdThuHoiHoanThue',
             'soTienThueThuHoiHoanThue',
             'soQdXuPhat',
             'soTienPhatViPham',
             'tienChamNopXuPhat',
             'soQdktSauHoan',
             'thoiKyThanhTraSauHoanThue:date',
             'soTienThueThuHoiDaNop',
             'soTienPhatViPhamDaNop',
             'tienChamNopDaNop',*/

            'loaiHoanThue.lyDoHoanThue',
            'soThueDeNghiHoan',
            'soThueKhongDuocHoan',
            'soQdThanhTra.soQdThanhTra',
            'soQdKt.soQdKiemTra',
            'thoiKyThanhTra',
            'soVbHoanThueId',
            'ghiChu:ntext',
            [
                'attribute' => 'soQdThuHoiHoanId',
                'label' => 'Số QĐ Thu hồi hoàn'
            ],
            [
                'attribute' => 'soQdXuPhatId',
                'label' => 'Số QĐ Xử phạt'
            ],
            'chiTietHanhViViPham:ntext',
        ],
    ]) ?>

</div>
