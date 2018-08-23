<?php

use yii\db\Migration;

class m170424_084632_update_sotheodoisauhoanthue_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%sotheodoisauhoanthue}}', 'soTienThuHoi', 'decimal(20,3)');
//        $this->addColumn('{{%sotheodoisauhoanthue}}', 'ngayTao', 'datetime');
        $this->addColumn('{{%sotheodoisauhoanthue}}', 'ngayCapNhat', 'datetime');
        $this->addColumn('{{%sotheodoisauhoanthue}}', 'ghiChu1', 'text');
        $this->addColumn('{{%sotheodoisauhoanthue}}', 'ghiChu2', 'text');
        $this->addColumn('{{%sotheodoisauhoanthue}}', 'ghiChu3', 'text');
        $this->addColumn('{{%sotheodoisauhoanthue}}', 'ghiChu4', 'text');
    }

    public function down()
    {
        echo "m170424_084632_update_sotheodoisauhoanthue_table cannot be reverted.\n";

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
