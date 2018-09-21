<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdvertTypes;

/**
 * AdvertTypesSearch represents the model behind the search form about `backend\models\AdvertTypes`.
 */
class AdvertTypesSearch extends AdvertTypes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'days', 'positions'], 'integer'],
            [['title', 'type', 'language'], 'safe'],
            [['price'], 'number'],
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
        $query = AdvertTypes::find();

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
            'days' => $this->days,
            'price' => $this->price,
            'positions' => $this->positions,
        ]);

        $query->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(type)', strtolower($this->type)])
            ->andFilterWhere(['like', 'LOWER(language)', strtolower($this->language)]);

        return $dataProvider;
    }
}
