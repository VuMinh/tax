<?php

use yii\db\Migration;

class m170423_112835_danh_muc_chi_tieu_kiem_tra_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%chitieukiemtra}}', [
            'chiTieuKiemTra','maChiTieu', 'ghiChu'
        ], [
            ['Đã ban hành quyết định năm trước chuyển sang', '1',''],
			['Nhiệm vụ kiểm tra năm', '2',''],
			['Theo kế hoạch, chuyên đề PS trong tháng', '2.1',''],
			['Theo kế hoạch', '2.1.1',''],
			['Theo chuyên đề', '2.1.2',''],
			['Doanh nghiệp từ kiểm tra hồ sơ khai thuế', '2.2',''],
			['Theo dấu hiệu vi phạm', '2.3',''],
			['Hoàn thuế', '2.4',''],
			['Doanh nghiệp khác theo nhiệm vụ được giao', '2.5',''],
			['Doanh nghiệp có dấu hiệu chuyển giá', '2.5.1',''],
			['Doanh nghiệp chuyển giá', '2.5.2',''],
        ]);
    }

    public function down()
    {
        echo "m170423_072443_danh_muc_chi_tieu_kiem_tra_data cannot be reverted.\n";

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
