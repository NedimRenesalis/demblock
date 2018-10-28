<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CompanyImage]].
 *
 * @see CompanyImage
 */
class CompanyImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CompanyImage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyImage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
