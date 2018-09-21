<?php

use yii\db\Migration;

class m170402_170413_sponsored extends Migration
{
    public function up()
    {
        $this->createTable('{{%sponsored}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'html' => $this->text(),
            'isPublished' => $this->smallInteger()->defaultValue(0)
            ]);
    }

    public function down()
    {

        $this->dropTable('{{%sponsored}}');

    }

}
