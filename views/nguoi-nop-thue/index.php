<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NguoinopthueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Nguoinopthues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-load"><!-- Place at bottom of page --></div>
<div class="nguoinopthue-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(Yii::$app->session->hasFlash('create')):?>
        <div class="alert alert-info">
            <?php echo Yii::$app->session->getFlash('create'); ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error1')):?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->session->getFlash('error1'); ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('update')):?>
        <div class="alert alert-success">
            <?php echo Yii::$app->session->getFlash('update'); ?>
        </div>
    <?php endif; ?>


    <?php if (Yii::$app->session->hasFlash('insert')): ?>
        <div class="alert alert-info">
            <?php echo Yii::$app->session->getFlash('insert'); ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('dupp')): ?>
        <div class="alert alert-danger">
            <?php echo Yii::$app->session->getFlash('dupp'); ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('updated')): ?>

        <div class="alert alert-success">

        </div>
    <?php endif; ?>

    <?php
    Modal::begin([
        'toggleButton' => [
            'label' => '<i class="glyphicon glyphicon-plus"></i> Nhập dữ liệu',
            'class' => 'btn btn-warning pull-right'
        ],
        'closeButton' => [
            'label' => 'Close',
            'class' => 'btn btn-danger btn-sm pull-right',
        ],
        'size' => 'modal-md',
    ]);
    $model = new \app\models\ExcelUploadForm();
    echo $this->render('/nguoi-nop-thue/import-excel', ['model' => $model]);
    Modal::end();
    ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Nguoinopthue'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'maSoThue',
            'tenNguoiNop',
            'ghiChu:ntext',
//            'nganhNghe.tenNganhNgheKdChinh',
            'tenNganhNgheKdChinh',
            // 'diaChi',
            // 'emailTbthue:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>