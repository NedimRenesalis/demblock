<?php

use yii\db\Migration;
use common\models\AdvertTypes;

class m170405_201039_advert_types extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
     
        $this->createTable('{{%advert_types}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'language' => $this->string()->notNull(),
            'days' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'positions' => $this->integer()->notNull()
        ], $tableOptions);
    }

    public function down()
    {

        $this->dropTable('{{%advert_types}}');

    }

}
