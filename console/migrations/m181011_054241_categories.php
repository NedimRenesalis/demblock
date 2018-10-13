<?php

use yii\db\Migration;

/**
 * Class m181011_054241_categories
 */
class m181011_054241_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
   /* public function safeUp()
    {

    }

    /**
     * {@inheritdoc}

    public function safeDown()
    {
        echo "m181011_054241_categories cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%categories}}', [
            'Id' => $this->primaryKey(),
            'ParentId' => $this->integer()->defaultValue(NULL),
            'Name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
    }

}
