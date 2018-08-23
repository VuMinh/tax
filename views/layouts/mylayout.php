<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$this->title = 'Chi cục thuế Thanh Xuân';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title . " | " . Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => $this->title,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Trang chủ', 'url' => ['/site/index']],
//            ['label' => 'Sổ theo dõi sau hoàn thuế', 'url' => ['/so-theo-doi-sau-hoan-thue/index']],
//            ['label' => 'Người nộp thuế', 'url' => ['/nguoi-nop-thue/index']],
//            ['label' => 'Quyết định', 'url' => ['/quyet-dinh/index']],
//            ['label' => 'Văn bản', 'url' => ['/van-ban/index']],
//            ['label' => 'Báo cáo kiểm tra', 'url' => ['/bao-cao-kiem-tra/index']],
//            ['label' => 'Về chúng tôi', 'url' => ['/site/about']],
//            ['label' => 'Liên hệ', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
                ['label' => 'Đăng nhập', 'url' => ['/user/security/login']] :
                ['label' => 'Đăng xuất (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']],
//            ['label' => 'Đăng kí', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest]
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
        <!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
<script>
    var baseUrl = "<?= Yii::$app->getHomeUrl() ?>";
</script>
</body>
</html>
<?php $this->endPage() ?>
