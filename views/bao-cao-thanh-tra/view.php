<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaothanhtra */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baocaothanhtras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaothanhtra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Baocaothanhtras'), ['index    '], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Baocaothanhtra'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'soQdThanhTra.soQdThanhTra',
            'mst0.maSoThue',
            'mst0.tenNguoiNop',
            'truongDoan',
            [
                'label' => 'vatTruyThu',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            [
                'label' => 'tndn',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            [
                'label' => 'ttdb',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            [
                'label' => 'tncn',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            [
                'label' => 'monBai',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            [
                'label' => 'tienPhat1020',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            [
                'label' => 'tienPhat005',
                'value' => function ($model) {
                    return number_format($model->vatTruyThu);
                },
            ],
            'soQdTruyThu.soQdTruyThu',
            [
                'attribute' => 'lichsunopthanhtraOrder.daNopThue',
                'label' => 'Đã nộp thuế',
                'value' => function ($model) {
                    return number_format($model->lichsunopthanhtraOrder->daNopThue);
                },
            ],
        ],
    ]) ?>

</div>
