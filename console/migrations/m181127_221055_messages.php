<?php

use yii\db\Migration;

/**
 * Class m181127_221055_messages
 */
class m181127_221055_messages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181127_221055_messages cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = '';

        if (Yii::$app->db->driverName == 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%message}}', [
            'id'                   => 'pk',
            'hash'                 => 'string(32) NOT NULL',
            'from'                 => 'integer',
            'to'                   => 'integer',
            'status'               => 'integer',
            'title'                => 'string(255) NOT NULL',
            'message'              => 'text',
            'created_at'           => 'datetime NOT NULL',
            'context'              => 'string(255) NOT NULL'
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%message}}');
    }
}
