<?php

use yii\db\Migration;

class m170409_103612_advert extends Migration
{
    public function up()
    {
        $this->createTable('{{%advert}}', [
            'id' => $this->primaryKey(),
            'position' => $this->string()->notNull(),
            'start_advert' => $this->integer()->notNull(),
            'end_advert' => $this->integer()->notNull(),
            'number_of_days' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'isPublished' => $this->smallInteger()->defaultValue(1),
            'number_of_positions' => $this->integer()->notNull(),
            'web_address' => $this->string()->notNull(),
            'contact_email' => $this->string()->notNull(),
            'contact_person' => $this->string(),
            'location' => $this->string()->notNull(),
            'category' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'anonymously' => $this->smallInteger()->notNull(),
            'payment' => $this->integer()->notNull(),
            'payment_status' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-application-company_id',
            'advert',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%advert}}');
    }


}
