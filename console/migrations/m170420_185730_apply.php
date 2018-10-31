<?php

use yii\db\Migration;

class m170420_185730_apply extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apply}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'advert_id' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->addForeignKey(
            'fk-apply-user_id',
            'apply',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-apply-advert_id',
            'apply',
            'advert_id',
            'advert',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%apply}}');
    }
}
