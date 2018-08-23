<?php

use yii\db\Migration;

class m170424_072910_update_quyetdinhxuphat_table extends Migration
{
    public function up()
    {

        $this->addColumn('{{%quyetdinhxuphat}}', 'phatChamNopThueVat', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'phatChamNopThueTncn', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'phatChamNopThueTtdb', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'phatChamNopThueKhac', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat1', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat2', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat3', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat4', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat5', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat6', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'tienPhat7', 'decimal(20,3)');
        $this->addColumn('{{%quyetdinhxuphat}}', 'ngayTao', 'dateTime');
        $this->addColumn('{{%quyetdinhxuphat}}', 'ngayCapNhat', 'dateTime');

    }

    public function down()
    {
        echo "m170424_072910_update_quyetdinhxuphat_table cannot be reverted.\n";

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
