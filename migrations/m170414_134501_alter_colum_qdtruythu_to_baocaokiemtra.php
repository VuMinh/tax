<?php

use yii\db\Migration;

class m170414_134501_alter_colum_qdtruythu_to_baocaokiemtra extends Migration
{
    public function up()
    {
        $this->addColumn('baocaokiemtra', 'soQdTruyThuId', 'int(11) AFTER soQdktId');
    }

    public function down()
    {
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
