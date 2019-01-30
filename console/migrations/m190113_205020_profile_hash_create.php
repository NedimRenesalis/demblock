<?php

use yii\db\Migration;

/**
 * Class m190113_205020_profile_hash_create
 */
class m190113_205020_profile_hash_create extends Migration
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
        echo "m190113_205020_profile_hash_create cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $table = Yii::$app->db->schema->getTableSchema('user');
        if(!isset($table->columns['profile_hash'])) {
            $this->addColumn('user', 'profile_hash', $this->string()->defaultValue(null));
        }
    }

    public function down()
    {
        $table = Yii::$app->db->schema->getTableSchema('user');
        if(isset($table->columns['profile_hash'])) {
            $this->dropColumn('user', 'profile_hash');
        }
        return true;
    }
    
}
