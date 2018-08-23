<?php

use yii\db\Migration;

/**
 * Class m180130_093516_add_column_chiCucThue_to_baocaokiemtra
 */
class m180130_093516_add_column_chiCucThue_to_baocaokiemtra extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('baocaokiemtra', 'chiCucThue', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180130_093516_add_column_chiCucThue_to_baocaokiemtra cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180130_093516_add_column_chiCucThue_to_baocaokiemtra cannot be reverted.\n";

        return false;
    }
    */
}
