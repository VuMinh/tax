<?php

use yii\db\Migration;

class m170515_163337_alter_table_sotheodoisauhoanthue extends Migration
{
    public function up()
    {
        $this->alterColumn('sotheodoisauhoanthue','soQdXuPhatId','int');
        $this->addForeignKey('fk_quyetdinhxl', 'sotheodoisauhoanthue', 'soQdXuPhatId', 'quyetdinhxuphat', 'id');
        $this->addColumn('quyetdinhkiemtra', 'ngayTao', 'datetime');
        $this->addColumn('quyetdinhxuly', 'ngayTao', 'datetime');
    }

    public function down()
    {
        $this->dropColumn('quyetdinhkiemtra', 'ngayTao');
        $this->dropColumn('quyetdinhxuly', 'ngayTao');
        echo "m170515_163337_alter_table_sotheodoisauhoanthue cannot be reverted.\n";
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
