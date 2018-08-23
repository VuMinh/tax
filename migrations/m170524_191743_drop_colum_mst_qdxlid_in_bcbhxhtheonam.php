<?php

use yii\db\Migration;

class m170524_191743_drop_colum_mst_qdxlid_in_bcbhxhtheonam extends Migration
{
    public function up()
    {
        $this->addColumn('baocaobaohiemxahoitheonam','bhxhId','integer');
        $this->addForeignKey('fk_bhxh', 'baocaobaohiemxahoitheonam', 'bhxhId', 'baocaobaohiemxahoi', 'id');
    }

    public function down()
    {
        echo "m170524_191743_drop_colum_mst_qdxlid_in_bcbhxhtheonam cannot be reverted.\n";

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
