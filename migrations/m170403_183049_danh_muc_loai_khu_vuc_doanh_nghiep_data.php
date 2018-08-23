<?php

use yii\db\Migration;

class m170403_183049_danh_muc_loai_khu_vuc_doanh_nghiep_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%loaikhuvucdoanhnghiep}}', [
            'loaiKhuVuc', 'ghiChu'
        ], [
            ['DNNN Trung ương', '',],
            ['DNNN địa phương', '',],
            ['DN có vốn đầu tư nước ngoài', '',],
            ['Khu vực ngoài quốc doanh', '',],
			['Cổ phần', '',],
			['Khác', '',],
        ]);
    }

    public function down()
    {
        echo "m170326_051922_danh_muc_loai_khu_vuc_doanh_nghiep_data cannot be reverted.\n";

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
