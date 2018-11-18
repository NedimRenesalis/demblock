<?php

use yii\db\Migration;

/**
 * Class m181116_181204_company_information
 */
class m181116_181204_company_information extends Migration
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
        echo "m181116_181204_company_information cannot be reverted.\n";

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

        $this->createTable('{{%company_information}}', [
            'Id' => $this->primaryKey(),
            'CompanyName' => $this->string()->defaultValue(null),
            'Year' => $this->date()->defaultValue(null),
            'Website' => $this->string()->defaultValue(null),
            'NumberOfEmployees' => $this->integer()->defaultValue(null),
            'RegisteredAddress' => $this->string()->defaultValue(null),
            'OperationalAddress' =>$this->string()->defaultValue(null),
            'AboutUs' =>$this->string(500)->defaultValue(null),
            'UserId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-user-company-info',
            'company_information',
            'UserId',
            'user',
            'id',
            'CASCADE'
        );


        foreach ($users as $user){
            $this->insert('company_information', array('CompanyName' => $user->company_name, 'UserId' => $user->id));
        }
    }
    public function down()
    {

        $this->dropTable('{{%company_information}}');

    }

}
