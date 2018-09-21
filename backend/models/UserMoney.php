<?php

namespace backend\models;

use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserMoney extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'money'], 'integer'],
        ];
    }


}
