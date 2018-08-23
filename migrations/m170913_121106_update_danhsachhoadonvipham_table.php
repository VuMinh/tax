<?php

use yii\db\Migration;

class m170913_121106_update_danhsachhoadonvipham_table extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk_danhsachhoadonvipham_mstdnban', 'danhsachhoadonvipham');
        $this->alterColumn('danhsachhoadonvipham', 'mstDnBan', 'string');
        $this->addColumn('danhsachhoadonvipham', 'tenDnBan', 'string');
    }

    public function safeDown()
    {
        echo "m170913_121106_update_danhsachhoadonvipham_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170913_121106_update_danhsachhoadonvipham_table cannot be reverted.\n";

        return false;
    }
    */
}
