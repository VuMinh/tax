<?php

use yii\db\Migration;

class m170424_074237_update_quyetdinhkiemtra_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%quyetdinhkiemtra}}', 'ghiChu1', 'text');
        $this->addColumn('{{%quyetdinhkiemtra}}', 'ghiChu2', 'text');
        $this->addColumn('{{%quyetdinhkiemtra}}', 'ghiChu3', 'text');
        $this->addColumn('{{%quyetdinhkiemtra}}', 'ghiChu4', 'text');
    }

    public function down()
    {
        echo "m170424_074237_update_quyetdinhkiemtra_table cannot be reverted.\n";

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
