<?php

use yii\db\Migration;

class m170517_064735_add_cloumn_ngayTao_tao_to_sotheodoisauhoanthue extends Migration
{
    public function up()
    {
        $this->addColumn('sotheodoisauhoanthue','ngayTao','datetime');

    }

    public function down()
    {
        $this->dropColumn('sotheodoisauhoanthue','ngayTao');
        echo "m170517_064735_add_cloumn_ngayTao_tao_to_sotheodoisauhoanthue cannot be reverted.\n";

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
