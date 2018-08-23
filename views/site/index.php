<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="title fix-title">
            <span class="title_content">Chào mừng!</span>
        </h1>
        <h3 style="text-align: center">Chào mừng đến với công cụ quản lý báo cáo thuế</h3>
        <h3 style="text-align: center">của chi cục thuế Thanh Xuân</h3>
        <br/>
        <p>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <a href="bao-cao-kiem-tra/index" class="btn btn-primary btn-lg">Vào nhanh báo cáo kiểm tra</a>
            <?php } else { ?>
                <?= Html::a('Vào nhanh báo cáo kiểm tra', ['/user/security/login'], ['class' => 'btn btn-primary btn-lg']) ?>
            <?php } ?>
        </p>
    </div>
</div>
