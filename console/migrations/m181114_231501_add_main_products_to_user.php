<?php

use yii\db\Migration;

/**
 * Class m181114_231501_add_main_products_to_user
 */
class m181114_231501_add_main_products_to_user extends Migration
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
        echo "m181114_231501_add_main_products_to_user cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('user', 'mainProducts', $this->string(10000));
    }
    /*
       public function down()
       {
           echo "m181114_231501_add_main_products_to_user cannot be reverted.\n";

           return false;
       }
       */
}
