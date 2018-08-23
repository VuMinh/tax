<?php

use yii\db\Migration;

class m170518_075315_create_colum_ngaytao_to_BC_thanh_tra extends Migration
{
    public function up()
    {
        $this->addColumn('baocaothanhtra','ngayTao','datetime');

    }

    public function down()
    {
        $this->dropColumn('baocaothanhtra','ngayTao');
        echo "m170518_075315_create_colum_ngaytao_to_BC_thanh_tra cannot be reverted.\n";

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
