<?php

use yii\db\Migration;

/**
 * Class m240308_041206_add_admin
 */
class m240308_041206_add_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'id' => 1,
            'username' => 'admin',
            'auth_key' => md5(time()),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'password_reset_token' => '',
            'email' => 'slavko.chita@gmail.com',
            'verification_token' => '',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}',['id' => 1]);
    }

}
