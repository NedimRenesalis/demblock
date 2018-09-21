<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Advert;

/**
 * AdvertSearch represents the model behind the search form about `common\models\Advert`.
 */
class AdvertSearch extends Advert
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'start_advert', 'end_advert', 'number_of_days', 'created_at', 'isPublished', 'number_of_positions', 'type', 'anonymously', 'payment', 'user_id'], 'integer'],
            [['position', 'web_address', 'contact_email', 'contact_person', 'location', 'category', 'description'], 'safe'],
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
    public function search($params)
    {
        $query = Advert::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'number_of_days' => $this->number_of_days,
            'end_advert' => $this->end_advert,
            'isPublished' => $this->isPublished,
            'number_of_positions' => $this->number_of_positions,
            'type' => $this->type,
            'anonymously' => $this->anonymously,
            'payment' => $this->payment,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'LOWER(position)', strtolower($this->position)])
            ->andFilterWhere(['like', 'LOWER(web_address)', strtolower($this->web_address)])
            ->andFilterWhere(['like', 'LOWER(contact_email)', strtolower($this->contact_email)])
            ->andFilterWhere(['like', 'LOWER(contact_person)', strtolower($this->contact_person)])
            ->andFilterWhere(['like', 'LOWER(location)', strtolower($this->location)])
            ->andFilterWhere(['like', 'LOWER(category)', strtolower($this->category)])
            ->andFilterWhere(['like', 'LOWER(description)', strtolower($this->description)])
            ->andFilterWhere(['>=', 'created_at', $this->created_at])
            ->andFilterWhere(['>=', 'start_advert', $this->start_advert]);

        $query->orderBy(['id' => SORT_DESC]);


        return $dataProvider;
    }
}
