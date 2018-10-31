<?php

use yii\db\Migration;

/**
 * Class m181031_120342_advert_images
 */
class m181031_120342_advert_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%advert_image}}', [
            'image_id'                  => $this->primaryKey(),
            'advert_id'                => $this->integer(),
            'image_form_key'            => $this->string(8),
            'image_path'                => $this->string(),
            'sort_order'                => $this->integer()->defaultValue(0),
            'created_at'                => $this->dateTime()->notNull(),
            'updated_at'                => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('advert_image_advert_id_fk', '{{%advert_image}}', 'advert_id', '{{%advert}}', 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->getDb()->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();

        $this->dropTable('{{%advert_image}}');

        $this->getDb()->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181031_120342_advert_images cannot be reverted.\n";

        return false;
    }
    */
}
