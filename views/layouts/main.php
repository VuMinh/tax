<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\ExportExcel;

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
            Yii::$app->user->isGuest ?
                ['label' => 'Đăng nhập', 'url' => ['/site/login']] :
                ['label' => 'Đăng xuất (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
    NavBar::end();
    ?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; width:0px;">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?= Url::to(['//xuat-bao-cao/index']) ?>"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt=""> Xuất
                                báo cáo<span
                                        class="fa arrow"></span></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt="">Báo cáo
                                kiểm tra tại bàn<span
                                    class="fa arrow"></span></a>
                            <ul class="nav nav-second-level " style="max-height: 250px; overflow-y:scroll;">
                                <li>
                                    <a href="<?= Url::to(['//ket-qua-kiem-tra-tai-co-quan-thue/index']) ?>"><span
                                            class="fa fa-pencil-square-o edit"></span> DSBCKT tại bàn tại trụ sở CQT</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/ket-qua-kiem-tra-tai-tru-sonnt/index']) ?>"><span
                                            class="fa fa-pencil-square-o edit"></span> DSBCKT tại bàn tại trụ sở NNT</a>
                                </li>
                                <li>
                                    <a id="a_1" href="<?= Url::to(['/ket-qua-kiem-tra-tai-co-quan-thue/create']) ?>"><span class="fa fa-pencil-square-o edit"></span> Nhập KQKT tại bàn tại trụ sở CQT</a>
                                </li>
                                <li>
                                    <a id="a_1" href="<?= Url::to(['/ket-qua-kiem-tra-tai-tru-sonnt/create']) ?>"><span class="fa fa-pencil-square-o edit"></span> Nhập KQKT tại bàn tại trụ sở NNT</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt="">Báo cáo
                                chuyển CA<span
                                    class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li>
                                    <a href="<?= Url::to(['/bao-cao-chuyen-cong-an/index']) ?>"><span
                                            class="fa fa-pencil-square-o edit"></span> DS báo cáo chuyển CA</a>
                                </li>
                                <li>
                                    <a id="a_1" href="<?= Url::to(['/bao-cao-chuyen-cong-an/create']) ?>"><span class="fa fa-pencil-square-o edit"></span> Nhập BC chuyển CA</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt="">Báo cáo
                                kiểm tra<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level " style="max-height: 250px; overflow-y:scroll;">
                                <li>
                                    <a href="<?= Url::to(['/bao-cao-kiem-tra/index']) ?>"><span
                                                class="fa fa-pencil-square-o edit"></span> Danh sách báo cáo kiểm
                                        tra</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/bao-cao-kiem-tra/create']) ?>"><span
                                                class="fa fa-pencil-square-o edit"></span> Nhập báo cáo kiểm tra mới</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/bao-cao-kiem-tra/danh-sach-quyet-dinh-tren-30-ngay'])?>"><span class="fa fa-pencil-square-o edit"></span> Danh sách Quyết định tồn trên 30 ngày</a>

                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?= Url::to(['/bao-cao-bao-hiem-xa-hoi/index']) ?>"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt="">Báo cáo
                                bảo hiểm xã hội<span
                                        class="fa arrow"></span></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt="">Sổ theo
                                dõi sau hoàn thuế<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Url::to(['so-theo-doi-sau-hoan-thue/index']) ?>"><span
                                                class="fa fa-pencil-square-o"></span> Danh sách sổ theo dõi sau hoàn
                                        thuế</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['so-theo-doi-sau-hoan-thue/create']) ?>"><span
                                                class="fa fa-pencil-square-o"></span> Nhập sổ theo dõi mới</a>
                                </li>
                                <li>
                                    <a href="#"><span class="fa fa-pencil-square-o"></span> Nhập kết quả thực hiện</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?= Url::to(['nguoi-nop-thue/index']) ?>"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt=""> Danh bạ
                                người nộp thuế <span
                                        class="fa arrow"></span></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt=""> Báo cáo nợ
                                thanh tra<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a id="a_1" href="<?= Url::to(['/bao-cao-thanh-tra/index']) ?>"><span
                                                class="fa fa-pencil-square-o"></span> Danh sách báo cáo nợ thanh tra</a>
                                </li>
                                <li>
                                    <a id="a_2" href="<?= Url::to(['/bao-cao-thanh-tra/create']) ?>"><span
                                                class="fa fa-pencil-square-o"></span> Tạo báo cáo nợ thanh tra</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= Yii::getAlias('@web') . '/img/folder-icon.png' ?>" alt="">Hóa đơn vi phạm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a id="a_1" href="<?= Url::to(['/danh-sach-hoa-don-vi-pham/index']) ?>"><span
                                            class="fa fa-pencil-square-o"></span> Danh sách hóa đơn vi phạm</a>
                                </li>
                                <li>
                                    <a id="a_2" href="<?= Url::to(['/danh-sach-hoa-don-vi-pham/create']) ?>"><span
                                            class="fa fa-pencil-square-o"></span> Tạo hóa đơn vi phạm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
    </div>

    <div id="page-wrapper">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
    </div>
</footer>
<script>
    var baseUrl = "<?= Yii::$app->getHomeUrl() ?>";
</script>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

<div class="my-load" style="display: none"><!-- Place at bottom of page --></div>
<?php
$css = <<<CSS
    .ul li ul{
       list-style: none;
    }
CSS;
$this->registerCss($css, [\yii\web\View::POS_HEAD]);

?>

