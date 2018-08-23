<?php

use yii\db\Migration;

class m170524_173428_add_truongdoan_ngaytao_ngaycapnhat_to_bcbhxh extends Migration
{
    public function up()
    {
        $this->addColumn('baocaobaohiemxahoi','truongDoan','string');
    }

    public function down()
    {
        echo "m170524_173428_add_truongdoan_ngaytao_ngaycapnhat_to_bcbhxh cannot be reverted.\n";

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
