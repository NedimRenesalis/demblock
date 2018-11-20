<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_type', 'money', 'total_money','status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'full_name', 'language', 'first_name',
                'last_name', 'company_name', 'pdv', 'address', 'year_of_birth', 'gender', 'career_level', 'education_level', 'additional_experience',
                'country_city', 'phone', 'location', 'job', 'isBlocked', 'zip_code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $type, $type2 = null)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->andFilterWhere([
            'user_type' => $type,
        ]);

        if($type2 != null) {
            $query->orFilterWhere([
                'user_type' => $type2,
            ]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'money' => $this->money,
            'total_money' => $this->total_money,
            'status' => $this->status,
            'isBlocked' => $this->isBlocked,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'LOWER(username)', strtolower($this->username)])
            ->andFilterWhere(['like', 'LOWER(email)', strtolower($this->email)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'LOWER(language)', strtolower($this->language)])
            ->andFilterWhere(['like', 'LOWER(first_name)', strtolower($this->first_name)])
            ->andFilterWhere(['like', 'LOWER(last_name)', strtolower($this->last_name)])
            ->andFilterWhere(['like', 'LOWER(company_name)', strtolower($this->company_name)])
            ->andFilterWhere(['like', 'LOWER(pdv)', strtolower($this->pdv)])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'LOWER(zip_code)', strtolower($this->zip_code)])
            ->andFilterWhere(['like', 'LOWER(job)', strtolower($this->job)])
            ->andFilterWhere(['like', 'LOWER(location)', strtolower($this->location)])
            ->andFilterWhere(['like', 'LOWER(year_of_birth)',strtolower( $this->year_of_birth)])
            ->andFilterWhere(['like', 'LOWER(gender)', strtolower($this->gender)])
            ->andFilterWhere(['like', 'LOWER(career_level)', strtolower($this->career_level)])
            ->andFilterWhere(['like', 'LOWER(education_level)', strtolower($this->education_level)])
            ->andFilterWhere(['like', 'LOWER(additional_experience)', strtolower($this->additional_experience)])
            ->andFilterWhere(['like', 'LOWER(country_city)', strtolower($this->country_city)])
            ->andFilterWhere(['like', 'LOWER(phone)', strtolower($this->phone)]);

        return $dataProvider;
    }
}
