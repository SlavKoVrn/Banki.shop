<?php

use yii\db\Migration;

/**
 * Class m240308_083321_create_table_image
 */
class m240308_083321_create_table_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'slug' => $this->string(),
            'mime' => $this->string(),
            'path' => $this->string(),
            'datetime' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }

}
