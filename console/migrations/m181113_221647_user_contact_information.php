<?php

use yii\db\Migration;

/**
 * Class m181113_221647_user_contact_information
 */
class m181113_221647_user_contact_information extends Migration
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
        echo "m181113_221647_user_contact_information cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $users = \common\models\User::find()->all();

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_contact_information}}', [
            'Id' => $this->primaryKey(),
            'Email' => $this->string()->notNull()->unique(),
            'AlternativeEmail' => $this->string()->defaultValue('none'),
            'Phone' => $this->string()->defaultValue('none'),
            'Fax' => $this->string()->defaultValue('none'),
            'Mobile' => $this->string()->defaultValue('none'),
            'Facebook' =>$this->string()->defaultValue('none'),
            'Twitter' =>$this->string()->defaultValue('none'),
            'Instagram' =>$this->string()->defaultValue('none'),
            'UserId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-user-contact-info',
            'user_contact_information',
            'UserId',
            'user',
            'id',
            'CASCADE'
        );


        foreach ($users as $user){
            $this->insert('user_contact_information', array('Email' => $user->email, 'Phone' => $user->phone, 'UserId' => $user->id));
        }

    }

    public function down()
    {
        $this->dropTable('{{%user_contact_information}}');
    }

}
