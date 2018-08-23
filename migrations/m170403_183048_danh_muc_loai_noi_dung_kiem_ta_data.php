<?php

use yii\db\Migration;

class m170403_183048_danh_muc_loai_noi_dung_kiem_ta_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%loainoidungkiemtra}}', [
            'loaiND', 'ghiChu'
        ], [
            ['Dược phẩm và thiết bị y tế', '',],
            ['Bảo hiểm', '',],
            ['Chuyên đề BCTC', '',],
            ['Doanh nghiệp xã hội hóa', '',],
            ['Doanh nghiệp kinh doanh thương mại điện tử', '',],
            ['Doanh nghiệp có rủi ro cao về thuế theo công văn 7527', '',],
            ['Doanh nghiệp bán hàng đa cấp', '',],
            ['Doanh nghiệp kinh doanh thương mại nhà hàng, khách sạn', '',],
            ['Doanh nghiệp kinh doanh dịch vụ viễn thông', '',],
            ['Chuyên đề các thành viên thuộc tập đoàn và TCT lớn', '',],
            ['Kiểm tra đóng mã, giải thể', '',],
            ['Lỗ liên tục Từ 02 năm trở lên', '',],
            ['DN có dấu hiệu chuyển giá', '',],
            ['Hoàn thuế Trước hoàn', '',],
            ['Hoàn Thuế Sau hoàn', '',],
            ['DN ưu đãi thuế', '',],
        ]);
    }

    public function down()
    {
        echo "m170326_051058_danh_muc_loai_noi_dung_kiem_ta_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
