<?php

use yii\db\Migration;

/**
 * Class m181118_225739_sourcing_information
 */
class m181118_225739_sourcing_information extends Migration
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
        echo "m181118_225739_sourcing_information cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $users = \common\models\User::find()->all();

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sourcing_information}}', [
            'Id' => $this->primaryKey(),
            'AnnualPurchasingVolume' => $this->string(1500)->defaultValue(null),
            'PrimarySourcingPurpose' => $this->string(1500)->defaultValue(null),
            'AverageSourcingFrequency' =>$this->string(1500)->defaultValue(null),
            'PreferredSupplierQualifications' =>$this->string(1500)->defaultValue(null),
            'PreferredIndustries' =>$this->string(1500)->defaultValue(null),
            'UserId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-user-sourcing-information',
            'sourcing_information',
            'UserId',
            'user',
            'id',
            'CASCADE'
        );

    }
    public function down()
    {

        $this->dropTable('{{%sourcing_information}}');

    }
}
