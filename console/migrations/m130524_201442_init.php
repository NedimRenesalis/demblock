<?php

use yii\db\Migration;
use common\models\User;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'full_name' => $this->string(),

            // all
            'user_type' => $this->smallInteger()->notNull(),
            'language' => $this->string()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),

            // employer
            'company_name' => $this->string()->defaultValue(null),
            'pdv' => $this->string()->defaultValue(null),
            'address' => $this->string()->defaultValue(null),
            'money' => $this->float()->defaultValue(0),
            'total_money' => $this->float()->defaultValue(0),

            // employee
            'year_of_birth' => $this->string()->defaultValue(null),
            'gender' => $this->string()->defaultValue(null),
            'career_level' => $this->string()->defaultValue(null),
            'education_level' => $this->string()->defaultValue(null),
            'job' => $this->string()->defaultValue(null),
            'location' => $this->string()->defaultValue(null),
            'additional_experience' => $this->text()->defaultValue(null),

            // employer & employee
            'country_city' => $this->string()->defaultValue(null),
            'phone' => $this->string()->defaultValue(null),
            'zip_code' => $this->string()->defaultValue(null),
            'isBlocked' => $this->smallInteger()->defaultValue(0),
            'image' => $this->string(),
            'company_description'=> $this->string(500),
            'banner' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'mainProducts' => $this->string(10000),
        ], $tableOptions);
    }

    public function down()
    {
       $this->dropTable('{{%user}}');
    }
}
