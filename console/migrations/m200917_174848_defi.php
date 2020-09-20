<?php

use yii\db\Migration;

/**
 * Class m200917_174848_defi
 */
class m200917_174848_defi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categories = array(
            'DeFi Solutions' => array()
        );

        foreach ($categories as $parentCategory => $category){
            if(is_array($category)){
                $this->insert('categories', array('Name' => $parentCategory) );
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
        echo "m200917_174848_defi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200917_174848_defi cannot be reverted.\n";

        return false;
    }
    */
}
