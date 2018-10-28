<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company_image`.
 */
class m170317_011759_company_image extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company_image}}', [
            'image_id'                  => $this->primaryKey(),
            'company_id'                => $this->integer(),
            'image_form_key'            => $this->string(8),
            'image_path'                => $this->string(),
            'sort_order'                => $this->integer()->defaultValue(0),
            'created_at'                => $this->dateTime()->notNull(),
            'updated_at'                => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('company_image_company_id_fk', '{{%company_image}}', 'company_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->getDb()->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();

        $this->dropTable('{{%company_image}}');

        $this->getDb()->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }
}
