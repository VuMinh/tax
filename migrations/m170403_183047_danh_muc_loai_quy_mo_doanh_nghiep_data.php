<?php

use yii\db\Migration;

class m170403_183047_danh_muc_loai_quy_mo_doanh_nghiep_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%loaiquymodoanhnghiep}}', [
            'loaiQuyMo', 'ghiChu'
        ], [
            ['DN lớn', '',],
            ['DN vừa', '',],
            ['DN nhỏ', '',],
        ]);
    }

    public function down()
    {
        echo "m170326_050726_danh_muc_loai_quy_mo_doanh_nghiep_data cannot be reverted.\n";

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
