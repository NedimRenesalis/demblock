<?php

use yii\db\Migration;

class m170402_170413_sponsored extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sponsored}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'html' => $this->text(),
            'isPublished' => $this->smallInteger()->defaultValue(0)
        ], $tableOptions);
    }

    public function down()
    {

        $this->dropTable('{{%sponsored}}');

    }

}
