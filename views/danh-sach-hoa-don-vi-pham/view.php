<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\DateTimeHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Danhsachhoadonvipham */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Danhsachhoadonviphams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="danhsachhoadonvipham-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Danhsachhoadonviphams'), ['index    '], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Danhsachhoadonvipham'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'coQuanQuanLyThueDnMua',
            'mstDnMua0.maSoThue',
            'kyHieuHoaDon',
            'soHoaDon',
            [
                'attribute' => 'ngayPhatHanhHoaDon',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayPhatHanhHoaDon);
                },
            ],
            'tenHangHoa',
            [
                'attribute' => 'giaTriHangChuaThue',
                'value' => number_format($model->giaTriHangChuaThue, 0, ',', ',')
            ],
            [
                'attribute' => 'thueVat',
                'value' => number_format($model->thueVat, 0, ',', ',')
            ],
            'dauHieuViPham:ntext',
            'tenChuDn',
            'cmt',
            [
                'attribute' => 'ngayThayDoiChuSoHuuGanNhat',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayThayDoiChuSoHuuGanNhat);
                },
            ],
            [
                'attribute' => 'ngayThayDoiDiaDiemGanNhat',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayThayDoiDiaDiemGanNhat);
                },
            ],
            'thongBaoBoTron',
            [
                'attribute' => 'ngayBoTron',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayBoTron);
                },
            ],
            'coQuanThueQuanLyDnBan',
            'mstDnBan',
            'tenDnBan',
            'coQuanThueRaQdxl',
            'ghiChu',
            [
                'attribute' => 'ngayBaoCao',
                'value' => function ($model) {
                    return DateTimeHelpers::convertDate($model->ngayBaoCao);
                },
            ],
        ],
    ]) ?>

</div>
