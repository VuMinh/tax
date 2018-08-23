<?php
/**
 * Created by PhpStorm.
 * User: HungNV
 * Date: 29/5/2017
 * Time: 10:19 AM
 */
use yii\bootstrap\Modal;
use \app\models\ExportExcel;
use app\models\ExcelUploadForm;

?>
<h1>Xuất báo cáo</h1>
<div class="row col-md-12">
    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Xuất báo cáo kiểm tra</div>
        <div class="manage-content">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '05a-BC nợ kiểm tra'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\DateExcelExport();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-no-kiem-tra', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '012-BC số tồn'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-so-ton', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '03-BC Hành Vi vi phạm'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-hanh-vi-vi-pham', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '02-BC chi tiết KQKT tại trụ sở NNT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-kiem-tra/export-excel-bao-cao-kiem-tra', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>
    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Xuất báo cáo bảo hiểm xã hội
        </div>
        <div class="manage-content">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '01a-Tình hình trích nộp BHXH - KPCĐ'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/bao-cao-bao-hiem-xa-hoi/export-excel-bao-cao-bao-hiem-xa-hoi',['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Nhập dữ liệu'),
                    'class' => 'btn btn-warning'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $bhxh = new ExcelUploadForm();
            echo $this->render('/bao-cao-bao-hiem-xa-hoi/import-excel', ['bhxh' => $bhxh]);
            Modal::end();
            ?>
        </div>
    </div>
    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Xuất báo cáo kiểm tra tại bàn
        </div>
        <div class="manage-content">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '10-Báo kết quả kiểm tra tại TSNNT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/ket-qua-kiem-tra-tai-tru-sonnt/export-excel-bao-cao-tai-nguoi-nop-thue', ['model' => $model]);
            Modal::end();
            ?>
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '09-Báo cáo kết quả kiểm tra tại TSCQT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/ket-qua-kiem-tra-tai-co-quan-thue/export-excel-bao-cao-tai-co-quan-thue', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>

    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Xuất báo cáo chuyển công an
        </div>
        <div class="manage-content">
            <?php
            \yii\bootstrap\Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '07-Báo cáo hồ sơ chuyển cơ quan CA'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\ExportExcel();
            echo $this->render('/bao-cao-chuyen-cong-an/export-excel-bao-cao-chuyen-cong-an', ['model' => $model]);
            \yii\bootstrap\Modal::end();
            ?>
        </div>
    </div>
    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Sổ theo dõi sau hoàn thuế</div>
        <div class="manage-content">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '07aQTr-Sổ theo dõi QDTT, KT sau hoàn thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-mau-7a', ['model' => $model]);
            Modal::end();
            ?>

            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '08aQTr-HT-Sổ theo dõi QDTT, KT sau hoàn thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-mau-8a', ['model' => $model]);
            Modal::end();
            ?>

            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '08bQTr-HT-BC THKQ thực hiện các KĐTT, KT sau hoàn thuế'),
                    'class' => 'btn btn-info',
                    'style'=>'margin-top:10px'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new ExportExcel();
            echo $this->render('/so-theo-doi-sau-hoan-thue/export-excel-bao-cao-kiem-tra-sau-hoan-mau8b', ['model' => $model]);

            Modal::end();
            ?>
        </div>
    </div>
    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Xuất báo cáo thanh tra</div>
        <div class="manage-content">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '05b-DS nợ trên 90 ngày các QĐTT của cục thuế'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\ExportExcel();
            echo $this->render('/bao-cao-thanh-tra/export-excel-bao-cao-no-thanh-tra', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>

    <div class="manager">
        <div class="manage-title"><span class="glyphicon glyphicon-download-alt"></span> Hóa đơn vi phạm</div>
        <div class="manage-content">
            <?php
            Modal::begin([
                'toggleButton' => [
                    'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', '06- Tổng hợp dữ liệu VP trên biên bản TT, KT'),
                    'class' => 'btn btn-info'
                ],
                'closeButton' => [
                    'label' => Yii::t('app', 'Close'),
                    'class' => 'btn btn-danger btn-sm pull-right',
                ],
                'size' => 'modal-md',
            ]);
            $model = new \app\models\ExportExcel();
            echo $this->render('/danh-sach-hoa-don-vi-pham/export-excel-bao-cao-hoa-don-vi-pham', ['model' => $model]);
            Modal::end();
            ?>
        </div>
    </div>
</div>
<?php
$css = <<<CSS
    
    #btnthem{
    margin-left: 2px;
    margin-bottom: 10px;
    }
    
    .form-group {
        margin-bottom: 30px;
        padding-left: 10px;
    }
    
    .panel-body {
        padding: 0;
        border: none;
    }
   .manager .manage-title {
    padding: 10px;
    text-decoration: none;
    color: white;
    font-weight: bold;
    display: inline-block;
    border-right: 30px solid transparent;
    border-bottom: 30px solid #00A000;
    height: 0;
    line-height: 50px;
}

.manager .manage-content {
    border: 1px solid #ccc;
    border-top: 2px solid #00A000;
    padding: 20px;
}
.manager {
    margin-top: 0px !important;

}
.manage-content {
    background: #fff;
}
CSS;
$this->registerCss($css, [\yii\web\View::POS_HEAD]);

?>
