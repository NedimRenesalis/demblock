<?php

use yii\db\Migration;

/**
 * Class m200925_084852_defi_categories
 */
class m200925_084852_defi_update_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categories = array(
            'DeFi Solutions' => array(
                'Looking for DeFi Solutions',
                'Offering DeFi Solutions'
            )
        );
        
        echo "a";
        foreach ($categories as $parentCategory => $category){
            if(is_array($category)){
                // remove everything that exists under DeFi solution
                $parent = \backend\models\Categories::find()->where(['like', 'Name', $parentCategory])->one();
                if($parent) {
                    $pid = $parent['Id'];
                    $this->delete('categories', ['Name' => $parentCategory]);
                    $this->delete('categories', ['ParentId' => $pid]);
                }
                // add new parent DeFi solution
                $this->insert('categories', array('Name' => $parentCategory));
                $parent = \backend\models\Categories::find()->where(['like', 'Name', $parentCategory])->one();
                $pid = $parent['Id'];
                // add categories under DeFi solution
                foreach ($category as $item) {
                    $this->insert('categories', array('ParentId' => $pid, 'Name' => $item) );
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200925_084852_defi_categories cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200925_084852_defi_categories cannot be reverted.\n";

        return false;
    }
    */
}
