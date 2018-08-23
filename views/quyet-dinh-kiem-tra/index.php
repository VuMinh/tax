<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuyetdinhkiemtraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Quyetdinhkiemtras');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quyetdinhkiemtra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Quyetdinhkiemtra'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'soQdKiemTra',
            'ngayQdKiemTra',
            'noDongKyTruocChuyenSang',
            'phatSinhTrongKy',
            // 'nienDoKiemTra',
            // 'truongDoanId',
            // 'ngayCongBoQdkt',
            // 'ngayTrinhVbTamDungKt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
