<?php

use yii\db\Migration;

class m170321_154739_add_admin_user extends Migration
{
    public function up()
    {
        $curTime = time();
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'email' => 'test@projectkit.net',
            'password_hash' => Yii::$app->security->generatePasswordHash("123456"),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'confirmed_at' => $curTime,
            'created_at' => $curTime,
            'updated_at' => $curTime,
        ]);
    }

    public function down()
    {
        echo "m170321_154739_add_admin_user cannot be reverted.\n";

        return false;
    }
}
