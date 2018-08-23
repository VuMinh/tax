<?php

use yii\db\Migration;

class m170424_084523_update_baocaobaohiemxahoitheonam_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%baocaobaohiemxahoitheonam}}', 'ngayTao', 'datetime');
        $this->addColumn('{{%baocaobaohiemxahoitheonam}}', 'ngayCapNhat', 'datetime');
        $this->addColumn('{{%baocaobaohiemxahoitheonam}}', 'ghiChu1', 'text');
        $this->addColumn('{{%baocaobaohiemxahoitheonam}}', 'ghiChu2', 'text');
        $this->addColumn('{{%baocaobaohiemxahoitheonam}}', 'ghiChu3', 'text');
        $this->addColumn('{{%baocaobaohiemxahoitheonam}}', 'ghiChu4', 'text');
    }

    public function down()
    {
        echo "m170424_084523_update_baocaobaohiemxahoitheonam_table cannot be reverted.\n";

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
