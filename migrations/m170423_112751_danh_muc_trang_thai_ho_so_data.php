<?php

use yii\db\Migration;

class m170423_112751_danh_muc_trang_thai_ho_so_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%trangthaihoso}}', [
            'trangThaiHs', 'ghiChu'
        ], [
            ['Hs chấp nhận', '',],
			['Hs chờ giải trình', '',],
			['Hs điều chỉnh', '',],
			['Hs ấn định', '',],
			['Hs đề nghị kiểm tra tại DN', '',],

        ]);
    }

    public function down()
    {
        echo "m170423_072617_danh_muc_trang_thai_ho_so_data cannot be reverted.\n";

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
