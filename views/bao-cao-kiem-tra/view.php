<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaokiemtra */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Baocaokiemtras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaokiemtra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Baocaokiemtras'), ['index    '], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Baocaokiemtra'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'mst0.tenNguoiNop',
            'soQdkt.soQdKiemTra',
            'qdHtThuocKhRuiRoTrongNam',
            'loaiKhuVuc.loaiKhuVuc',
            'loaiQuyMo.loaiQuyMo',
            'loaiNdkt.loaiNd',
            'kiemTraTheoQuyetToanChiDao',
            'ngayKyBbkt',
            'soQdXuLy.soQdXuLy',
            [
                'label' => 'Cộng thuế truy thu',
                'value' => function($model){
                    return number_format($model->truyThuThueTndn+$model->truyThuThueTncn+$model->truyThuThueGtgt+$model->truyThuThueKhac,0,',', ',');
                },
            ],
            [
                'label' => 'Cộng thuế truy hoàn',
                'value' => function($model){
                    return number_format($model->truyHoanThueGtgt+$model->truyHoanThueTncn+$model->truyHoanThueKhac,0,',', ',');
                },
            ],
            [
                'label' => 'Cộng phạt',
                'value' => function($model){
                    return number_format($model->phatTronThue+$model->phatHanhChinhKhac1020+$model->phatChamNop+$model->phatKhac,0,',', ',');
                },
            ],
            [
                'label' => 'Đọng kì trước',
                'value' => function($model){
                    return number_format($model->noDongNamTruocChuyenSang+$model->noDongPhatSinhTrongNam,0,',', ',');
                },
            ],
            [
                'label' => 'Đã nộp vào NSNN',
                'value' => $model->getLichsunopsaukiemtraOrder()
            ],
            [
                'label' => 'Tổng cộng nộp cho số phát sinh',
                'value' => function($model){
                    return number_format($model->noDongNamTruocChuyenSang+$model->noDongPhatSinhTrongNam,0,',', ',');
                },
            ],
            [
                'attribute' => 'thueMienGiamTheoKeKhai',
                'value' => number_format($model->thueMienGiamTheoKeKhai,0,',', ',')
            ],
            [
                'attribute' => 'thueMienGiamTheoKiemTra',
                'value' => number_format($model->thueMienGiamTheoKiemTra,0,',', ',')
            ],
            [
                'attribute' => 'mienGiamChenhLech',
                'value' => number_format($model->mienGiamChenhLech,0,',', ',')
            ],
            [
                'attribute' => 'giamKhauTru',
                'value' => number_format($model->giamKhauTru,0,',', ',')
            ],
            [
                'attribute' => 'thueKhongDuocHoan',
                'value' => number_format($model->thueKhongDuocHoan,0,',', ',')
            ],
            [
                'attribute' => 'giamLo',
                'value' => number_format($model->giamLo,0,',', ',')
            ],
            'ghiChu:ntext',
            'hanhViViPham:ntext',
            'moTaCachThucPhatHien:ntext',
        ],
    ]) ?>

</div>
