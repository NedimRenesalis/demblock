<?php

use yii\db\Migration;

/**
 * Class m200921_121557_defi_update
 */
class m200921_121557_defi_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('categories', ['Name' => 'DeFi Financing']);
        $this->insert('categories', array('Name' => 'DeFi Solutions'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200921_121557_defi_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200921_121557_defi_update cannot be reverted.\n";

        return false;
    }
    */
}
