<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\DateTimeHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Ketquakttaitrusonnt */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ketquakttaitrusonnts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ketquakttaitrusonnt-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Ketquakttaitrusonnts'), ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Create Ketquakttaitrusonnt'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'chiTieuKiemTra.chiTieuKiemTra',
            [
                'attribute' => 'nhiemVuKiemTra',
                'label' => 'Nhiệm vụ kiểm tra',
            ],
            [
                'attribute' => 'ghiChu1',
                'label' => 'Trưởng đoàn',
            ],
            'soQdkt',
            [
                'attribute' => 'ngayQdkt',
                'label' => 'Ngày QDKT',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayQdkt);
                },
            ],
            'loaiNoiDungChuyenDe.loaiNd',
            [
                'attribute' => 'tienDoThucHien',
                'label' => 'Tiến độ thực hiện',
                'value' => function($model){
                    if ($model->tienDoThucHien){
                        return 'Hoàn thành';
                    }
                    else{
                        return 'Dở dang';
                    }

                },
            ],
            'soQdXuLy',
            [
                'attribute' => 'ngayQdxl',
                'label' => 'Ngày QDXL',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayQdxl);
                },
            ],
            [
                'attribute' => 'soKetLuan',
                'label' => 'Số kết luận',
            ],
            [
                'attribute' => 'ngayKetLuan',
                'label' => 'Ngày QDKL',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayKetLuan);
                },
            ],
            [
                'attribute' => 'doanhNghiepCoViPham',
                'label' => 'Doanh nghiệp có vi phạm',
                'value' => function($model){
                    if ($model->doanhNghiepCoViPham){
                        return 'Vi phạm';
                    }
                    else{
                        return 'Không vi phạm';
                    }

                },
            ],
            'loaiQuyMoDoanhNghiep.loaiQuyMo',
            'loaiKhuVucDoanhNghiep.loaiKhuVuc',
            [
                'attribute' => 'ghiChu6',
                'label' => 'Phân cấp quản lý',
                'value' => function($model){
                    if($model->ghiChu6 == 20){
                        return 'DNTW';
                    }
                    else if($model->ghiChu6 == 21){
                        return 'DNĐP';
                    }

                    return '';
                }
            ],
            [
                'label' => 'Tổng số thuế truy thu',
                'value' => function($model){
                    return number_format($model->soThueTruyThuVat+$model->soThueTruyThuTndn+$model->soThueTruyThuTncn+$model->soThueTruyThuTtdb+$model->soThueTruyThuKhac,0,',', ',');
                },
            ],
            [
                'attribute' => 'soThueTruyHoan',
                'value' => number_format($model->soThueTruyHoan,0,',', ','),
                'label' => 'Số thuế truy hoàn',
            ],
            [
                'attribute' => 'anDinh',
                'value' => number_format($model->anDinh,0,',', ','),
                'label' => 'Ấn định',
            ],
            [
                'label' => 'Tổng số tiền phạt',
                'value' => function($model){
                    return number_format($model->tienPhat+$model->tienKkSai+$model->tienPhatNopCham+$model->tienPhatViPhamHanhChinhKhac,0,',', ',');
                },
            ],
            [
                'attribute' => 'noDongNamTruoc',
                'value' => number_format($model->noDongNamTruoc,0,',', ','),
                'label' => 'Nợ đọng năm trước',
            ],
            [
                'attribute' => 'noPhatSinhTrongNam',
                'value' => number_format($model->noPhatSinhTrongNam,0,',', ','),
                'label' => 'Nợ phát sinh trong năm',
            ],
            [
                'attribute' => 'daNopChoNoDongNamTruoc',
                'value' => number_format($model->daNopChoNoDongNamTruoc,0,',', ','),
                'label' => 'Đã nộp đọng năm trước',
            ],
            [
                'attribute' => 'daNopPhatSinhTrongNam',
                'value' => number_format($model->daNopPhatSinhTrongNam,0,',', ','),
                'label' => 'Đã nộp phát sinh trong năm',
            ],
            [
                'attribute' => 'conPhaiNopDongNamTruoc',
                'value' => number_format($model->conPhaiNopDongNamTruoc,0,',', ','),
                'label' => 'Còn phải nộp đọng năm trước',
            ],
            [
                'attribute' => 'conPhaiNopPhatSinhTrongNam',
                'value' => number_format($model->conPhaiNopPhatSinhTrongNam,0,',', ','),
                'label' => 'Còn phải nộp phát sinh trong năm',
            ],
            [
                'attribute' => 'soThueDuocGiamTheoKeKhai',
                'value' => number_format($model->soThueDuocGiamTheoKeKhai,0,',', ','),
                'label' => 'Thuế được miễn giảm theo kê khai',
            ],
            [
                'attribute' => 'soThueDuocGiamTheoTtkt',
                'value' => number_format($model->soThueDuocGiamTheoTtkt,0,',', ','),
                'label' => 'Thuế được miễn, giảm, ưu đãi theo TTKT',
            ],
            [
                'attribute' => 'chenhLech',
                'value' => number_format($model->chenhLech,0,',', ','),
                'label' => 'Chênh lệch',
            ],
            [
                'attribute' => 'giamLo',
                'value' => number_format($model->giamLo,0,',', ','),
            ],
            [
                'attribute' => 'giamKhauTru',
                'value' => number_format($model->giamKhauTru,0,',', ','),
            ],
            [
                'attribute' => 'ngayTao',
                'label' => 'Ngày tạo',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayTao);
                },
            ],
            [
                'attribute' => 'ngayCapNhat',
                'label' => 'Ngày cập nhật',
                'value' => function($model){
                    return DateTimeHelpers::convertDate($model->ngayCapNhat);
                },
            ],
        ],
    ]) ?>

</div>
