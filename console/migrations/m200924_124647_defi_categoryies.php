<?php

use yii\db\Migration;

/**
 * Class m200924_124647_defi_categoryies
 */
class m200924_124647_defi_categoryies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categories = array(
            'DeFi Solutions' => array(
                'General'
            )
        );

        foreach ($categories as $parentCategory => $category){
            if(is_array($category)){
                $parent = \backend\models\Categories::find()->where(['like', 'Name', $parentCategory])->one();
                if($parent) {
                    $pid = $parent['Id'];
                  foreach ($category as $item) {
                      $this->insert('categories', array('ParentId' => $pid, 'Name' => $item) );
                  }
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200924_124647_defi_categoryies cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200924_124647_defi_categoryies cannot be reverted.\n";

        return false;
    }
    */
}
