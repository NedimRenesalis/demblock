<?php

use yii\db\Migration;

class m171001_192421_description_text extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('user', 'company_description', $this->text());
    }

    public function safeDown()
    {
        echo "m171001_192421_description_text cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171001_192421_description_text cannot be reverted.\n";

        return false;
    }
    */
}
