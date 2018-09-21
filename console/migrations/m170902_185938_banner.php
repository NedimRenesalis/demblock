<?php

use yii\db\Migration;

class m170902_185938_banner extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'company_description', $this->string(500));
        $this->addColumn('user', 'banner', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'company_description');
        $this->dropColumn('user', 'banner');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170902_185938_banner cannot be reverted.\n";

        return false;
    }
    */
}
