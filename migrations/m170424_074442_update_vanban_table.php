<?php

use yii\db\Migration;

class m170424_074442_update_vanban_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%vanban}}', 'ghiChu1', 'text');
        $this->addColumn('{{%vanban}}', 'ghiChu2', 'text');
        $this->addColumn('{{%vanban}}', 'ghiChu3', 'text');
        $this->addColumn('{{%vanban}}', 'ghiChu4', 'text');
    }

    public function down()
    {
        echo "m170424_074442_update_vanban_table cannot be reverted.\n";

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
