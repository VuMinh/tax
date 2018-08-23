<?php

use yii\db\Migration;

class m170424_084351_update_baocaobaohiemxahoi_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%baocaobaohiemxahoi}}', 'ngayTao', 'datetime');
        $this->addColumn('{{%baocaobaohiemxahoi}}', 'ngayCapNhat', 'datetime');
        $this->addColumn('{{%baocaobaohiemxahoi}}', 'ghiChu1', 'text');
        $this->addColumn('{{%baocaobaohiemxahoi}}', 'ghiChu2', 'text');
        $this->addColumn('{{%baocaobaohiemxahoi}}', 'ghiChu3', 'text');
        $this->addColumn('{{%baocaobaohiemxahoi}}', 'ghiChu4', 'text');
    }

    public function down()
    {
        echo "m170424_084351_update_baocaobaohiemxahoi_table cannot be reverted.\n";

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
